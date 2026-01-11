<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Order\OrderServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Utilities\Constant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Requests\ResendCodeRequest;

class AccountController extends Controller
{
    private $userService;
    private $orderService;

    public function __construct(
        UserServiceInterface $userService,
        OrderServiceInterface $orderService
    ) {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }
    public function login()
    {
        return view('front.account.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            $userId = Auth::id();
            $user = Auth::user();
            
            $oldCart = DB::table('shoppingcart')->where('identifier', $userId)->first();
            
            if ($oldCart) {
                Cart::restore($userId);
            }

            // Redirect theo role
            if ($user->hasRole('admin')) {
                return redirect('/admin/user');
            }

            return redirect('');
        } else {
            return back()->with('notifications', 'ERROR: Email or password is wrong');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            
            DB::table('shoppingcart')->where('identifier', $userId)->delete();
            
            if (Cart::count() > 0) {
                Cart::store($userId);
            }
            
            Cart::destroy();
            session()->forget('cart');
        }

        Auth::logout();

        return redirect('/');
    }

    public function Register()
    {
        return view('front.account.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            $verificationCode = strtoupper(Str::random(6));

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => Constant::user_level_client,
                'verification_code' => $verificationCode,
                'code_expires_at' => now()->addMinutes(10),
                'is_verified' => false,
            ];

            $user = $this->userService->create($data);

            Mail::to($user->email)->send(
                new VerificationCodeMail($verificationCode, $user->name)
            );

            return redirect()->route('verify.form')
                ->with('success', 'Registration successful! Please check your email for verification code.')
                ->with('email', $user->email);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('notification', 'ERROR: Registration failed - ' . $e->getMessage())
                ->withInput();
        }
    }

    public function myOrderIndex()
    {

        $orders = $this->orderService->getOrderByUserId(Auth::id());

        return view('front.account.my-order.index', compact('orders'));
    }

    public function myOrderShow($id)
    {
        $order = $this->orderService->find($id);

        return view('front.account.my-order.show', compact('order'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if ($user) {
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->id]);
                }
                Auth::login($user);
                return redirect('/')->with('notification', 'Login with Google successful!');
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)),
                    'level' => Constant::user_level_client,
                    'avatar' => $googleUser->avatar,
                ]);

                Auth::login($newUser);
                return redirect('/')->with('notification', 'Register & Login with Google successful!');
            }
        } catch (\Exception $e) {
            return redirect('account/login')->with('notification', 'Google Login Failed: ' . $e->getMessage());
        }
    }


    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            $user = User::where('github_id', $githubUser->id)
                ->orWhere('email', $githubUser->email)
                ->first();

            if ($user) {
                if (empty($user->github_id)) {
                    $user->update(['github_id' => $githubUser->id]);
                }
                Auth::login($user);
                return redirect('/')->with('notification', 'Login with github successful!');
            } else {
                $newUser = User::create([
                    'name' => $githubUser->name,
                    'email' => $githubUser->email,
                    'github_id' => $githubUser->id,
                    'password' => bcrypt(Str::random(16)),
                    'level' => Constant::user_level_client,
                    'avatar' => $githubUser->avatar,
                ]);

                Auth::login($newUser);
                return redirect('/')->with('notification', 'Register & Login with github successful!');
            }
        } catch (\Exception $e) {
            return redirect('account/login')->with('notification', 'Github Login Failed: ' . $e->getMessage());
        }
    }

    public function loginPhone()
    {
        return view('front.account.login_phone');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['phone' => 'required|numeric|digits_between:9,11']);

        $phone = $request->phone;
        $otp = rand(100000, 999999);
        Cache::put('otp_' . $phone, $otp, 300);

        Log::info("Mã OTP của số điện thoại $phone là: $otp");
        
        return redirect()->route('login.verify_otp', ['phone' => $phone])
            ->with('notification', 'Mã OTP đã được gửi (Hãy xem trong file log)!');
    }

    public function verifyOtp(Request $request)
    {
        $phone = $request->phone;
        return view('front.account.verify_otp', compact('phone'));
    }

    public function checkOtp(Request $request)
    {
        $phone = $request->phone;
        $otpInput = $request->otp;

        $otpReal = Cache::get('otp_' . $phone);

        if ($otpInput == $otpReal) {
            $user = User::where('phone', $phone)->first();

            if (!$user) {
                $user = User::create([
                    'name' => 'User ' . $phone,
                    'email' => $phone . '@phone.local',
                    'phone' => $phone,
                    'password' => bcrypt(Str::random(16)),
                    'level' => Constant::user_level_client,
                ]);
            }

            Auth::login($user);
            Cache::forget('otp_' . $phone);

            return redirect('/')->with('notification', 'Đăng nhập bằng SĐT thành công!');
        } else {
            return back()->with('notification', 'Mã OTP không đúng hoặc đã hết hạn!');
        }
    }

    public function showVerifyForm(Request $request)
    {
        $email = session('email') ?? $request->email ?? old('email');

        $maskedEmail = '';
        if ($email) {
            $parts = explode('@', $email);
            $name = $parts[0];
            $domain = $parts[1] ?? '';

            $len = strlen($name);
            $maskedName = ($len > 2)
                ? str_repeat('*', $len - 2) . substr($name, -2)
                : str_repeat('*', $len);

            $maskedEmail = $maskedName . '@' . $domain;
        }
        return view('front.account.verify.index', compact('email'));
    }

    public function verifyEmail(VerifyCodeRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user->is_verified) {
            return redirect()->back()->with('info', 'Email is already verified. You can login now.');
        }

        if ($user->verification_code !== $request->code) {
            return redirect()->back()
                ->with('error', 'Invalid verification code')
                ->withInput();
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::user_level_client,
        ];

        if ($user->code_expires_at < now()) {
            return redirect()->back()
                ->with('error', 'Verification code has expired. Please request a new one.')
                ->withInput();
        }

        $user->update([
            'is_verified' => true,
            'verification_code' => null,
            'code_expires_at' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now login.');
    }

    public function resendCode(ResendCodeRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user->is_verified) {
            return redirect()->back()->with('info', 'Email is already verified.');
        }

        $verificationCode = strtoupper(Str::random(6));

        $user->update([
            'verification_code' => $verificationCode,
            'code_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(
            new VerificationCodeMail($verificationCode, $user->name)
        );

        return redirect()->back()
        ->with('success', 'Verification code has been resent to your email.')
        ->with('email', $user->email);
    }
}
