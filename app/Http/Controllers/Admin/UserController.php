<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use App\Models\User;
use App\Utilities\Common;
use Illuminate\Http\Request;

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

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        if ($request->get('password') != $request->get('password_confirmation')){
            return back()->with('notification', 'ERROR: Confirmation password does not match');
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->get('password'));


        //Xu ly file:
        if($request->hasFile('image')){
            $data['avatar'] = Common::uploadFile($request->file('image'), 'front/img/user');
        }

        $user = $this->userService->create($data);

        return redirect('admin/user/' . $user->id);
    }
}
