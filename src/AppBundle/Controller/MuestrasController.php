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

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            /*
             * Recopilación de datos
             */

            // userId = Id de Usuario
            $userId = $this->get('security.token_storage')->getToken()->getUser()->getId();

            // Busca grupo usuario
            $em = $this->getDoctrine()->getManager();
            $grupoUsuario = $em->getRepository(GruposUsuarios::class)->findBy(array('usuarioId'=>$userId));

            // Revisar... más adelante un usuario pertenece a varios grupos
            $idGrupo = $grupoUsuario[0]->getGrupoId(); // Id del grupo

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

                    // Muestras = array de objetos muestra
                    $muestras = new ArrayCollection();
                    foreach ($grupoMuestra as $lineaGrupoMuestra){
                        $muestraId = $lineaGrupoMuestra->getMuestraId();
                        $muestraAux = $this->getDoctrine()
                            ->getManager()
                            ->getRepository(Muestra::class)
                            ->find($muestraId);
                        // dump($muestraAux);
                        // Comprueba si existe usuarioMuestra con muestraId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuariosMuestras::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.muestraId = :muestraId')
                            ->setParameter('userId', $userId)
                            ->setParameter('muestraId', $muestraId)
                            ->getQuery();

                        $usuarioMuestra = $query->getResult();
                        if($usuarioMuestra){
                            // Si existe setMuestraSeleccionada(1) (true)
                            $muestraAux->setMuestraSeleccionada(1);
                        } else {
                            // Si no existe setMuestraSeleccionada(0) (false)
                            $muestraAux->setMuestraSeleccionada(0);
                        }
                        $muestras[] = $muestraAux;
                    }

                    // Renderiza Formulario

                    return $this->render('usuario/muestras.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => $muestras,
                        'error' => $error,
                    ]);
                } else {
                    // No Muestras disponibles para Grupo
                    return $this->render('usuario/muestras.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                        'muestras' => false,
                        'error' => ':( No hay muestras para tu grupo ):',
                    ]);
                }

            } else {
                // Method = POST
                // Comprobamos los índices que tenemos
                // de muestras a comprobar
                if ($grupoMuestra){
                    // Obtener muestras

                    // Muestras = array de objetos muestra
                    $muestras = new ArrayCollection();
                    foreach ($grupoMuestra as $lineaGrupoMuestra){
                        $muestraId = $lineaGrupoMuestra->getMuestraId();
                        $muestraAux = $this->getDoctrine()
                            ->getManager()
                            ->getRepository(Muestra::class)
                            ->find($muestraId);
                        // dump($muestraAux);

                        // Comprueba si existe usuarioMuestra con muestraId y UserId
                        $repository = $this->getDoctrine()
                            ->getRepository(UsuariosMuestras::class);

                        $query = $repository->createQueryBuilder('c')
                            ->where('c.usuarioId = :userId')
                            ->andwhere('c.muestraId = :muestraId')
                            ->setParameter('userId', $userId)
                            ->setParameter('muestraId', $muestraId)
                            ->getQuery();

                        $usuarioMuestra = $query->getResult();

                        $indAux = 'checkbox-'.$muestraId.'';
                        $indexSelected = $request->request->get($indAux);

                        if($usuarioMuestra){
                            // Si existe MuestraSeleccionada

                            // ¿Viene seleccionada de View?
                            // Si -> no hace nada porque ya esta en DB
                            if (!$indexSelected){
                                // No -> Elimina MuestraUsuario con
                                // userId + muestraId
                                // $error = "Elimina de DB!";
//                                $em = $this->getDoctrine()->getEntityManager();
//                                $usuarioMuestraEliminar = new UsuariosMuestras();
//                                $usuarioMuestraEliminar->setMuestra($muestraAux);
//                                $usuarioMuestraEliminar->setUsuario($this->get('security.token_storage')->getToken()->getUser());
//
                                $ema = $this->getDoctrine()->getManager();
                                $qb = $ema->createQueryBuilder();
                                $query = $qb->delete('AppBundle:UsuariosMuestras', 'um')
                                    ->where('um.usuarioId = :userId')
                                    ->andwhere('um.muestraId = :muestraId')
                                    ->setParameter('userId', $userId)
                                    ->setParameter('muestraId', $muestraId)
                                    ->getQuery();

                                $query->execute();
                            }

                        } else {
                            // No existe MuestraSeleccionada

                            // ¿Viene seleccionada de View?
                            // Si -> guarda userId + muestraId
                            if ($indexSelected){
                                // Si -> guarda userId + muestraId
                                $usuarioMuestraGuardar = new UsuariosMuestras();
                                $usuarioMuestraGuardar->setUsuario($this->get('security.token_storage')->getToken()->getUser());
                                $usuarioMuestraGuardar->setMuestra($muestraAux);
                                // $error = "Gu de DB!";
                                $em = $this->getDoctrine()->getEntityManager();
                                $em->persist($usuarioMuestraGuardar);
                                $em->flush();
                            }
                            // No -> No hace nada
                        }
//                        $muestras[] = $muestraAux;
                    }

                    // Renderiza Formulario

                    return $this->redirectToRoute('homepage');
                }

                $indexSelected = $request->request->get('checkbox-10');

                return $this->render('usuario/muestras.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                    'muestras' => null,
                    'error' => $indexSelected,
                ]);
            }
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
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