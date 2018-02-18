<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 17/11/2017
 * Time: 12:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Grupo;
use AppBundle\Entity\UsuarioMuestraVotar;
use AppBundle\Entity\UsuariosProfes;
use AppBundle\Form\SelectVotosProfeType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class VotacionesMuestraController extends Controller
{
    /**
     * @Route("/votaciones-muestra", name="votaciones-muestra")
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

            // Obtener todos las muestras del grupo
            $muestrasVotarGrupo = $grupoConsulta->getGruposMuestrasVotar();
//            dump($muestrasVotarGrupo);
            foreach ($muestrasVotarGrupo as $muestraVotarGrupo){
                $votaciones++;
                $muestraVotar = $muestraVotarGrupo->getMuestraVotar();
//                dump($muestraVotar);
                // Contar en UsuarioMuestraVotar cuantas veces aparece una muestra en el grupo


                $repository = $this->getDoctrine()->getManager()->getRepository(UsuarioMuestraVotar::class);

                $qb = $repository->createQueryBuilder('p');
                $qb->select('count(p.id)')
                    ->where('p.muestraVotarId = :idMuestraVotar')
                    ->andwhere('p.grupoPerteneciente = :idGrupo')
                    ->setParameter('idGrupo', $idGrupo)
                    ->setParameter('idMuestraVotar', $muestraVotar->getId());
                $query = $qb->getQuery();
                $votos = $query->getSingleScalarResult();

                $muestraVotar->setNumeroVotos($votos);
//                dump('Id Profe: '.$muestraVotar->getId().'->'.$muestraVotar->getNumeroVotos());
            }
//            dump ($muestrasVotarGrupo);

            return $this->render('votaciones/resultado-votaciones-muestras.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'form' => $form->createView(),
                'muestras' => $muestrasVotarGrupo,
                'grupo' => $grupoConsulta,
                'votaciones' => $votaciones,
            ]);
        }
        return $this->render('votaciones/votaciones-muestra.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
        ]);
    }
}