<?php

namespace App\Controller;

use App\Entity\Ipadn;
use App\Form\IpadnType;
use App\Repository\IpadnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ipadn")
 */
class IpadnController extends Controller
{
    /**
     * @Route("/", name="ipadn_index", methods="GET")
     * @param IpadnRepository $ipadnRepository
     * @return Response
     */
    public function index(IpadnRepository $ipadnRepository): Response
    {
        return $this->render('ipadn/index.html.twig', ['ipadns' => $ipadnRepository->findAll()]);
    }

    /**
     * @Route("/new", name="ipadn_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $ipadn = new Ipadn();
        $form = $this->createForm(IpadnType::class, $ipadn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ipadn);
            $em->flush();

            return $this->redirectToRoute('ipadn_index');
        }

        return $this->render('ipadn/new.html.twig', [
            'ipadn' => $ipadn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ipadn_show", methods="GET")
     * @param Ipadn $ipadn
     * @return Response
     */
    public function show(Ipadn $ipadn): Response
    {
        return $this->render('ipadn/show.html.twig', ['ipadn' => $ipadn]);
    }

    /**
     * @Route("/{id}/edit", name="ipadn_edit", methods="GET|POST")
     * @param Request $request
     * @param Ipadn $ipadn
     * @return Response
     */
    public function edit(Request $request, Ipadn $ipadn): Response
    {
        $form = $this->createForm(IpadnType::class, $ipadn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ipadn_index');
        }

        return $this->render('ipadn/edit.html.twig', [
            'ipadn' => $ipadn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ipadn_delete", methods="DELETE")
     * @param Request $request
     * @param Ipadn $ipadn
     * @return Response
     */
    public function delete(Request $request, Ipadn $ipadn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ipadn->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ipadn);
            $em->flush();
        }

        return $this->redirectToRoute('ipadn_index');
    }
}
