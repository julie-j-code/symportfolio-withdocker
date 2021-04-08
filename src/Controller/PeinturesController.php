<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\PeintureRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PeinturesController extends AbstractController
{
    /**
     * @Route("/realisations", name="realisations")
     */
    public function realisations(
        PeintureRepository $peintureRepository, 
        CategorieRepository $categorieRepository,
        PaginatorInterface $paginator,
        Request $request): Response
    {
        
        $data = $peintureRepository->findAll();
        $peintures = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            6
        );

        // dd($categorieRepository->findAll());

        return $this->render('peintures/realisations.html.twig', [
            'controller_name' => 'PeinturesController',
            // 'peintures' => $peintureRepository->findAll(),
            'peintures' => $peintures,
            'categories' => $categorieRepository->findAll(),
            
            
        ]);


       
    }
}
