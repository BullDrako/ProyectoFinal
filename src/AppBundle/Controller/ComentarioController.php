<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 9/02/16
 * Time: 17:16
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Publicacion;
use AppBundle\Entity\Comentario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\ComentarioType;
use Symfony\Component\HttpFoundation\Request;

class ComentarioController extends Controller
{
    public function MostrarFormularioAction($id)
    {
        $c = new Comentario();
        $form = $this->createForm(ComentarioType::class, $c, ['action' => $this->generateUrl('app_comentario_nuevo', ['id' => $id])]);
        return $this->render(':comentario:mostrar-formulario.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/nuevo/{id}", name="app_comentario_nuevo")
     * @Method(methods={"POST"})
     * @Security("has_role('ROLE_USER')")
     */


    public function enviarComentarioAction(Request $request, Publicacion $publicacion)
    {
        $c = new Comentario();
        $form = $this->createForm(ComentarioType::class, $c, [
            'action' => $this->generateUrl('app_comentario_nuevo', ['id' => $publicacion->getId()])
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $c->setAutor($this->getUser());
            $c->setPublicacion($publicacion);
            $m = $this->getDoctrine()->getManager();
            $m->persist($c);
            $m->flush();
            return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $publicacion->getId()]);
        }
        return $this->forward('AppBundle:Comentario:MostrarFormulario', ['id' => $publicacion->getId()]);
    }


    /**
     * @Route("/editar/{id}", name="app_comentario_editar")
     */

    public function editarAction(Comentario $comentario, Request $request)
    {
        if (!$this->isGranted('ROLE_ADMIN') and $this->getUser() != $comentario->getAutor()) {
            throw $this->createAccessDeniedException('You are not allowed to do this');
        }
        $form = $this->createForm(ComentarioType::class, $comentario, ['submit_label' => 'Editar Comentario']);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->flush();
                return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $comentario->getPublicacion()->getId()]);
            }
        }
        return $this->render(':comentario:mostrar-formulario-editar.html.twig', [
            'form'      => $form->createView(),
        ]);
    }


    /**
     * @Route("/ultimosComentarios", name="app_ultimos_comentarios")
     */
    public function ultimosComentariosAction()
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepositorio = $m->getRepository('AppBundle:Comentario');
        $comentarios = $comentarioRepositorio->ultimosComentarios();
        return $this->render(':comentario:ultimos-comentarios-sin-fecha.html.twig', ['comentarios' => $comentarios]);
    }


    /**
     * @Route("/todosComentarios", name="app_todos_comentarios")
     */
    public function todosComentariosAction()
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepositorio = $m->getRepository('AppBundle:Comentario');
        $comentarios = $comentarioRepositorio->todosComentarios();
        return $this->render(':comentario:ultimos-comentarios-sin-fecha.html.twig', ['comentarios' => $comentarios]);
    }
    

    public function comentariosDeLasPublicacionesAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepositorio = $m->getRepository('AppBundle:Comentario');
        $comentarios = $comentarioRepositorio->comentariosPorPublicacion($id);
        return $this->render(':comentario:ultimos-comentarios.html.twig', ['comentarios' => $comentarios]);
    }

}