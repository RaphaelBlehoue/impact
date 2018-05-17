<?php

namespace App\Controller;

use App\Entity\Metier;
use App\Form\MetierType;
use App\Repository\MetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/metier")
 */
class MetierController extends Controller
{
    /**
     * @Route("/", name="metier_index", methods="GET")
     * @param MetierRepository $metierRepository
     * @return Response
     */
    public function index(MetierRepository $metierRepository): Response
    {
        return $this->render('metier/index.html.twig', ['metiers' => $metierRepository->findAll()]);
    }

    /**
     * @Route("/new", name="metier_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $metier = new Metier();
        $form = $this->createForm(MetierType::class, $metier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($metier);
            $em->flush();

            return $this->redirectToRoute('metier_index');
        }

        return $this->render('metier/new.html.twig', [
            'metier' => $metier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="metier_show", methods="GET")
     * @param Metier $metier
     * @return Response
     */
    public function show(Metier $metier): Response
    {
        return $this->render('metier/show.html.twig', ['metier' => $metier]);
    }

    /**
     * @Route("/{id}/edit", name="metier_edit", methods="GET|POST")
     * @param Request $request
     * @param Metier $metier
     * @return Response
     */
    public function edit(Request $request, Metier $metier): Response
    {
        $form = $this->createForm(MetierType::class, $metier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metier_index');
        }

        return $this->render('metier/edit.html.twig', [
            'metier' => $metier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="metier_delete", methods="DELETE")
     * @param Request $request
     * @param Metier $metier
     * @return Response
     */
    public function delete(Request $request, Metier $metier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metier->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($metier);
            $em->flush();
        }

        return $this->redirectToRoute('metier_index');
    }
}
