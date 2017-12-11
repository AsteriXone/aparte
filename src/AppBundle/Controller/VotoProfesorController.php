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
use AppBundle\Entity\GrupoProfesor;
use AppBundle\Entity\GruposUsuarios;
use AppBundle\Entity\Profesor;
use AppBundle\Entity\User;
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


class VotoProfesorController extends Controller
{
    /**
     * @Route("/votar-profe", name="votar-profe")
     */
    public function votarProfeAction(Request $request)
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
            $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId'=>$userId));

            // Revisar... más adelante un usuario pertenece a varios grupos
            $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo

            // Obtener id profes asignados a grupo
            $em2 = $this->getDoctrine()->getManager();
            $gruposProfes = $em2->getRepository(GrupoProfesor::class)->findBy(array('grupoId'=>$idGrupo));


            /*
             * Fin Recopilacion de datos
             */

            // Comprobar metodo GET/POST
            if ($request->getMethod()=== 'GET'){
//                $method = $request->getMethod();

                // Comprueba si existen profes para grupo
                if ($gruposProfes){
                    // Obtener profes para usuario y renderizar formulario

                    // usuariosProfes = array de objetos usuariosProfes
                    $profes = new ArrayCollection();
                     foreach ($gruposProfes as $lineaGruposProfes){
//                         $profeAux = new Profesor(); // Aniadira un usuario-profe aunque no este votado

                         // Obtener Ids Profes para Grupo
                         $profe = $lineaGruposProfes->getProfesor();

//                       dump($profe->getId());

                        // Comprueba si existe usuarioProfe con profeId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuariosProfes::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.profesorId = :profeId')
                            ->setParameter('userId', $userId)
                            ->setParameter('profeId', $profe->getId())
                            ->getQuery();

                        $usuarioProfe = $query->getResult();
//                        dump($usuarioProfe);
                        if($usuarioProfe){
                            // Si existe setProfeSeleccionado(1) (true)
                            $profe->setEstado(1);
                            $profes[] = $profe;
                        } else {
                            // Si no existe setProfeSeleccionado(0) (false)
                            $profe->setEstado(0);
                            $profes[] = $profe;
                        }
                    }

                    // Renderiza Formulario

                    return $this->render('usuario/votos-profe.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'profes' => $profes,
                        'mensaje' => $mensaje,
                        'error' => $error,
                    ]);
                } else {
                    // No Profes disponibles para Grupo
                    return $this->render('usuario/no-profes.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => false,
                        'error' => ':( Aún no hay profesores registrados para tu grupo ):',
                        'mensaje' => $mensaje,
                    ]);
                }
            }
        }
        return $this->render('Security/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/votacion", name="votacion")
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

            // Obtener id profes asignados a grupo
            $em2 = $this->getDoctrine()->getManager();
            $gruposProfes = $em2->getRepository(GrupoProfesor::class)->findBy(array('grupoId' => $idGrupo));


            /*
             * Fin Recopilacion de datos
             */

            // Comprobar metodo POST
            if ($request->getMethod() === 'POST') {
                if ($gruposProfes){
                    // Obtener profes

                    // Muestras = array de objetos muestra
                    foreach ($gruposProfes as $lineaGrupoProfe){
                        $profe = $lineaGrupoProfe->getProfesor();

                        // Comprueba si existe usuarioProfe con profeId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuariosProfes::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.profesorId = :profeId')
                            ->setParameter('userId', $userId)
                            ->setParameter('profeId', $profe->getId())
                            ->getQuery();

                        $usuarioProfe = $query->getResult();

                        // Obtiene de request el conjunto
                        $indexSelected = $request->request->get('profe-'.$profe->getId().'');
//                        $cantidadSelected = $request->request->get('cant-'.$profe->getId().'');
                        dump($indexSelected);
//                        dump($cantidadSelected);


                        // UsuarioProfe encontrada en DB
                        if($usuarioProfe){
                            // Si existe usuarioProfe significa que ya esta en DB

                            // ¿Viene seleccionado de View?

                            // No -> Elimina ProfeUsuario con
                            // userId + muestraId
                            // $error = "Elimina de DB!";

                            if (!$indexSelected){
                                $em = $this->getDoctrine()->getManager();
                                $qb = $em->createQueryBuilder();
                                $query = $qb->delete('AppBundle:UsuariosProfes', 'um')
                                    ->where('um.usuarioId = :userId')
                                    ->andwhere('um.profesorId = :profesorId')
                                    ->setParameter('userId', $userId)
                                    ->setParameter('profesorId', $profe->getId())
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
                            // No existe usuarioProfe

                            // ¿Viene seleccionado de View?
                            // Si -> guarda userId + profeId
                            if ($indexSelected){
                                   $usuarioProfeGuardar = new UsuariosProfes();
                                    $usuarioProfeGuardar->setUsuario($user);
                                    $usuarioProfeGuardar->setProfesor($profe);
                                    $usuarioProfeGuardar->setGrupoPerteneciente($idGrupo);
                                    // $error = "Gu de DB!";
                                    $em = $this->getDoctrine()->getEntityManager();
                                    $em->persist($usuarioProfeGuardar);
                                    $em->flush();
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
            }
        }
    }
}