<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 10/02/16
 * Time: 16:15
 */

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Publicacion;

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_admin_index_index")
     */
    public function indexAction(Request $request)
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

        return $this->render(':admin/index:index.html.twig', [
            'publicaciones'  => $publicaciones,
            'title'          =>'Publicaciones']);
    }



}