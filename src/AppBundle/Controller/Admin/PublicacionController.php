<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 10/02/16
 * Time: 15:59
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Publicacion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicacionController extends Controller
{
    /**
     * @Route("/borrar/{id}.html", name="app_admin_publicacion_borrar")
     */
    public function borrarPublicacion(Publicacion $publicacion)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($publicacion);
        $m->flush();
        return $this->redirectToRoute('app_publicacion_publicaciones');
    }

    /**
     * @Route("top-leons", name="app_admin_top_votos_positivos")
     */
    public function TopPositivosAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publiRepositorio = $m->getRepository('AppBundle:Publicacion');
        $comenRepositorio = $m->getRepository('AppBundle:Comentario');
        $usuRepositorio = $m->getRepository('UserBundle:User');
        $publicaciones = $publiRepositorio->topVotosPositivos();

        $paginator = $this->get('knp_paginator');

        $publicaciones = $paginator->paginate(
            $publicaciones,
            $request->query->getInt('page', 1),
            Publicacion::PAGINATION_ITEMS,
            [
                'wrap-queries' => true,
            ]
        );

        return $this->render(':admin/votos:votosTopAdmin.html.twig', [
            'publicaciones' => $publicaciones,
            'titulo' => 'Top León'
        ]);
    }

    /**
     * @Route("/top-huevons", name="app_admin_top_votos_negativos")
     */
    public function TopNegaivosAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $publiRepositorio = $m->getRepository('AppBundle:Publicacion');
        $comenRepositorio = $m->getRepository('AppBundle:Comentario');
        $usuRepositorio = $m->getRepository('UserBundle:User');
        $publicaciones = $publiRepositorio->topVotosNegativos();

        $paginator = $this->get('knp_paginator');

        $publicaciones = $paginator->paginate(
            $publicaciones,
            $request->query->getInt('page', 1),
            Publicacion::PAGINATION_ITEMS,
            [
                'wrap-queries' => true,
            ]
        );

        return $this->render(':admin/votos:votosTopAdmin.html.twig', [
            'publicaciones' => $publicaciones,
            'titulo' => 'Top Huevón'
        ]);
    }


}