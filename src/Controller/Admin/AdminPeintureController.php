<?php

namespace App\Controller\Admin;

use App\Entity\Peinture;
use App\Form\PeintureType;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/peinture")
 */
class AdminPeintureController extends AbstractController
{
    /**
     * @Route("/", name="admin_peinture_index", methods={"GET"})
     */
    
    public function index(PeintureRepository $peintureRepository): Response
    {
        return $this->render('admin/admin_peinture/index.html.twig', [
            'peintures' => $peintureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_peinture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $peinture = new Peinture();
        $form = $this->createForm(PeintureType::class, $peinture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($peinture);
            $entityManager->flush();

            return $this->redirectToRoute('admin_peinture_index');
        }

        return $this->render('admin/admin_peinture/new.html.twig', [
            'peinture' => $peinture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_peinture_show", methods={"GET"})
     */
    public function show(Peinture $peinture): Response
    {
        return $this->render('admin/admin_peinture/show.html.twig', [
            'peinture' => $peinture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_peinture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Peinture $peinture): Response
    {
        $form = $this->createForm(PeintureType::class, $peinture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_peinture_index');
        }

        return $this->render('admin/admin_peinture/edit.html.twig', [
            'peinture' => $peinture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_peinture_delete", methods={"POST"})
     */
    public function delete(Request $request, Peinture $peinture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$peinture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($peinture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/admin_peinture_index');
    }
}
