<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class UserController extends AbstractController
{
    private $entityManager;
    private $eventDispatcher;

    public function __construct(EntityManagerInterface $entityManager,  EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
        ]);
    }

    /**
     * @Route("/user/create", name="user_create", methods={"POST"})
     */
    public function userCreate(Request $request): JsonResponse
    {
        $user = new User();
        $parameter =  json_decode($request->getContent(),true);

        $user->setFirstname($parameter['firstname']);
        $user->setLastname($parameter['lastname']);
        $user->setEmail($parameter['email']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Dispatch the UserRegisteredEvent
        $this->eventDispatcher->dispatch(new \App\Event\UserRegisteredEvent($user));

        return $this->json([
            'message' => 'You are register successfully',
        ]);
    }
}
