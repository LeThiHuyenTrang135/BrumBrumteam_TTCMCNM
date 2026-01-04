<?php

namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public $repository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }


    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
