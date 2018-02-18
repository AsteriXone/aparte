<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 17/11/2017
 * Time: 12:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Galeria;
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


class GaleriaController extends Controller
{
    /**
     * @Route("/galeria", name="galeria")
     */
    public function indexAction(Request $request)
    {
        // Traer galerias de DB
        $galerias = $this->getDoctrine()
            ->getRepository(Galeria::class)
            ->findAll();

        return $this->render('Galeria/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'galerias' => $galerias,
        ]);
    }
}