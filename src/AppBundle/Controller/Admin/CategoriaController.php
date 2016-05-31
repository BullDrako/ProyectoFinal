<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 10/02/16
 * Time: 16:02
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Categoria;
use AppBundle\Entity\Publicacion;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\CategoriaType2;
use AppBundle\Form\CategoriaType3;
use Symfony\Component\HttpFoundation\Request;



class CategoriaController extends Controller
{
    /**
     * @Route("/categorias-admin", name="app_admin_categorias")
     *
     */

    public function categoriasAdminAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categoriasQuery = $categoriaRepositorio->busquedaBuscarTodasLascategorias();
        $categorias = $this->get('knp_paginator')->paginate($categoriasQuery, $request->query->getInt('page', 1), Categoria::PAGINATION_ITEMS);
        return $this->render(':admin/categoria:categorias-para-admin.html.twig', [
            'categorias' => $categorias,
        ]);
    }


    /**
     * El admin crea una caregoria
     *
     * @Route("/crear-categoria", name="app_admin_crear_categoria")
     */

    public function categoriaCrearAdminAction(Request $request)
    {
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->persist($categoria);
                $m->flush();

                return $this->redirectToRoute('app_admin_categorias');
            }
        }
        return $this->render(':admin/categoria:form-categoria.html.twig', [
            'form'      => $form->createView(),
            'title' => 'Nueva Categoria',
        ]);

    }

    /**
     * @Route("/editar-categria-admin/{id}", name="app_editar_categoria_admin")
     */
    public function editarCategoriaAdmin(Request $request, Categoria $categoria)
    {
        $form = $this->createForm(CategoriaType::class, $categoria, [
            'submit_label'  => 'Editar categoria'
        ]);

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->getRepository('AppBundle:Categoria');
                $m->flush();
                return $this->redirectToRoute('app_admin_categorias');
            }
        }
        return $this->render(':admin/categoria:form-categoria.html.twig', [
            'form'  => $form->createView(),
            'titulo' => 'Editar Publicacion',
        ]);

    }




    /**
     * @Route("/borrar/{id}", name="app_admin_categoria_borrar")
     */
    public function borrarCategoriaAction(Categoria $categoria)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($categoria);
        $m->flush();

        return $this->redirectToRoute('app_admin_categorias');
    }


    /**
     * @Route("/no-usadas", name="app_admin_categoria_no_usada")
     */

    public function mostrarCategoriasNoUsadasAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categorias = $categoriaRepositorio->todasCategoriasNoUsadas();

        /*$paginator = $this->get('knp_paginator');

        $categorias = $paginator->paginate(
            $categorias,
            $request->query->getInt('page', 1),
            Categoria::PAGINATION_ITEMS,
            [
                'wrap-queries' => true,
            ]
        );*/

        return $this->render(':admin/categoria:categorias-no-usadas.html.twig', [
            'categorias' => $categorias,
        ]);
    }

   


    /**
     * @Route("/borrar-categoria-no-usada/{id}", name="app_admin_categoria-no-usada_borrar")
     */
    public function borrarCategoriaNoUsadaAction(Categoria $categoria)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($categoria);
        $m->flush();

        return $this->redirectToRoute('app_admin_categoria_no_usada');

    }


}



