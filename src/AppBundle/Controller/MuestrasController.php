<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 17/11/2017
 * Time: 12:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Grupo;
use AppBundle\Entity\GrupoMuestra;
use AppBundle\Entity\GruposUsuarios;
use AppBundle\Entity\User;
use AppBundle\Entity\UsuariosMuestras;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Muestra;
use AppBundle\Form\MuestraType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class MuestrasController extends Controller
{
    /**
     * @Route("/muestras", name="muestras")
     */
    public function muestrasAction(Request $request)
    {
        $error = false;
        $mensaje = false;

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            /*
             * Recopilación de datos
             */

            // userId = Id de Usuario
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();

            // Busca grupo usuario
            $em = $this->getDoctrine()->getManager();
            $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId'=>$userId));

            // Revisar... más adelante un usuario pertenece a varios grupos
            //dump($grupoUsuario[0]);
            $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo

            $repository = $this->getDoctrine()
                ->getRepository(Grupo::class);
            $grupo = $repository->find($idGrupo);


            // Obtener id muestras asignadas a grupo
            $em2 = $this->getDoctrine()->getManager();
            $grupoMuestra = $em2->getRepository(GrupoMuestra::class)->findBy(array('grupoId'=>$idGrupo));

            /*
             * Fin Recopilacion de datos
             */

            // Comprobar metodo GET/POST
            if ($request->getMethod()=== 'GET'){
//                $method = $request->getMethod();

                // Comprueba si existen muestras para grupo
                if ($grupoMuestra){
                    // Obtener muestras y renderizar formulario

                    // usuariosMuestras = array de objetos usuariosMuestra
                    $usuariosMuestras = new ArrayCollection();
                     foreach ($grupoMuestra as $lineaGrupoMuestra){
                        // Obtener Ids Muestra para Grupo
                        $usuariosMuestrasAux = new UsuariosMuestras();

                        $muestra = $lineaGrupoMuestra->getMuestra();

                        // Comprueba si existe usuarioMuestra con muestraId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuariosMuestras::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.muestraId = :muestraId')
                            ->setParameter('userId', $userId)
                            ->setParameter('muestraId', $muestra->getId())
                            ->getQuery();

                        $usuarioMuestra = $query->getResult();

                        if($usuarioMuestra){
                            // Si existe (true)
                            $usuariosMuestrasAux = $usuarioMuestra[0];
                            $descripcion = $muestra->getDescripcion();
                            $usuariosMuestrasAux->setDescripcion($descripcion);
                        } else {
                            // Si no existe setMuestraSeleccionada(0) (false)
                            $usuariosMuestrasAux->setUsuario($user);
                            $usuariosMuestrasAux->setMuestra($muestra);
                            $usuariosMuestrasAux->setPrecio($lineaGrupoMuestra->getPrecio());
                            $usuariosMuestrasAux->setCantidad(0);
                            $descripcion = $muestra->getDescripcion();
                            $usuariosMuestrasAux->setDescripcion($descripcion);
                        }
                         $usuariosMuestras[] = $usuariosMuestrasAux;
                    }

                    // Renderiza Formulario

                    return $this->render('usuario/muestras.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => $usuariosMuestras,
                        'mensaje' => $mensaje,
                        'error' => $error,
                    ]);
                } else {
                    // No Muestras disponibles para Grupo
                    return $this->render('usuario/no-muestras.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => false,
                        'error' => ':( No hay muestras para tu grupo ):',
                        'mensaje' => $mensaje,
                    ]);
                }
            } else {
                // Method = POST
                // Comprobamos los índices que tenemos
                // de muestras a comprobar
                if ($grupoMuestra){
                    // Obtener muestras

                    // Muestras = array de objetos muestra
                    foreach ($grupoMuestra as $lineaGrupoMuestra){
                        $muestra = $lineaGrupoMuestra->getMuestra();

                        // Comprueba si existe usuarioMuestra con muestraId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuariosMuestras::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.muestraId = :muestraId')
                            ->setParameter('userId', $userId)
                            ->setParameter('muestraId', $muestra->getId())
                            ->getQuery();

                        $usuarioMuestra = $query->getResult();

                        // Obtiene de request el conjunto checkbox-idMuestra
                        $indexSelected = $request->request->get('checkbox-'.$muestra->getId().'');
                        $cantidadSelected = $request->request->get('cant-'.$muestra->getId().'');

                        // UsuarioMuestra encontrada en DB
                        if($usuarioMuestra){
                            // Si existe usuarioMuestra significa que ya esta en DB

                            // ¿Viene seleccionada de View?

                            // No -> Elimina MuestraUsuario con
                            // userId + muestraId
                            // $error = "Elimina de DB!";
                            if (!$indexSelected){
                                $em = $this->getDoctrine()->getManager();
                                $qb = $em->createQueryBuilder();
                                $query = $qb->delete('AppBundle:UsuariosMuestras', 'um')
                                    ->where('um.usuarioId = :userId')
                                    ->andwhere('um.muestraId = :muestraId')
                                    ->setParameter('userId', $userId)
                                    ->setParameter('muestraId', $muestra->getId())
                                    ->getQuery();
                                $query->execute();
                            } else {
                                // Si -> (Revisar cambios de estado)
                                if ($cantidadSelected > 0){
                                    $usuarioMuestraActualizar = $usuarioMuestra[0];
                                    $usuarioMuestraActualizar->setCantidad($cantidadSelected);
                                    $usuarioMuestraActualizar->setPrecio($lineaGrupoMuestra->getPrecio());

                                    $em = $this->getDoctrine()->getEntityManager();
                                    $em->persist($usuarioMuestraActualizar);
                                    $em->flush();
                                } else {
                                    $em = $this->getDoctrine()->getManager();
                                    $qb = $em->createQueryBuilder();
                                    $query = $qb->delete('AppBundle:UsuariosMuestras', 'um')
                                        ->where('um.usuarioId = :userId')
                                        ->andwhere('um.muestraId = :muestraId')
                                        ->setParameter('userId', $userId)
                                        ->setParameter('muestraId', $muestra->getId())
                                        ->getQuery();
                                    $query->execute();
                                }

                            }

                        } else {
                            // No existe usuarioMuestra

                            // ¿Viene seleccionada de View?
                            // Si -> guarda userId + muestraId
                            if ($indexSelected){
                                // Si -> guarda userId + muestraId
                                if ($cantidadSelected>0){
                                    $usuarioMuestraGuardar = new UsuariosMuestras();
                                    $usuarioMuestraGuardar->setPrecio($lineaGrupoMuestra->getPrecio());
                                    $usuarioMuestraGuardar->setCantidad($cantidadSelected);
                                    $usuarioMuestraGuardar->setUsuario($user);
                                    $usuarioMuestraGuardar->setMuestra($muestra);
                                    $usuarioMuestraGuardar->setEstado('seleccionada');
                                    $usuarioMuestraGuardar->setGrupo($grupo);
                                    // $error = "Gu de DB!";
                                    $em = $this->getDoctrine()->getEntityManager();
                                    $em->persist($usuarioMuestraGuardar);
                                    $em->flush();
                                }
                            }
                        }
                    }
                    $mensaje = "Se han guardado los cambios correctamente!";
                    return $this->render('usuario/muestras.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => false,
                        'error' => $error,
                        'mensaje' => $mensaje,
                    ]);
                } else {
                    // No Muestras disponibles para Grupo
                    return $this->render('usuario/no-muestras.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => false,
                        'error' => ':( No hay muestras para tu grupo ):',
                    ]);
                }

