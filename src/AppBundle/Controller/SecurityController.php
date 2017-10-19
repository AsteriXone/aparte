<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 16/09/2017
 * Time: 18:38
 */

namespace AppBundle\Controller;

use AppBundle\Entity\GruposUsuarios;
use AppBundle\Entity\User;
use AppBundle\Form\registerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Entity\Grupo;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/registrar", name="registrar")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $usuario = new User();
        $error = false;
        $form = $this->createForm(registerType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());

            $usuario->setPassword($password);
            $usuario->setRoles('ROLE_USER');

            $groupcode = $form['groupcode']->getData();

            if ($groupcode){
                // Usuario introduce codigo-grupo
                // Se comprueba codigo
                $grupo = $this->getDoctrine()
                    ->getRepository(Grupo::class)
                    ->findBy(
                        array('codigoGrupo' => $groupcode)
                    );
                // Si hay codigo asignado a grupo
                if ($grupo){
                    // Persist User to DB && asign to group-user
                    $idGrupo = $grupo[0]->getId();

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($usuario);
                    $em->flush();

                    $gruposUsuarios = new GruposUsuarios();
                    $gruposUsuarios->setGrupo($grupo[0]);
                    $gruposUsuarios->setUser($usuario);

                    $em2 = $this->getDoctrine()->getManager();
                    $em2->persist($gruposUsuarios);
                    $em2->flush();

//                    echo ('User Id: '.$usuario->getId());
//                    echo ('Grupo Id:'. $idGrupo);

                    $token = new UsernamePasswordToken($usuario, null, 'main', $usuario->getRoles());
                    $this->get('security.token_storage')->setToken($token);
                    $this->get('session')->set('_security_main', serialize($token));

                    return $this->redirectToRoute('homepage');
                } else {
                    $error  = 'El código no es válido!';
                }

            } else {
                // Usuario NO introduce codigo-grupo
                $error = 'Debes introducir un código';
            }
        }
        return $this->render(
            'security/registrar.html.twig',
            array(
                'form'  => $form->createView(),
                'error' => $error
            )
        );
    }

    /**
     * @Route("/registrar_old", name="registrar_old")
     */
    public function register_oldAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        //$error = $authUtils->getLastAuthenticationError();
        $error = false;
        // Comprueba si viene formulario _form_active hiddend field
        if($request->get('_form_active')) {
            // Comprueba credenciales, si existe relacion telefono / pass
            $telefono = $request->get('_tel');
            $pass = $request->get('_password');

            $usuario = $this->getDoctrine()
                ->getRepository(User::class)
                ->findByTelAndUser($telefono, $pass);
            if ($usuario) {
                // Si el usuario está registrado
                $error = "Ya hay un usuario registrado con estos datos!";
            } else {
                // Si el usuario no esta registrado
                // Comprueba si viene codigo grupo del formulario
                $group_code = $request->get('_grouppass');
                if ($group_code) {
                    // Si viene codigo grupo, comprueba si coincide en DB
                    $grupo = $this->getDoctrine()
                        ->getRepository(Grupo::class)
                        ->findBy(
                            array('codigoGrupo' => $group_code)
                        );
                    if (!$grupo) {
                        // No hay coincidencia en DB asigna error
                        $error = "El código proporcionado no es valido!";
                    } else {
                        // Si hay coincidencia en DB...
                        // ... guarda usuario

                        // ... asigna usuario a grupo
                        $idGrupo = $grupo[0]->getId();

                        // retornamos vista usuario

                    }
                }
            }
        }


        // Comprobar si existe el codigo grupo en bd


//        $grupo->getId();
//
//        echo($grupo->getAnio());
        //var_dump("Codigo:".$codigo);

        //var_dump("Salida: ".$group_code);


        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        //$authUtils->


        return $this->render('security/registrar.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}