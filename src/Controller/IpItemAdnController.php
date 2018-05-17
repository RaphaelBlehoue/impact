<?php

namespace App\Controller;

use App\Entity\IpItemAdn;
use App\Form\IpItemAdnType;
use App\Repository\IpItemAdnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ip/item/adn")
 */
class IpItemAdnController extends Controller
{
    /**
     * @Route("/", name="ip_item_adn_index", methods="GET")
     * @param IpItemAdnRepository $ipItemAdnRepository
     * @return Response
     */
    public function index(IpItemAdnRepository $ipItemAdnRepository): Response
    {
        return $this->render('ip_item_adn/index.html.twig', ['ip_item_adns' => $ipItemAdnRepository->findAll()]);
    }

    /**
     * @Route("/new", name="ip_item_adn_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $ipItemAdn = new IpItemAdn();
        $form = $this->createForm(IpItemAdnType::class, $ipItemAdn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ipItemAdn);
            $em->flush();

            return $this->redirectToRoute('ip_item_adn_index');
        }

        return $this->render('ip_item_adn/new.html.twig', [
            'ip_item_adn' => $ipItemAdn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ip_item_adn_show", methods="GET")
     * @param IpItemAdn $ipItemAdn
     * @return Response
     */
    public function show(IpItemAdn $ipItemAdn): Response
    {
        return $this->render('ip_item_adn/show.html.twig', ['ip_item_adn' => $ipItemAdn]);
    }

    /**
     * @Route("/{id}/edit", name="ip_item_adn_edit", methods="GET|POST")
     * @param Request $request
     * @param IpItemAdn $ipItemAdn
     * @return Response
     */
    public function edit(Request $request, IpItemAdn $ipItemAdn): Response
    {
        $form = $this->createForm(IpItemAdnType::class, $ipItemAdn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ip_item_adn_index');
        }

        return $this->render('ip_item_adn/edit.html.twig', [
            'ip_item_adn' => $ipItemAdn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ip_item_adn_delete", methods="DELETE")
     * @param Request $request
     * @param IpItemAdn $ipItemAdn
     * @return Response
     */
    public function delete(Request $request, IpItemAdn $ipItemAdn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ipItemAdn->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ipItemAdn);
            $em->flush();
        }

        return $this->redirectToRoute('ip_item_adn_index');
    }
}
