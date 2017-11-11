<?php
// src/AppBundle/Controller/RegistrationController.php

namespace AppBundle\Controller;

use AppBundle\Entity\Grupo;
use AppBundle\Entity\GruposUsuarios;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $groupcode = $form['groupcode']->getData();

                if ($groupcode){

                    // Usuario introduce codigo-grupo
                    // Se comprueba codigo
                    $grupo = $this->getDoctrine()
                        ->getRepository(Grupo::class)
                        ->findBy(
                            array('codigoGrupo' => $groupcode)
                        );

                    // Si hay codigo asignado a grupo
                    if ($grupo) {
                        $event = new FormEvent($form, $request);
                        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                        $user->addRole("ROLE_USER");
                        $userManager->updateUser($user);

                        /*****************************************************
                         * Add new functionality (e.g. log the registration) *
                         *****************************************************/


                        // Persist User to DB && asign to group-user
                        $idGrupo = $grupo[0];

                        $gruposUsuarios = new GruposUsuarios();
                        $gruposUsuarios->setGrupo($idGrupo);
                        $gruposUsuarios->setUser($user);

                        $em2 = $this->getDoctrine()->getManager();
                        $em2->persist($gruposUsuarios);
                        $em2->flush();

                        if (null === $response = $event->getResponse()) {
                            $url = $this->generateUrl('fos_user_registration_confirmed');
                            $response = new RedirectResponse($url);
                        }

                        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                        return $response;
                    } else {
                        // Error no coincide código de grupo en DB
                        $form->get('groupcode')->addError(new FormError('El código no es válido!!'));
                        $session = $request->getSession();
                        $session->getFlashBag()->add('error', 'Error en código grupo!');
                    }
                } else {
                    // Error no se ha introducido código grupo
                    $form->get('groupcode')->addError(new FormError('Debes introducir un código!'));
                    $session = $request->getSession();
                    $session->getFlashBag()->add('error', 'Error en código grupo!');
                }
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}