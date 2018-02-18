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


class VotacionesController extends Controller
{
    /**
     * @Route("/votaciones", name="votaciones")
     */
    public function votacionesAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('votaciones/menu-votaciones.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            ]);
        }
        return $this->render('Security/login.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}