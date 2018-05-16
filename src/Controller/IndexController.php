<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index_page", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }


    /**
     * @Route("/notre_adn", name="page_adn" , methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function AdnPage()
    {
        return $this->render('pages/adn.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/notre_agence", name="page_agence", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function CabinetPage()
    {
        return $this->render('pages/cabinet.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/our_metiers", name="page_metier", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function MetierPage()
    {
        return $this->render('pages/metier.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/our_services", name="page_service", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function ServicePage()
    {
        return $this->render('pages/service.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/service/detail", name="page_service_detail", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function ServieDetailPage()
    {
        return $this->render('pages/service_detail.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="page_blog", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function BlogPage(){
        return $this->render('pages/blog.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/detail", name="page_blog_detail", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function BlogDetailPage(){
        return $this->render('pages/blog_detail.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nous_contactez", name="page_contact", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function ContactPage()
    {
        $form = $this->createForm(ContactType::class);
        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
