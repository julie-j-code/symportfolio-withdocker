<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use App\Form\BlogpostType;
use App\Repository\BlogpostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/blogpost")
 */
class AdminBlogpostController extends AbstractController
{
    /**
     * @Route("/", name="admin_blogpost_index", methods={"GET"})
     */
    public function index(BlogpostRepository $blogpostRepository): Response
    {
        return $this->render('admin/admin_blogpost/index.html.twig', [
            'blogposts' => $blogpostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_blogpost_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blogpost = new Blogpost();
        $form = $this->createForm(BlogpostType::class, $blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogpost);
            $entityManager->flush();

            return $this->redirectToRoute('admin_blogpost_index');
        }

        return $this->render('admin/admin_blogpost/new.html.twig', [
            'blogpost' => $blogpost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_blogpost_show", methods={"GET"})
     */
    public function show(Blogpost $blogpost): Response
    {
        return $this->render('admin/admin_blogpost/show.html.twig', [
            'blogpost' => $blogpost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_blogpost_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Blogpost $blogpost): Response
    {
        $form = $this->createForm(BlogpostType::class, $blogpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_blogpost_index');
        }

        return $this->render('admin/admin_blogpost/edit.html.twig', [
            'blogpost' => $blogpost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_blogpost_delete", methods={"POST"})
     */
    public function delete(Request $request, Blogpost $blogpost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogpost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogpost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_blogpost_index');
    }
}
