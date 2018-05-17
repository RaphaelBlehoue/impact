<?php

namespace App\Controller;

use App\Entity\Information;
use App\Form\InformationType;
use App\Repository\InformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/information")
 */
class InformationController extends Controller
{
    /**
     * @Route("/", name="information_index", methods="GET")
     * @param InformationRepository $informationRepository
     * @return Response
     */
    public function index(InformationRepository $informationRepository): Response
    {
        return $this->render('information/index.html.twig', ['information' => $informationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="information_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $information = new Information();
        $form = $this->createForm(InformationType::class, $information);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($information);
            $em->flush();

            return $this->redirectToRoute('information_index');
        }

        return $this->render('information/new.html.twig', [
            'information' => $information,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="information_show", methods="GET")
     * @param Information $information
     * @return Response
     */
    public function show(Information $information): Response
    {
        return $this->render('information/show.html.twig', ['information' => $information]);
    }

    /**
     * @Route("/{id}/edit", name="information_edit", methods="GET|POST")
     * @param Request $request
     * @param Information $information
     * @return Response
     */
    public function edit(Request $request, Information $information): Response
    {
        $form = $this->createForm(InformationType::class, $information);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('information_index');
        }

        return $this->render('information/edit.html.twig', [
            'information' => $information,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="information_delete", methods="DELETE")
     * @param Request $request
     * @param Information $information
     * @return Response
     */
    public function delete(Request $request, Information $information): Response
    {
        if ($this->isCsrfTokenValid('delete'.$information->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($information);
            $em->flush();
        }

        return $this->redirectToRoute('information_index');
    }
}
