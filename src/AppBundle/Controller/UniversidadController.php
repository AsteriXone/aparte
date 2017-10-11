<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Universidad;
#use AppBundle\Form\UniversidadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UniversidadController extends Controller
{
    /**
     * @Route("/universidad/crear", name="universidad_crear")
     */
    public function crearAction(Request $request){
        $universidad = new Universidad();
        //$universidad->setNombre('Universidad de Sevilla');

        $form = $this->createForm(UniversidadType::class, $universidad, array());

        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($universidad);
            $em->flush();

            return $this->redirect($this->generateUrl('universidad_lista'));
        }

        return $this->render('universidad/nueva.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/universidad/editar/{id}", name="universidad_editar")
     */
    public function editarAction(Request $request, $id){
        $universidadRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Universidad');

        $universidad=$universidadRepository->find($id);


        $form = $this->createForm(UniversidadType::class, $universidad, array());

        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($universidad);
            $em->flush();

            return $this->redirect($this->generateUrl('universidad_lista'));
        }

        return $this->render('universidad/editar.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/universidad/lista", name="universidad_lista")
     */
    public function listaAction(Request $request){
        $universidadRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Universidad');

        $universidades = $universidadRepository->findAll();

        return $this->render('universidad/lista.html.twig', array(
            'universidades'=>$universidades
        ));
    }


    /**
     * @Route("/universidad/{id}", name="universidad_ver")
     */
    public function verAction(Request $request, $id){
        $universidadRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Universidad');

        $universidad = $universidadRepository->find($id);

        return new Response('Universidad con id: '.$universidad->getId());
    }


    /**
     * @Route("/buscar/universidad/{nombre}", name="universidad_buscar")
     */
    public function buscarAction(Request $request, $nombre){
        $universidadRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Universidad');

        $universidades = $universidadRepository->buscarPorNombre($nombre);
        print_r($universidades);

        //return new Response('Universidad con id: '.$universidad->getId());
    }
}
