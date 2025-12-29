<?php
namespace App\Services\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public $repository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->repository = $UserRepository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($user, array $data)
    {
        return $this->repository->update($user, $data);
    }

    public function delete($user)
    {
        return $this->repository->delete($user);
    }
}