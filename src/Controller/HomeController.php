<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\PeintureRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(
      PeintureRepository $peintureRepository, 
      BlogpostRepository $blogpostRepository,
      UserRepository $userRepository): Response
    {
        

        return $this->render('home/index.html.twig', [
          'peintures' => $peintureRepository->lastPeintures(),
          'blogposts' => $blogpostRepository->lastBlogposts(),
          'peintres' => $userRepository->findAll()

          ]);
        }
}
