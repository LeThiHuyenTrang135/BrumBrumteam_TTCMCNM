<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function getAll();
    public function create(array $data);
}
