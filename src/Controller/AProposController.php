<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BlogpostRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AProposController extends AbstractController
{
    /**
     * @Route("/a-propos", name="a-propos")
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        // dd($users);
        return $this->render('a_propos/index.html.twig', [
            'controller_name' => 'AProposController',
            'users' => $userRepository->findAll()
        ]);
    }
    /**
     * @Route("/a-propos/{id}", name="a-propos-peintre")
     */
    public function findUser(User $user, BlogpostRepository $blogpostRepository): Response
    {
        // dd($user);
        $user=$user;
        $blogposts = $blogpostRepository->getCurrentPeintre($user);
        return $this->render('a_propos/index.html.twig', [
            'controller_name' => 'AProposController',
            'user' => $user,
            'blogposts' => $blogposts

        ]);
    }




}
