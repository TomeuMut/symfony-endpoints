<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * This function create a User with Hashed Password
     * 
     * @return array
     */
    #[Route('/users', name: 'createUser', methods: ['POST'])]
    public function createUser(Request $request, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator): JsonResponse
    {        
                
        $data = json_decode($request->getContent(), true);        
        $user = new User();
        $user->setName($data['name']);
        $user->setPassword(
            $passwordHasher->hashPassword($user, $data['password'])
        );

        
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        return new JsonResponse(['message' => 'User created successfully'], 201);
    }
    #[Route('/user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
