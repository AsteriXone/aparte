<?php
/**
 * Created by PhpStorm.
 * User: Rubén Rueda Torres
 * Date: 04/11/2017
 * Time: 0:48
 */

namespace AppBundle\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManager;

class RegistrationSuccessListener implements EventSubscriberInterface
{

    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS =>array ('onUserRegistrationSuccess', -10),
        );
    }

    public function onUserRegistrationSuccess(FormEvent $event)
    {
    }
}