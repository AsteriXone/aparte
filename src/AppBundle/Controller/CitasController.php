<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cuadrante;
use AppBundle\Entity\DiaCuadrante;
use AppBundle\Form\CitasType;
use AppBundle\Form\CuadranteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class CitasController extends Controller
{
    /**
     * @Route("/generar/citas", name="generar-citas")
     */
    public function generarCitasAction(Request $request)
    {
//        $cuadrante = new Cuadrante();
        $form = $this->createForm(CuadranteType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cuad = $form->get('cuadrante')->getData();
            dump($cuad);

        }
        return $this->render('citas/citas.html.twig', [
            // Enviar fecha, hora, cuadrante, usuario para usar en view
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/generar/citas-prueba", name="generar-citas-prueba")
     */
    public function generarCitasPruebaAction(Request $request)
    {
        $cuadrante = new Cuadrante();
        $form = $this->createForm(CuadranteType::class, $cuadrante);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cuad = $form->get('cuadrante')->getData();
            dump($cuad);

        }
        return $this->render('citas/citas.html.twig', [
            // Enviar fecha, hora, cuadrante, usuario para usar en view
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }
}
