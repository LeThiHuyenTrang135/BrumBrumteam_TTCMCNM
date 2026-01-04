<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function getAll();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
