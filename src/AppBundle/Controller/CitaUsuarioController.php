<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Citas;
use AppBundle\Entity\Cuadrante;
use AppBundle\Entity\CuadranteGrupo;
use AppBundle\Entity\GruposUsuarios;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CitaUsuarioController extends Controller
{
    /**
     * @Route("/usuario/cita", name="usuario_cita")
     */
    public function usuarioCitaAction(Request $request, \Swift_Mailer $mailer)
    {
        // Usuario Logueado
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            /*
             * Recopilación de datos
             */
            // userId = Id de Usuario
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();

            // Comprobamos si el usuario ya tiene una cita

            $em = $this->getDoctrine()->getManager();
            $isCita = $em->getRepository(Citas::class)->findBy(array('user'=>$user));

            if(!$isCita) {
                // Grupo al que pertenece usuario
                $em = $this->getDoctrine()->getManager();
                $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId' => $userId));

                // Revisar... más adelante un usuario pertenece a varios grupos
                $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo

                // Obtener cuadrantes que pertenecen al grupo
                $em2 = $this->getDoctrine()->getManager();
                $cuadrantesGrupo = $em2->getRepository(CuadranteGrupo::class)->findBy(array('grupo' => $idGrupo));

//            dump($cuadrantesGrupo);

                // Buscar citas que hay para cada cuadrante
                // comprobar si están disponibles o no ¿?
                $cuadrantes = new ArrayCollection();

                foreach ($cuadrantesGrupo as $lineaCuadranteGrupo) {
                    $cuadrantes[] = $lineaCuadranteGrupo->getCuadrante();
                }


//            dump($cuadrantes);

//            $em3 = $this->getDoctrine()->getManager();
//            $citas = $em3->getRepository(Citas::class)->findBy(array('cuadrante'=>$cuadrantesGrupo[1]->getCuadrante()));

                $citasPorCuadrante = new ArrayCollection();
                foreach ($cuadrantes as $cuadrante) {
                    $em3 = $this->getDoctrine()->getManager();
                    $citasPorCuadrante[] = $em3->getRepository(Citas::class)->findBy(array('cuadrante' => $cuadrante->getId()));
                }


//            dump($citasPorCuadrante);

                $citas = new ArrayCollection();
                foreach ($citasPorCuadrante as $citaCuadrante) {
                    foreach ($citaCuadrante as $cita) {
                        $citas[] = $cita;
                    }
                }
                if (count($citas)<1){
                    return $this->render('usuario/no-citas.html.twig', [
                        // Enviar fecha, hora, cuadrante, usuario para usar en view

                        'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    ]);
                }
//            dump($citas);
                // Methodo GET
                if ($request->getMethod() === 'GET') {

                    return $this->render('usuario/citas.html.twig', [
                        // Enviar fecha, hora, cuadrante, usuario para usar en view

                        'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                        'error' => false,
                        'citas' => $citas,
                        'usuario' => $user,
                    ]);
                } else {
                    // Methodo POST

                    $citaAceptada = $request->get('cita');

                    $em = $this->getDoctrine()->getManager();
                    $cita = $em->getRepository(Citas::class)->find($citaAceptada);

                    $cita->setUser($user);

                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($cita);
                    $em->flush();

                    // Envía correo
                    $message = (new \Swift_Message('Apartefotografía citas'))
                        ->setFrom('departamento.comercial@apartefotografia.es')
                        ->setTo($user->getEmail())
                        ->setBody(
                            $this->renderView(
                                'Emails/cita-nueva.html.twig',
                                array('cita' => $cita)
                            ),
                            'text/html'
                        )
                    ;

                    $mailer->send($message);

                    return $this->render('usuario/cita-actual.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                        'error' => 'Id: ' . $citaAceptada,
                        'cita' => $cita,
                    ]);
                }
            } else{
                // Usuario tiene cita cogida
                return $this->render('usuario/cita-actual.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                    'cita' => $isCita[0],
                    ]);
            }
        } else {
            // Usuario NO logueado
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'error' => 'Ops! Estamos trabajando para solucionarlo pronto...',
//            '' =>
            ]);
        }
    }
    /**
     * @Route("/usuario/cancelar-cita", name="cancelar-cita")
     */
    public function cancelarCitaAction(Request $request, \Swift_Mailer $mailer)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            /*
             * Usuario Logueado
             * Recopilación de datos
             */
            // userId = Id de Usuario
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();

            // Comprobamos si el usuario ya tiene una cita

            $em = $this->getDoctrine()->getManager();
            $isCita = $em->getRepository(Citas::class)->findBy(array('user'=>$user));

            if($isCita) {
                // Usuario tiene una cita
                // Deja libre cita en DB
                $isCita[0]->setUser(null);
                $em->persist($isCita[0]);
                $em->flush();

                // Envía correo
                $message = (new \Swift_Message('Apartefotografía citas'))
                    ->setFrom('departamento.comercial@apartefotografia.es')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'Emails/cita-anulada.html.twig',
                            array('cita' => $isCita[0])
                        ),
                        'text/html'
                    )
                ;

                $mailer->send($message);

                return $this->render('usuario/cancelar-cita.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                ]);
            } else {
                // Usuario NO tiene una cita
                return $this->redirectToRoute('usuario_cita');

            }
        } else {
            // Usuario NO logueado
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                'error' => 'Ops! Estamos trabajando para solucionarlo pronto...',
            ]);
        }
    }
}
