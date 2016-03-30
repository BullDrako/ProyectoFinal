<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 9/02/16
 * Time: 17:54
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoriaController extends Controller
{
    /**
     * @Route("/", name="app_categorias_categorias")
     */

    public function categoriasAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categoriasQuery = $categoriaRepositorio->busquedaBuscarTodasLascategorias();
        $categorias = $this->get('knp_paginator')->paginate($categoriasQuery, $request->query->getInt('page', 1), Categoria::PAGINATION_ITEMS);
        return $this->render(':categoria:categorias.html.twig', [
            'categorias' => $categorias,
        ]);
    }
}


