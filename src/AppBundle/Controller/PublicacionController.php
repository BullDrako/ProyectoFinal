<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 4/02/16
 * Time: 19:38
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Publicacion;
use AppBundle\Entity\Comentario;
use AppBundle\Entity\Categoria;
use AppBundle\Form\PublicacionType;
use AppBundle\Security\PublicacionVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Edgar\UserBundle\Entity\User;


class PublicacionController extends Controller
{
    /**
     * @Route(
     *          path="/publicaciones",
     *          name="app_publicacion_publicaciones"
     *
     * )
     */

    public function publicacionesAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publicacionRepositorio= $m->getRepository('AppBundle:Publicacion');

        $query = $publicacionRepositorio->buscarTodasLasPublicaciones();

        $paginator = $this->get('knp_paginator');

        $publicaciones =$paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Publicacion::PAGINATION_ITEMS,
            [
                'wrap-queries' => true,
            ]
        );


        $response = $this->render(':publicacion:publicaciones.html.twig', [
            'publicaciones'  => $publicaciones,
            'title'          =>'Publicaciones'

        ]);

        return $response;

    }

    /**
     * @Route("/nueva", name="app_publicacion_nueva")
     * @Security("has_role('ROLE_USER')")
     */

    public function NuevaPublicacionAction(Request $request)
    {
        $publicacion = new Publicacion();
        $form = $this->createForm(PublicacionType::class, $publicacion);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
                $categoriaRepositorio->añadirCategoriasSiSonNuevas($publicacion);
                $publicacion->setAutor($this->getUser());
                $m->persist($publicacion);
                $m->flush();
                return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $publicacion->getId()]);
            }
        }
        return $this->render(':publicacion:form.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Nueva Publicacion',
        ]);
    }

    /**
     * @Route("editar/{id}.html", name="app_publicacion_editar")
     *
     */
    public function editarPublicacionAction(Publicacion $publicacion, Request $request)
    {
        $this->denyAccessUnlessGranted(PublicacionVoter::EDITAR_PUBLICACION, $publicacion);

        $form = $this->createForm(PublicacionType::class, $publicacion, [
            'submit_label'  => 'Editar publicacion'
        ]);
        $now = new \DateTime();
        $sinceCreated = $now->diff($publicacion->getCreatedAt());
        $minutes = $sinceCreated->days * 24 * 60 + $sinceCreated->h * 60 + $sinceCreated->i;
        if ($minutes > 4 and !$this->isGranted('ROLE_ADMIN')) {
            $form->remove('title');
        }
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
                $categoriaRepositorio->añadirCategoriasSiSonNuevas($publicacion);
                $m->flush();
                return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $publicacion->getId()]);
            }
        }
        return $this->render(':publicacion:form.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Editar Publicacion',
        ]);
    }

    /**
     * @Route("/{id}.html", name="app_publicacion_mostrar")
     */
    public function mostrarPublicacionAction(Publicacion $publicacion, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepositorio = $m->getRepository('AppBundle:Comentario');
        $query = $comentarioRepositorio->buscarComentariosPorPublicacion($publicacion->getId());
        $paginator = $this->get('knp_paginator');
        $comentarios = $paginator->paginate($query, $request->query->getInt('page', 1), Comentario::PAGINATION_ITEMS);
        return $this->render(':publicacion:publicacion.html.twig', [
            'publicacion'   => $publicacion,
            'comentarios'  => $comentarios,
        ]);
    }

    /**
     * @Route("/publicaciones/categoria/{nombre}", name="app_publicaciones_porCategoria")
     */

    public function publicacionesPorCategoriaAction(Categoria $categoria, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publicacionRepositorio = $m->getRepository('AppBundle:Publicacion');
        $query = $publicacionRepositorio->buscarPublicacionesPorCategoriaId($categoria->getId());
        $paginator = $this->get('knp_paginator');
        $publicaciones = $paginator->paginate($query, $request->query->getInt('page', 1), Publicacion::PAGINATION_ITEMS);
        return $this->render(':publicacion:publicaciones.html.twig', [
            'publicaciones'  => $publicaciones,
            'title'     => '#' . $categoria->getNombre(),
        ]);
    }

    /**
     * @Route("/publicaciones/usuario/{username}", name="app_publicaciones_porUsuario")
     */
    public function publicacionesPorUsuarioAction(User $user, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publicacionRepoitorio = $m->getRepository('AppBundle:Publicacion');
        $query = $publicacionRepoitorio->buscarPublicacionesPorUsuarioId($user->getId());
        $paginator = $this->get('knp_paginator');
        $publicaciones = $paginator->paginate($query, $request->query->getInt('page', 1), Publicacion::PAGINATION_ITEMS);
        return $this->render(':publicacion:publicaciones.html.twig', [
            'publicaciones'  => $publicaciones,
            'title'     => '@' . $user->getUsername(),
        ]);
    }



}