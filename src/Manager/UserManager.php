<?php

namespace App\Manager;

use App\DTO\UserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Exception;

class UserManager extends Manager
{
    public UserRepository $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(UserDto $userDto): User
    {
        return $this->userRepository->create($userDto);
    }

    public function update(UserDto $userDto, User $user): User
    {
        return $this->userRepository->update($userDto, $user);
    }

    /**
     * @throws Exception
     */
    public function find(int $userId): User
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new Exception('User not found', 404);
        }

        return $user;
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user);
    }
}
