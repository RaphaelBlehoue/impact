<?php

namespace App\Controller;

use App\Entity\Founder;
use App\Form\FounderType;
use App\Repository\FounderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/founder")
 */
class FounderController extends Controller
{
    /**
     * @Route("/", name="founder_index", methods="GET")
     */
    public function index(FounderRepository $founderRepository): Response
    {
        return $this->render('founder/index.html.twig', ['founders' => $founderRepository->findAll()]);
    }

    /**
     * @Route("/new", name="founder_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $founder = new Founder();
        $form = $this->createForm(FounderType::class, $founder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($founder);
            $em->flush();

            return $this->redirectToRoute('founder_index');
        }

        return $this->render('founder/new.html.twig', [
            'founder' => $founder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="founder_show", methods="GET")
     */
    public function show(Founder $founder): Response
    {
        return $this->render('founder/show.html.twig', ['founder' => $founder]);
    }

    /**
     * @Route("/{id}/edit", name="founder_edit", methods="GET|POST")
     */
    public function edit(Request $request, Founder $founder): Response
    {
        $form = $this->createForm(FounderType::class, $founder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('founder_edit', ['id' => $founder->getId()]);
        }

        return $this->render('founder/edit.html.twig', [
            'founder' => $founder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="founder_delete", methods="DELETE")
     */
    public function delete(Request $request, Founder $founder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$founder->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($founder);
            $em->flush();
        }

        return $this->redirectToRoute('founder_index');
    }
}
