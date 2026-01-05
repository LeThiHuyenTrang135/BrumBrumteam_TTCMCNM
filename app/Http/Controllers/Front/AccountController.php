<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
            'level' => 2,
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            $userId = Auth::id();
            $oldCart = DB::table('shoppingcart')->where('identifier', $userId)->first();
            
            if ($oldCart) {
                Cart::restore($userId);
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

        return redirect()->back();
    }

    public function Register()
    {
        return view('front.account.register');
    }

    public function postRegister(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with('notification', 'ERROR: Confire password does not match');

        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::user_level_client,
        ];

        $this->userService->create($data);

        return redirect('account/login')->with('notification', 'Register Success Please login');
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
}
