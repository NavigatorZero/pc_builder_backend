<?php

namespace App\Controller;

use App\Manager\UserManager;
use Artyum\RequestDtoMapperBundle\Attribute\Dto;
use Artyum\RequestDtoMapperBundle\Extractor\JsonExtractor;
use App\DTO\UserDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    //TODO Security Token Storage, outDto
    #[Route('/user/{id}', name: 'get_user', methods: 'GET')]
    public function getUserEntity(int $id): Response
    {
        return $this->json($this->userManager->userRepository->find($id));
    }

    #[Route('/user/create', name: 'post_user', methods: 'POST')]
    public function postUser
    (#[Dto(extractor: JsonExtractor::class, validate: true)] UserDto $userDto): Response
    {
        return $this->json($this->userManager->createUser($userDto));
    }
}
