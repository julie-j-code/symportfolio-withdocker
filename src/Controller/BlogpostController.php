<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogpostController extends AbstractController
{
    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(
        BlogpostRepository $blogpostRepository,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response {
        $data = $blogpostRepository->findAll();
        $blogposts = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );


        return $this->render('blogpost/actualites.html.twig', [
            'controller_name' => 'BlogpostController',
            'blogposts' => $blogposts
        ]);
    }
}
