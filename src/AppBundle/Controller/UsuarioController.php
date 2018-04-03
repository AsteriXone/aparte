<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GruposUsuarios;
use AppBundle\Entity\ImageOrla;
use AppBundle\Entity\Incidencia;
use AppBundle\Form\IncidenciaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario/incidencia", name="incidencia")
     */
    public function usuarioIncidenciaAction(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(IncidenciaType::class);
        $form->handleRequest($request);
        $isIncidencia = false;

        if ($form->isSubmitted() && $form->isValid()) {
            // Usuario
            $user = $this->get('security.token_storage')->getToken()->getUser();

            // Grupo al que pertenece usuario
            $em = $this->getDoctrine()->getManager();
            $grupoUsuario = $em->getRepository(GruposUsuarios::class)->find($user);

            // Comprobar si ya existe incidencia en Grupo-Usuario
            $em = $this->getDoctrine()->getManager();
            $existeIncidencia = $em->getRepository(Incidencia::class)->findBy(array('grupo_usuario'=>$grupoUsuario));
            if ($existeIncidencia){
                $isIncidencia = true;
            }
            // Obteniendo datos del formulario
            $data = $form->getData();

            // Genera incidencia
            $incidencia = new Incidencia();

            // Aniadir grupoUsuario a incidencia
            $incidencia->setGrupoUsuario($grupoUsuario);

            // Aniadir incidencia a nueva incidencia
            $incidencia->setIncidencia($data['incidencia']);

            // Persiste incidencia
            $em = $this->getDoctrine()->getManager();
            $em->persist($incidencia);
            $em->flush();

            // Devuelve vista incidencia enviada
            return $this->render('default/contactar-enviado.html.twig');
        }

        return $this->render('usuario/incidencia.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'form' => $form->createView(),
            'isIncidencia' => $isIncidencia,
        ]);
    }

    /**
     * @Route("/orla-provisional", name="orla-provisional")
     */
    public function orlaProvisionalAction(Request $request)
    {
        $form = $this->createForm(IncidenciaType::class);
        $form->handleRequest($request);
        $isIncidencia = false;

        // Usuario
        $user = $this->get('security.token_storage')->getToken()->getUser();

        // Grupo al que pertenece usuario
        $em = $this->getDoctrine()->getManager();
        $grupoUsuario = $em->getRepository(GruposUsuarios::class)
            ->findBy(array('user' => $user));


        if ($form->isSubmitted() && $form->isValid()) {

            // Obteniendo datos del formulario
            $data = $form->getData();

            // Genera incidencia
            $incidencia = new Incidencia();

            // Aniadir grupoUsuario a incidencia
            $incidencia->setGrupoUsuario($grupoUsuario);

            // Aniadir incidencia a nueva incidencia
            $incidencia->setIncidencia($data['incidencia']);

            // Persiste incidencia
            $em = $this->getDoctrine()->getManager();
            $em->persist($incidencia);
            $em->flush();

            // Devuelve vista incidencia enviada
            return $this->render('default/incidencia-enviada.html.twig');
        }

//        $grupo = $grupoUsuario->getGrupo();

        // Traer galerias de DB

        $idGrupo = $grupoUsuario[0]->getGrupo()->getId();
        $imagenes = $this->getDoctrine()
            ->getRepository(ImageOrla::class)
            ->findBy(array('grupo' => $idGrupo));
        $idUSer = $user->getId();
        if($imagenes){
            return $this->render('Galeria/orla-provisional.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'imagenes' => $imagenes,
                'nombre_grupo'=> "Pruebas",
                'form' => $form->createView(),
                'isIncidencia' => $isIncidencia,
            ]);
        } else {
            return $this->render('Galeria/no-orla-provisional.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'id_grupo' => $idGrupo,
                'id_usuario'  => $idUSer,
            ]);
        }

    }
}
