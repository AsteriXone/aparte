<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 17/11/2017
 * Time: 12:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Grupo;
use AppBundle\Entity\UsuarioMuestraVotar;
use AppBundle\Entity\UsuariosProfes;
use AppBundle\Form\CorreoMasivoType;
use AppBundle\Form\SelectVotosProfeType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class CorreoMasivoController extends Controller
{
    /**
     * @Route("/correo-masivo", name="correo-masivo")
     */
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(CorreoMasivoType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $grupo = $form['grupo']->getData();

            // Selecciona usuarios pertenecientes al grupo
            // y envía correo
            $usuarios = $grupo->getGruposUsuarios();
//            dump($usuarios);
            $emails = new ArrayCollection();

            foreach ($usuarios as $usuario){
//                dump($usuario->getUser()->getEmail());
                $emails->add($usuario->getUser()->getEmail());
            }
//            dump($emails);
            $mensaje = $form['mensaje']->getData();
            $asunto = $form['asunto']->getData();
            // Envía correo
            $emailOrigen = $this->getUser()->getEmail();
//            dump($emailOrigen);
            $message = (new \Swift_Message('Apartefotografía'))
                ->setFrom($emailOrigen)
                ->setTo($emails[0])
                ->setBody(
                    $this->renderView(
                        'Emails/correo-masivo-enviar.html.twig',
                        array(
                            'mensaje' => $mensaje,
                            'asunto' => $asunto,
                            )
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            return $this->render('Emails/correo-masivo-enviado.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'form' => $form->createView(),
                'grupo' => 'hola',
            ]);
        }

        return $this->render('Emails/correo-masivo.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }
}