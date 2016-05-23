<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 16/03/16
 * Time: 15:52
 */

namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Comentario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComentarioController extends Controller
{
    /**
     * @Route("/borrar/{id}", name="app_admin_comentario_borrar")
     */
    public function borrarComnentarioAction(Comentario $comentario)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($comentario);
        $m->flush();
        return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $comentario->getPublicacion()->getId()]);
    }

    /**
     * @Route("/todosComentarios", name="app_admin_todos_comentarios")
     */
    public function todosComentariosAction()
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepositorio = $m->getRepository('AppBundle:Comentario');
        $comentarios = $comentarioRepositorio->todosComentarios();
        return $this->render(':admin/comentario:admin-todos-comentarios.html.twig',
            ['comentarios' => $comentarios]);
    }

    /**
     * @Route("/comentarios-de-la-publi/{id}", name="app_comentariosdelaspubli")
     */

    public function comentariosDeLasPublicacionesAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepositorio = $m->getRepository('AppBundle:Comentario');
        $comentarios = $comentarioRepositorio->comentariosPorPublicacion($id);
        return $this->render(':admin/comentario:admin-todos-comentarios.html.twig', ['comentarios' => $comentarios]);
    }
}



