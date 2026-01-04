<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function delete($user)
    {
        $user->delete();
        return true;
    }
}
