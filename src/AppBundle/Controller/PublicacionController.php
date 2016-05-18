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
            'titulo'          =>'Publicaciones'

        ]);

        return $response;

    }

    /**
     * @Route("/nueva", name="app_publicacion_nueva")
     * @Security("has_role('ROLE_USER')")
     */

    public function NuevaPublicacionAction(Request $request)
    {
        /*$publicacion = new Publicacion();
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
            'titulo' => 'Nueva Publicacion',
        ]);*/


        $publicacion = new Publicacion();
        $form = $this->createForm(PublicacionType::class, $publicacion);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $categoriasRepo = $m->getRepository('AppBundle:Categoria');
                $publicacionRepo = $m->getRepository('AppBundle:Publicacion');
                $publicacion->setAutor($this->getUser());
                $m->persist($publicacion);
                $m->flush();
                return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $publicacion->getId()]);
            }
        }

        return $this->render(':publicacion:form.html.twig', [
            'form'  => $form->createView(),
            'titulo' => 'Nueva Publicacion',
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

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
                //$categoriaRepositorio->añadirCategoriasSiSonNuevas($publicacion);
                $m->flush();
                return $this->redirectToRoute('app_publicacion_mostrar', ['id' => $publicacion->getId()]);
            }
        }
        return $this->render(':publicacion:form.html.twig', [
            'form'  => $form->createView(),
            'titulo' => 'Editar Publicacion',
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
     * @Route("/publicaciones/categoria/{nombre}", name="app_publicacionesQueTieneCategoria")
     */

    public function publicacionesQueTieneCategoriaAction(Categoria $categoria, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publicacionRepositorio = $m->getRepository('AppBundle:Publicacion');
        $query = $publicacionRepositorio->buscarPublicacionesQueTieneCategoriaId($categoria->getId());
        $paginator = $this->get('knp_paginator');
        $publicaciones = $paginator->paginate($query, $request->query->getInt('page', 1), Publicacion::PAGINATION_ITEMS);
        return $this->render(':publicacion:publicaciones.html.twig', [
            'publicaciones'  => $publicaciones,
            'titulo'     => '#' . $categoria->getNombre(),
        ]);
    }

    /**
     * @Route("/publicaciones/usuario/{username}", name="app_publicaciones_de_un_Usuario")
     */
    public function publicacionesDeUnUsuarioAction(User $user, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publicacionRepoitorio = $m->getRepository('AppBundle:Publicacion');
        $query = $publicacionRepoitorio->buscarPublicacionesDeUnUsuarioId($user->getId());
        $paginator = $this->get('knp_paginator');
        $publicaciones = $paginator->paginate($query, $request->query->getInt('page', 1), Publicacion::PAGINATION_ITEMS);
        return $this->render(':publicacion:publicaciones.html.twig', [
            'publicaciones'  => $publicaciones,
            'titulo'     => '@' . $user->getUsername(),
        ]);
    }



}