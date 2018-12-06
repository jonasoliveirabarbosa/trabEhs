<?php

namespace App\Controller;

use App\Entity\Exemplar;
use App\Form\ExemplarType;
use App\Repository\ExemplarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exemplar")
 */
class ExemplarController extends AbstractController
{
    /**
     * @Route("/", name="exemplar_index", methods="GET")
     */
    public function index(ExemplarRepository $exemplarRepository): Response
    {
        return $this->render('exemplar/index.html.twig', ['exemplars' => $exemplarRepository->findAll()]);
    }

    /**
     * @Route("/new", name="exemplar_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $exemplar = new Exemplar();
        $form = $this->createForm(ExemplarType::class, $exemplar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exemplar);
            $em->flush();

            return $this->redirectToRoute('exemplar_index');
        }

        return $this->render('exemplar/new.html.twig', [
            'exemplar' => $exemplar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exemplar_show", methods="GET")
     */
    public function show(Exemplar $exemplar): Response
    {
        return $this->render('exemplar/show.html.twig', ['exemplar' => $exemplar]);
    }

    /**
     * @Route("/{id}/edit", name="exemplar_edit", methods="GET|POST")
     */
    public function edit(Request $request, Exemplar $exemplar): Response
    {
        $form = $this->createForm(ExemplarType::class, $exemplar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exemplar_index', ['id' => $exemplar->getId()]);
        }

        return $this->render('exemplar/edit.html.twig', [
            'exemplar' => $exemplar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exemplar_delete", methods="DELETE")
     */
    public function delete(Request $request, Exemplar $exemplar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exemplar->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exemplar);
            $em->flush();
        }

        return $this->redirectToRoute('exemplar_index');
    }
}
