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
        return $this->render(':admin/index:categorias-para-admin.html.twig', [
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

       /* $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $m = $this->getDoctrine()->getManager();
            $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
            $categoriaRepositorio->añadirCategoriasSiSonNuevasAdmin($categoria);
            $m->persist($categoria);
            $m->flush();
            //return $this->redirectToRoute('app_categorias_categorias');
            return $this->redirect('categorias-admin');
        }
        return $this->render(':admin/categoria:form-categoria.html.twig', [
            'form'      => $form->createView(),
            'title' => 'Nueva Categoria',
        ]);*/

        /*$publicacion = new Publicacion();
        $form = $this->createForm(CategoriaType2::class, $publicacion);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
                $categoriaRepositorio->añadirCategoriasSiSonNuevas($publicacion);
                $publicacion->setAutor($this->getUser());
                $m->persist($publicacion);
                $m->flush();
                $m = $this->getDoctrine()->getManager();
                $m->remove($publicacion);
                $m->flush();
                return $this->redirectToRoute('app_admin_categorias');

            }
        }
        return $this->render(':admin/categoria:form-categoria.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Nueva Categoria',
        ]);*/


        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->persist($categoria);
                $m->flush();
                //return $this->redirectToRoute('app_categorias_categorias');
                //return $this->redirect('categorias-admin');
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
        $form = $this->createForm(CategoriaType3::class, $categoria, [
            'submit_label'  => 'Editar categoria'
        ]);

        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->getRepository('AppBundle:Categoria');
                //$categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
                //$categoriaRepositorio->añadirCategoriasSiSonNuevas($publicacion);
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
        return $this->redirectToRoute('app_admin_categoria_no_usada');
    }


    /**
     * @Route("/no-usadas", name="app_admin_categoria_no_usada")
     */

    public function mostrarCategoriasNoUsadasAction()
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categorias = $categoriaRepositorio->todasCategoriasNoUsadas();

        return $this->render(':admin/categoria:categorias-no-usadas.html.twig', [
            'categorias' => $categorias,
        ]);
    }


    /**
     * @Route("/borrar-todas-categorias-no-usadas", name="app_admin_categoria_borrarTodascategoriasNoUsadas")
     */
    /*public function borrarTodasCategoriasNoUsadasAction()
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categorias = $categoriaRepositorio->todasCategoriasNoUsadas();
        foreach ($categorias as $categoria) {
            $m->remove($categoria);
        }
        $m->flush();
        return $this->redirectToRoute('app_admin_categoria_no_usada');
    }*/


    /**
     * @Route("/borrar-cate/{id}", name="app_admin_categoria1_borrar")
     */
    public function borrarCategoria1Action(Categoria $categoria)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($categoria);
        $m->flush();
        //return $this->redirectToRoute('app_admin_categoria_no_usada');
        //return $this->render('admin/index/categorias-para-admin.html.twig');
        return $this->redirect('/admin/categorias/categorias-admin');

    }


}



