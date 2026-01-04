<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use App\Models\User;
use App\Utilities\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

   
    public function index()
    {
        $users = $this->userService->getAll();
        return view('admin.user.index', compact('users'));
    }

   
    public function create()
    {
        return view('admin.user.create');
    }

    
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'phone'    => 'nullable|string|max:20',
                'password' => 'required|confirmed|min:6',
                'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại trong hệ thống',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'image.image' => 'File phải là hình ảnh',
                'image.max' => 'Kích thước ảnh tối đa 2MB',
            ]);

            $data = [
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => bcrypt($request->password),
                'level'    => 1, 
            ];

            if ($request->hasFile('image')) {
                $fileName = Common::uploadFile(
                    $request->file('image'),
                    'front/img/user'
                );
                $data['avatar'] = 'front/img/user/' . $fileName;
            }

            $user = $this->userService->create($data);

            Log::info('User created successfully', ['user_id' => $user->id, 'email' => $user->email]);

            return redirect()->route('admin.user.index')
                ->with('notification', 'Tạo người dùng thành công!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

  
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

   
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'password' => 'nullable|confirmed|min:6',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'level' => 'required|in:0,1',
            ], [
                'name.required' => 'Vui lòng nhập tên người dùng',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại trong hệ thống',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            ]);

            $data = [
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'level' => (int) $request->level,
            ];

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            if ($request->hasFile('image')) {
                $fileName = Common::uploadFile(
                    $request->file('image'),
                    'front/img/user'
                );
                $data['avatar'] = 'front/img/user/' . $fileName;
            }

            $user->update($data);

            return redirect()->route('admin.user.show', $user->id)
                ->with('notification', 'Cập nhật người dùng thành công!');

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    
    public function destroy(User $user)
    {
        try {
            $user->delete();
            
            return redirect()->route('admin.user.index')
                ->with('notification', 'Xóa người dùng thành công!');
                
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Không thể xóa người dùng này!');
        }
    }
}