<?php

namespace Edgar\UserBundle\Controller;

use Edgar\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class HoritzontalLoginController extends Controller
{
    /**
     * @Cache(maxage=0)
     */
    public function horitzontalLoginAction($route)
    {
        $last_username = $this->get('security.authentication_utils')->getLastUsername();

        return $this->render('UserBundle:Security:horitzontal-login.html.twig', [
            'last_username' => $last_username,
            'route'         => $route,
        ]);
    }

    /**
     * @Route("/todos-usuarios", name="app_admin_usuarios")
     */
    
    public function listaUsuariosAction()
    {
        $m = $this->getDoctrine()->getManager();
        $userRepositorio = $m->getRepository('UserBundle:User');

        $query = $userRepositorio->todosUsuarios();
        
        return $this->render(':usuarios:usuarios.html.twig',['usuarios' => $query]);

    }

    /**
     * @Route("/borrar-ususario/{id}", name="app_admin_borrar_usuario")
     */
    public function borrarUsuarioAction(User $usuario){
        $m = $this->getDoctrine()->getManager();
        $m->remove($usuario);
        $m->flush();

        return $this->redirectToRoute('app_admin_usuarios');

    }



}
