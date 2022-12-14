<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use App\DTO\UserDto;

class UserManager extends Manager
{
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

  public function createUser(UserDto $userDto) : User
  {
      return $this->userRepository->create($userDto);
  }
}
