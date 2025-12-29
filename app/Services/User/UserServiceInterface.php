<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function getAll();
    public function create(array $data);
    public function update($user, array $data);
    public function delete($user);
}
