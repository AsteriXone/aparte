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
use AppBundle\Entity\ImageGallery;
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
     * @Route("/galeria", name="galerias")
     */
    public function indexAction(Request $request)
    {
        // Traer galerias de DB
        $galerias = $this->getDoctrine()
            ->getRepository(Galeria::class)
            ->findAll();
        if ($galerias){
            return $this->render('Galeria/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'galerias' => $galerias,
            ]);
        } else {
            return $this->render('Galeria/no-galerias.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'galerias' => $galerias,
            ]);
        }
    }

    /**
     * @Route("/galeria/{id}", name="galeria")
     */
    public function galleriaAction($id)
    {
        // Traer galerias de DB
        $imagenes = $this->getDoctrine()
            ->getRepository(ImageGallery::class)
            ->findBy(array('galeria' => $id));
        if($imagenes){
            $galeria = $this->getDoctrine()
                ->getRepository(Galeria::class)
                ->find($id);
            $nombre = $galeria->getNombreGaleria();

//        dump($imagenes);

            return $this->render('Galeria/galeria.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'galeria' => $imagenes,
                'nombre_galeria'=> $nombre,
            ]);
        } else {
            return $this->render('Galeria/no-imagenes-galeria.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            ]);
        }

    }
}