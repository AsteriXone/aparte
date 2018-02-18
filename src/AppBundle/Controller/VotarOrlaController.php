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
use AppBundle\Entity\GrupoMuestraVotar;
use AppBundle\Entity\GrupoProfesor;
use AppBundle\Entity\GruposUsuarios;
use AppBundle\Entity\Profesor;
use AppBundle\Entity\User;
use AppBundle\Entity\UsuarioMuestraVotar;
use AppBundle\Entity\UsuariosMuestras;
use AppBundle\Entity\UsuariosProfes;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Muestra;
use AppBundle\Form\MuestraType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class VotarOrlaController extends Controller
{
    /**
     * @Route("/votar-muestras", name="votar-muestras")
     */
    public function votarMuestrasAction(Request $request)
    {
        $error = false;
        $mensaje = false;

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            /*
             * Recopilación de datos
             */
//            dump($error);
            // userId = Id de Usuario
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();

            // Busca grupo usuario
            $em = $this->getDoctrine()->getManager();
            $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId' => $userId));

            // Revisar... más adelante un usuario pertenece a varios grupos
            $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo
            $grupo = $grupoUsuario[0]->getGrupo();

//            dump($grupo->getIsVotosProfe());

            // getIsVotosMuestra() comprueba si admin activa o desactiva esta operacion

            if (!$grupo-> getIsVotosMuestra()) {
                return $this->render('usuario/no-votacion-muestras.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                ]);
            } else {
                // Obtener id muestras asignadas a grupo
                $em2 = $this->getDoctrine()->getManager();
                $gruposMuestrasVotar = $em2->getRepository(GrupoMuestraVotar::class)->findBy(array('grupoId' => $idGrupo));


                /*
                 * Fin Recopilacion de datos
                 */

                // Comprobar metodo GET/POST
                if ($request->getMethod() === 'GET') {
    //                $method = $request->getMethod();

                    // Comprueba si existen muestras-votar para grupo
                    if ($gruposMuestrasVotar) {
                        // Obtener muestras para usuario y renderizar formulario

                        // usuariosProfes = array de objetos usuariosProfes
                        $muestras = new ArrayCollection();
                        foreach ($gruposMuestrasVotar as $lineaGruposMuestrasVotar) {
    //
                            // Obtener Ids Muestra para Grupo
                            $muestraVotar = $lineaGruposMuestrasVotar->getMuestraVotar();

    //                       dump($profe->getId());

                            // Comprueba si existe usuarioMuestra con muestraId y UserId
                            $repository = $this->getDoctrine()
                                ->getRepository(UsuarioMuestraVotar::class);

                            $query = $repository->createQueryBuilder('c')
                                ->where('c.usuarioId = :userId')
                                ->andwhere('c.muestraVotarId = :muestraVotarId')
                                ->setParameter('userId', $userId)
                                ->setParameter('muestraVotarId', $muestraVotar->getId())
                                ->getQuery();

                            $usuarioMuestraVotar = $query->getResult();
    //                        dump($usuarioProfe);
                            if ($usuarioMuestraVotar) {
                                // Si existe setProfeSeleccionado(1) (true)
                                $muestraVotar->setEstado(1);
                                $muestras[] = $muestraVotar;
                            } else {
                                // Si no existe setProfeSeleccionado(0) (false)
                                $muestraVotar->setEstado(0);
                                $muestras[] = $muestraVotar;
                            }
                        }

                        // Renderiza Formulario

                        return $this->render('usuario/votos-muestra.html.twig', [
                            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                            'muestras' => $muestras,
                            'mensaje' => $mensaje,
                            'error' => $error,
                        ]);
                    } else {
                        // No MuestrasVotar disponibles para Grupo
                        return $this->render('usuario/no-muestras.html.twig', [
                            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
                            'muestras' => false,
                            'error' => ':( Aún no hay Muestras registradas para tu grupo ):',
                            'mensaje' => $mensaje,
                        ]);
                    }
                }
            }
        }
        return $this->render('Security/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/votacion-muestras", name="votacion-muestras")
     */
    public function votacionAction(Request $request)
    {
        $error = false;
        $mensaje = false;

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            /*
             * Recopilación de datos
             */
//            dump($error);
            // userId = Id de Usuario
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $user->getId();

            // Busca grupo usuario
            $em = $this->getDoctrine()->getManager();
            $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId' => $userId));

            // Revisar... más adelante un usuario pertenece a varios grupos
            $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo

            // Obtener id muestrasVotar asignados a grupo
            $em2 = $this->getDoctrine()->getManager();
            $gruposMuestrasVotar = $em2->getRepository(GrupoMuestraVotar::class)->findBy(array('grupoId' => $idGrupo));


            /*
             * Fin Recopilacion de datos
             */

            // Comprobar metodo POST
            if ($request->getMethod() === 'POST') {
                if ($gruposMuestrasVotar){
                    // Obtener profes

                    // Muestras = array de objetos muestra
                    foreach ($gruposMuestrasVotar as $lineaGrupoMuestraVotar){
                        $muestraVotar = $lineaGrupoMuestraVotar->getMuestraVotar();

                        // Comprueba si existe usuarioMuestraVotar con muestraVotarId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuarioMuestraVotar::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.muestraVotarId = :muestraVotarId')
                            ->setParameter('userId', $userId)
                            ->setParameter('muestraVotarId', $muestraVotar->getId())
                            ->getQuery();

                        $usuarioMuestraVotar = $query->getResult();

                        // Obtiene de request el conjunto
                        $indexSelected = $request->request->get('muestra-'.$muestraVotar->getId().'');
//                        $cantidadSelected = $request->request->get('cant-'.$profe->getId().'');
//                        dump($indexSelected);
//                        dump($cantidadSelected);


                        // UsuarioMuestraVotar encontrada en DB
                        if($usuarioMuestraVotar){
                            // Si existe usuarioProfe significa que ya esta en DB

                            // ¿Viene seleccionado de View?

                            // No -> Elimina ProfeUsuario con
                            // userId + muestraId
                            // $error = "Elimina de DB!";

                            if (!$indexSelected){
                                $em = $this->getDoctrine()->getManager();
                                $qb = $em->createQueryBuilder();
                                $query = $qb->delete('AppBundle:UsuarioMuestraVotar', 'um')
                                    ->where('um.usuarioId = :userId')
                                    ->andwhere('um.muestraVotarId = :muestraVotarId')
                                    ->setParameter('userId', $userId)
                                    ->setParameter('muestraVotarId', $muestraVotar->getId())
                                    ->getQuery();
                                $query->execute();
                            } else {
                                // Si -> (Revisar cambios de estado)
//                                if ($cantidadSelected > 0){
//                                    $usuarioMuestraActualizar = $usuarioMuestra[0];
//                                    $usuarioMuestraActualizar->setCantidad($cantidadSelected);
//                                    $usuarioMuestraActualizar->setPrecio($lineaGrupoMuestra->getPrecio());
//
//                                    $em = $this->getDoctrine()->getEntityManager();
//                                    $em->persist($usuarioMuestraActualizar);
//                                    $em->flush();
//                                } else {
//                                    $em = $this->getDoctrine()->getManager();
//                                    $qb = $em->createQueryBuilder();
//                                    $query = $qb->delete('AppBundle:UsuariosMuestras', 'um')
//                                        ->where('um.usuarioId = :userId')
//                                        ->andwhere('um.muestraId = :muestraId')
//                                        ->setParameter('userId', $userId)
//                                        ->setParameter('muestraId', $muestra->getId())
//                                        ->getQuery();
//                                    $query->execute();
//                                }

                            }

                        } else {
                            // No existe usuarioMuestraVotar

                            // ¿Viene seleccionado de View?
                            // Si -> guarda userId + muestraVotarId
                            if ($indexSelected){
                                $usuarioMuestraVotarGuardar = new UsuarioMuestraVotar();
                                $usuarioMuestraVotarGuardar->setUsuario($user);
                                $usuarioMuestraVotarGuardar->setMuestraVotar($muestraVotar);
                                $usuarioMuestraVotarGuardar->setGrupoPerteneciente($idGrupo);
                                    // $error = "Gu de DB!";
                                    $em = $this->getDoctrine()->getEntityManager();
                                    $em->persist($usuarioMuestraVotarGuardar);
                                    $em->flush();
                            }
                        }
                    }
                    $mensaje = "Se ha guardado tu votación correctamente!";
                    return $this->render('usuario/votacion-muestras.html.twig', [
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
            }
        }
    }
}