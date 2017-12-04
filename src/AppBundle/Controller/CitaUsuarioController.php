<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CitaUsuarioController extends Controller
{
    /**
     * @Route("/usuario/cita", name="usuario_cita")
     */
    public function usuarioCitaAction(Request $request){
        return $this->render('usuario/citas.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'error' => 'Ops! Estamos trabajando para solucionarlo pronto...',
        ]);
    }
}
