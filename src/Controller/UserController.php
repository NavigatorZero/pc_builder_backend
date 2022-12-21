<?php

namespace App\Controller;

use App\DTO\UserDto;
use App\Manager\UserManager;
use Artyum\RequestDtoMapperBundle\Attribute\Dto;
use Artyum\RequestDtoMapperBundle\Extractor\JsonExtractor;
use Exception;
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
    public function postUser(
        #[Dto(extractor: JsonExtractor::class, validate: true)] UserDto $userDto
    ): Response {
        return $this->json($this->userManager->create($userDto));
    }

    /**
     * @throws Exception
     */
    #[Route('/user/{id}', name: 'patch_user', methods: 'PATCH')]
    public function updateUser(
        int $id,
        #[Dto(extractor: JsonExtractor::class, validate: false)] UserDto $userDto,
    ): Response {

        $user = $this->userManager->find($id);

        $this->userManager->update($userDto, $user);

        return $this->json($user);
    }

    /**
     * @throws Exception
     */
    #[Route('/user/{id}', name: 'delete_user', methods: 'DELETE')]
    public function deleteUser(int $id): Response
    {
        $this->userManager->delete($this->userManager->find($id));

        return $this->json(true);
    }

}
