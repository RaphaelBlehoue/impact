<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Form\CabinetType;
use App\Repository\CabinetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cabinet")
 */
class CabinetController extends Controller
{
    /**
     * @Route("/", name="cabinet_index", methods="GET")
     * @param CabinetRepository $cabinetRepository
     * @return Response
     */
    public function index(CabinetRepository $cabinetRepository): Response
    {
        return $this->render('cabinet/index.html.twig', ['cabinets' => $cabinetRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cabinet_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $cabinet = new Cabinet();
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cabinet);
            $em->flush();

            return $this->redirectToRoute('cabinet_index');
        }

        return $this->render('cabinet/new.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cabinet_show", methods="GET")
     * @param Cabinet $cabinet
     * @return Response
     */
    public function show(Cabinet $cabinet): Response
    {
        return $this->render('cabinet/show.html.twig', ['cabinet' => $cabinet]);
    }

    /**
     * @Route("/{id}/edit", name="cabinet_edit", methods="GET|POST")
     * @param Request $request
     * @param Cabinet $cabinet
     * @return Response
     */
    public function edit(Request $request, Cabinet $cabinet): Response
    {
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cabinet_index');
        }

        return $this->render('cabinet/edit.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cabinet_delete", methods="DELETE")
     * @param Request $request
     * @param Cabinet $cabinet
     * @return Response
     */
    public function delete(Request $request, Cabinet $cabinet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cabinet->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cabinet);
            $em->flush();
        }

        return $this->redirectToRoute('cabinet_index');
    }
}
