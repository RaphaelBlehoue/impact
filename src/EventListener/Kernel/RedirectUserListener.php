<?php
/**
 * Created by IntelliJ IDEA.
 * User: raphael
 * Date: 13/04/2018
 * Time: 16:39
 */

namespace App\EventListener\Kernel;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class RedirectUserListener implements EventSubscriberInterface
{


    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var UrlGeneratorInterface
     */
    private $route;

    /**
     * RedirectUserListener constructor.
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param UrlGeneratorInterface $route
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker, UrlGeneratorInterface $route)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->route = $route;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => ['RedirectUserLogged']
        ];
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function RedirectUserLogged(FilterResponseEvent $event)
    {
        $isPath = false;
        if(in_array($event->getRequest()->getPathInfo(), $this->arrayControllerList())){
            $isPath = true;
        }
        if($isPath && $this->authorizationChecker->isGranted('ROLE_USER')){
            $this->Redirector('index_page', $event);
        }
    }

    /**
     * @param $url
     * @param FilterResponseEvent $event
     */
    private function Redirector($url, FilterResponseEvent $event)
    {
        if (!$event instanceof FilterResponseEvent){
            return;
        }
        $page = $this->route->generate($url);
        $response = new RedirectResponse($page);
        $event->setResponse($response);
    }

    /**
     * Return la liste des controller devant etre inacessible par user logged
     * @return array
     */
    protected function arrayControllerList()
    {
        return array(
            '/secure/register',
            '/secure/signin'
        );
    }
}