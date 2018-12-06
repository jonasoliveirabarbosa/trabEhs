<?php

namespace App\Controller;

use App\Entity\Livro;
use App\Form\LivroType;
use App\Repository\LivroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/livro")
 */
class LivroController extends AbstractController
{
    /**
     * @Route("/", name="livro_index", methods="GET")
     */
    public function index(LivroRepository $livroRepository): Response
    {
        return $this->render('livro/index.html.twig', ['livros' => $livroRepository->findAll()]);
    }

    /**
     * @Route("/new", name="livro_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $livro = new Livro();
        $form = $this->createForm(LivroType::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livro);
            $em->flush();

            return $this->redirectToRoute('livro_index');
        }

        return $this->render('livro/new.html.twig', [
            'livro' => $livro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livro_show", methods="GET")
     */
    public function show(Livro $livro): Response
    {
        return $this->render('livro/show.html.twig', ['livro' => $livro]);
    }

    /**
     * @Route("/{id}/edit", name="livro_edit", methods="GET|POST")
     */
    public function edit(Request $request, Livro $livro): Response
    {
        $form = $this->createForm(LivroType::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livro_index', ['id' => $livro->getId()]);
        }

        return $this->render('livro/edit.html.twig', [
            'livro' => $livro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livro_delete", methods="DELETE")
     */
    public function delete(Request $request, Livro $livro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livro->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($livro);
            $em->flush();
        }

        return $this->redirectToRoute('livro_index');
    }
}
