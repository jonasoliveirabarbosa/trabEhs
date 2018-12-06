<?php

namespace App\Controller;

use App\Entity\Emprestimo;
use App\Form\EmprestimoType;
use App\Repository\EmprestimoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emprestimo")
 */
class EmprestimoController extends AbstractController
{
    /**
     * @Route("/", name="emprestimo_index", methods="GET")
     */
    public function index(EmprestimoRepository $emprestimoRepository): Response
    {
        return $this->render('emprestimo/index.html.twig', ['emprestimos' => $emprestimoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="emprestimo_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $emprestimo = new Emprestimo();
        $form = $this->createForm(EmprestimoType::class, $emprestimo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emprestimo);
            $em->flush();

            return $this->redirectToRoute('emprestimo_index');
        }

        return $this->render('emprestimo/new.html.twig', [
            'emprestimo' => $emprestimo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprestimo_show", methods="GET")
     */
    public function show(Emprestimo $emprestimo): Response
    {
        return $this->render('emprestimo/show.html.twig', ['emprestimo' => $emprestimo]);
    }

    /**
     * @Route("/{id}/edit", name="emprestimo_edit", methods="GET|POST")
     */
    public function edit(Request $request, Emprestimo $emprestimo): Response
    {
        $form = $this->createForm(EmprestimoType::class, $emprestimo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emprestimo_index', ['id' => $emprestimo->getId()]);
        }

        return $this->render('emprestimo/edit.html.twig', [
            'emprestimo' => $emprestimo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprestimo_delete", methods="DELETE")
     */
    public function delete(Request $request, Emprestimo $emprestimo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emprestimo->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emprestimo);
            $em->flush();
        }

        return $this->redirectToRoute('emprestimo_index');
    }
}
