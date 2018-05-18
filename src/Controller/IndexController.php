<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Service;
use App\Form\ContactType;
use App\Repository\ApprochRepository;
use App\Repository\CabinetRepository;
use App\Repository\FounderRepository;
use App\Repository\InformationRepository;
use App\Repository\IpadnRepository;
use App\Repository\MetierRepository;
use App\Repository\PartnerRepository;
use App\Repository\PostRepository;
use App\Repository\ServiceRepository;
use App\Repository\VideoRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index_page", methods={"GET"}, schemes={"%secure_channel%"})
     * @param IpadnRepository $ipadnRepository
     * @param CabinetRepository $cabinetRepository
     * @param MetierRepository $metierRepository
     * @param VideoRepository $videoRepository
     * @param PostRepository $postRepository
     * @param ServiceRepository $serviceRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(
        IpadnRepository $ipadnRepository,
        CabinetRepository $cabinetRepository,
        MetierRepository $metierRepository,
        VideoRepository $videoRepository,
        PostRepository $postRepository,
        ServiceRepository $serviceRepository,
        PartnerRepository $partnerRepository
    )
    {
        $adn = $ipadnRepository->findAllWithChildren();
        return $this->render('index/index.html.twig',[
            'adn' => $adn,
            'cabinets' => $cabinetRepository->findOne(),
            'metiers'  => $metierRepository->findAll(),
            'videos'   => $videoRepository->findOne(),
            'posts'    => $postRepository->getPostLimited(5),
            'counts'   => $postRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'partners' => $partnerRepository->findAll()
        ]);
    }


    /**
     * @Route("/notre_adn", name="page_adn" , methods={"GET"}, schemes={"%secure_channel%"})
     * @param IpadnRepository $ipadnRepository
     * @param PartnerRepository $partnerRepository
     * @param VideoRepository $videoRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function AdnPage(IpadnRepository $ipadnRepository, PartnerRepository $partnerRepository, VideoRepository $videoRepository)
    {
        $adn = $ipadnRepository->findAllWithChildren();
        $video = $videoRepository->findOne();
        return $this->render('pages/adn.html.twig',[
            'adn'      => $adn,
            'partners' => $partnerRepository->findAll(),
            'videos'    => $video
        ]);
    }

    /**
     * @param FounderRepository $founderRepository
     * @param CabinetRepository $cabinetRepository
     * @param PartnerRepository $partnerRepository
     * @param ApprochRepository $approchRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/notre_agence", name="page_agence", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function CabinetPage(
        FounderRepository $founderRepository,
        CabinetRepository $cabinetRepository,
        PartnerRepository $partnerRepository,
        ApprochRepository $approchRepository
    )
    {
        return $this->render('pages/cabinet.html.twig',[
            'founders' => $founderRepository->findOne(),
            'cabinets'  => $cabinetRepository->findOne(),
            'partners' => $partnerRepository->findAll(),
            'approchs' => $approchRepository->findAll()
        ]);
    }

    /**
     * @param MetierRepository $metierRepository
     * @param InformationRepository $informationRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/our_metiers", name="page_metier", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function MetierPage(MetierRepository $metierRepository, InformationRepository $informationRepository)
    {
        return $this->render('pages/metier.html.twig',[
            'metiers' => $metierRepository->findAll(),
            'contacts' => $informationRepository->findAll()
        ]);
    }

    /**
     * @param ServiceRepository $serviceRepository
     * @param InformationRepository $informationRepository
     * @param PartnerRepository $partnerRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/our_services", name="page_service", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function ServicePage(ServiceRepository $serviceRepository, InformationRepository $informationRepository, PartnerRepository $partnerRepository)
    {
        return $this->render('pages/service.html.twig',[
            'contacts' => $informationRepository->findAll(),
            'partners' => $partnerRepository->findAll(),
            'services' => $serviceRepository->findAll()
        ]);
    }

    /**
     * @param Service $service
     * @param PartnerRepository $partnerRepository
     * @param InformationRepository $informationRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/service/{id}/detail", name="page_service_detail", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function ServieDetailPage(Service $service, PartnerRepository $partnerRepository, InformationRepository $informationRepository)
    {
        return $this->render('pages/service_detail.html.twig',[
            'service' => $service,
            'contacts' => $informationRepository->findAll(),
            'partners' => $partnerRepository->findAll()
        ]);
    }

    /**
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog", name="page_blog", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function BlogPage(PostRepository $postRepository){
        return $this->render('pages/blog.html.twig',[
            'posts' => $postRepository->getPostLimited(30)
        ]);
    }

    /**
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/{id}/detail", name="page_blog_detail", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function BlogDetailPage(Post $post){
        return $this->render('pages/blog_detail.html.twig',[
            'post' => $post
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/nous_contactez", name="page_contact", methods={"GET"}, schemes={"%secure_channel%"})
     */
    public function ContactPage(InformationRepository $informationRepository)
    {
        $form = $this->createForm(ContactType::class);
        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
            'contacts' => $informationRepository->findAll()
        ]);
    }
}
