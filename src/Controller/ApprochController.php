<?php

namespace App\Controller;

use App\Entity\Approch;
use App\Form\ApprochType;
use App\Repository\ApprochRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/approch")
 */
class ApprochController extends Controller
{
    /**
     * @Route("/", name="approch_index", methods="GET")
     */
    public function index(ApprochRepository $approchRepository): Response
    {
        return $this->render('approch/index.html.twig', ['approches' => $approchRepository->findAll()]);
    }

    /**
     * @Route("/new", name="approch_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $approch = new Approch();
        $form = $this->createForm(ApprochType::class, $approch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($approch);
            $em->flush();

            return $this->redirectToRoute('approch_index');
        }

        return $this->render('approch/new.html.twig', [
            'approch' => $approch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="approch_show", methods="GET")
     */
    public function show(Approch $approch): Response
    {
        return $this->render('approch/show.html.twig', ['approch' => $approch]);
    }

    /**
     * @Route("/{id}/edit", name="approch_edit", methods="GET|POST")
     */
    public function edit(Request $request, Approch $approch): Response
    {
        $form = $this->createForm(ApprochType::class, $approch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('approch_edit', ['id' => $approch->getId()]);
        }

        return $this->render('approch/edit.html.twig', [
            'approch' => $approch,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="approch_delete", methods="DELETE")
     */
    public function delete(Request $request, Approch $approch): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approch->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($approch);
            $em->flush();
        }

        return $this->redirectToRoute('approch_index');
    }
}
