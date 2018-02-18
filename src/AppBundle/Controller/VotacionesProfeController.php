<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 17/11/2017
 * Time: 12:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Grupo;
use AppBundle\Entity\UsuariosProfes;
use AppBundle\Form\SelectVotosProfeType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class VotacionesProfeController extends Controller
{
    /**
     * @Route("/votaciones-profe", name="votaciones-profe")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SelectVotosProfeType::class);

        $form->handleRequest($request);
        $votaciones = 0;
        if ($form->isSubmitted() && $form->isValid()) {
//            $grupo = new Grupo();
//            $grupo = $form['grupo']->getData();
            $grupoConsulta = $form['grupo']->getData();
            $idGrupo = $grupoConsulta->getId();

            // Obtener todos los profes del grupo
            $profesoresGrupo = $grupoConsulta->getGruposProfesores();
//            dump($profesoresGrupo);
            foreach ($profesoresGrupo as $profesorGrupo){
                $votaciones++;
                $profesor = $profesorGrupo->getProfesor();

                // Contar en Usuarios-Profesores cuantas veces aparece un profesor en el grupo


                $repository = $this->getDoctrine()->getManager()->getRepository(UsuariosProfes::class);

                $qb = $repository->createQueryBuilder('p');
                $qb->select('count(p.id)')
                    ->where('p.profesorId = :idProfe')
                    ->andwhere('p.grupoPerteneciente = :idGrupo')
                    ->setParameter('idGrupo', $idGrupo)
                    ->setParameter('idProfe', $profesor->getId());
                $query = $qb->getQuery();
                $votos = $query->getSingleScalarResult();

                $profesor->setNumeroVotos($votos);
//                dump('Id Profe: '.$profesor->getId().'->'.$profesor->getNumeroVotos());
            }

            return $this->render('votaciones/resultado-votaciones-profe.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'form' => $form->createView(),
                'profesores' => $profesoresGrupo,
                'grupo' => $grupoConsulta,
                'votaciones' => $votaciones,
            ]);
        }
        return $this->render('votaciones/votaciones-profe.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }
}