//                return $this->render('usuario/muestras.html.twig', [
//                    'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//                    'muestras' => false,
//                    'error' => $error,
//                ]);
            }
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/usuario/pedido", name="pedido-muestras")
     */
    public function pedidoAction(Request $request, \Swift_Mailer $mailer){
        // Method = POST
        // Comprobamos los índices que tenemos
        // de muestras a comprobar

        /*
         * Recopilación de datos
         */
        $error = false;
        $mensaje = false;

        // userId = Id de Usuario
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();

        // Busca grupo usuario
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId'=>$userId));

        // Revisar... más adelante un usuario pertenece a varios grupos
        $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo

        // Obtener id muestras asignadas a grupo
        $em2 = $this->getDoctrine()->getManager();
        $grupoMuestra = $em2->getRepository(GrupoMuestra::class)->findBy(array('grupoId'=>$idGrupo));

        if ($request->getMethod()=== 'GET'){
            if ($grupoMuestra){
                // Obtener muestras y renderizar formulario

                // usuariosMuestras = array de objetos usuariosMuestra
                $usuariosMuestras = new ArrayCollection();
                foreach ($grupoMuestra as $lineaGrupoMuestra){
                    // Obtener Ids Muestra para Grupo
                    $usuariosMuestrasAux = new UsuariosMuestras();

                    $muestra = $lineaGrupoMuestra->getMuestra();

                    // Comprueba si existe usuarioMuestra con muestraId y UserId
                    $repository = $this->getDoctrine()
                        ->getRepository(UsuariosMuestras::class);

                    $query = $repository->createQueryBuilder('c')
                        ->where('c.usuarioId = :userId')
                        ->andwhere('c.muestraId = :muestraId')
                        ->setParameter('userId', $userId)
                        ->setParameter('muestraId', $muestra->getId())
                        ->getQuery();

                    $usuarioMuestra = $query->getResult();

                    if($usuarioMuestra){
                        // Si existe (true)
                        $usuariosMuestrasAux = $usuarioMuestra[0];
                        $descripcion = $muestra->getDescripcion();
                        $usuariosMuestrasAux->setDescripcion($descripcion);

                        if ($usuariosMuestrasAux->getEstado() == 'pedido'){
                            $usuariosMuestras[] = $usuariosMuestrasAux;
                        }
                    }
                }
            }

            // Renderiza Lista Pedido
            if (count($usuariosMuestras)<1){
                $error = 'Actualmente no tienes nada, ve a la pestaña muestras y realiza tu pedido.';
            }

        } else {
            if ($grupoMuestra){
                // Obtener muestras y renderizar formulario

                // usuariosMuestras = array de objetos usuariosMuestra
                $usuariosMuestras = new ArrayCollection();
                foreach ($grupoMuestra as $lineaGrupoMuestra){
                    // Obtener Ids Muestra para Grupo
                    $usuariosMuestrasAux = new UsuariosMuestras();

                    $muestra = $lineaGrupoMuestra->getMuestra();

                    // Comprueba si existe usuarioMuestra con muestraId y UserId
                    $repository = $this->getDoctrine()
                        ->getRepository(UsuariosMuestras::class);

                    $query = $repository->createQueryBuilder('c')
                        ->where('c.usuarioId = :userId')
                        ->andwhere('c.muestraId = :muestraId')
                        ->setParameter('userId', $userId)
                        ->setParameter('muestraId', $muestra->getId())
                        ->getQuery();

                    $usuarioMuestra = $query->getResult();

                    if($usuarioMuestra){
                        // Si existe (true)
                        $usuariosMuestrasAux = $usuarioMuestra[0];
                        $descripcion = $muestra->getDescripcion();
                        $usuariosMuestrasAux->setDescripcion($descripcion);

                        if ($usuariosMuestrasAux->getEstado() != 'pedido'){
                            $usuariosMuestrasAux->setEstado('pedido');
                            $em = $this->getDoctrine()->getEntityManager();
                            $em->persist($usuariosMuestrasAux);
                            $em->flush();
                        }

                        $usuariosMuestras[] = $usuariosMuestrasAux;
                    }
                }
            }

            // Renderiza Lista Pedido
            if (count($usuariosMuestras)>0){
                $mensaje = 'Tu pedido se ha realizado correctamente, te enviaremos un correo'.
                    ' con las instrucciones para formalizarlo. Agradecemos tu confianza';
                $copia = "Ok!";
                // Enviar Correo
                $message = (new \Swift_Message('Apartefotografía pedido'))
                    ->setFrom('departamento.comercial@apartefotografia.es')
                    ->setTo('rubenrueda80@gmail.com')
                    ->setBody(
                        $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                            'Emails/pedido-realizado.html.twig',
                            array('muestras' => $usuariosMuestras)
                        ),
                        'text/html'
                    )
                ;

                 $mailer->send($message);
                return $this->render('usuario/pedido.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                    'muestras' => $usuariosMuestras,
                    'mensaje' => $mensaje,
                    'error' => $error,
                ]);
            } else {
                $error = 'Actualmente no tienes nada, ve a la pestaña muestras y realiza tu pedido.';
            }
        }

        return $this->render('usuario/pedido.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'muestras' => $usuariosMuestras,
                'mensaje' => $mensaje,
                'error' => $error,
            ]);
        // *** ///
//        return $this->render('usuario/pedido.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
    }

    /**
     * @Route("/muestra/new", name="muestra_new")
     */
    public function newAction(Request $request)
    {
        $muestra = new Muestra();
        $form = $this->createForm(MuestraType::class, $muestra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $muestra = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $em = $this->getDoctrine()->getManager();
             $em->persist($muestra);
             $em->flush();


            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('muestra/nueva.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}