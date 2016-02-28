<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 10/02/16
 * Time: 16:02
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Categoria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriaController extends Controller
{
    /**
     * @Route("/no-usadas", name="app_admin_categoria_no_usada")
     */

    public function mostrarCategoriasNoUsadasAction()
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categorias = $categoriaRepositorio->getCategoriasNoUsadas();
        // \Doctrine\Common\Util\Debug::dump($tags);
        return $this->render(':admin/categoria:categorias-no-usadas.html.twig', [
            'categorias' => $categorias,
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
     * @Route("/borrar-todas-categorias-no-usadas", name="app_admin_categoria_borrarTodascategoriasNoUsadas")
     */
    public function borrarTodasCategoriasNoUsadasAction()
    {
        $m = $this->getDoctrine()->getManager();
        $categoriaRepositorio = $m->getRepository('AppBundle:Categoria');
        $categorias = $categoriaRepositorio->getCategoriasNoUsadas();
        foreach ($categorias as $categoria) {
            $m->remove($categoria);
        }
        $m->flush();
        return $this->redirectToRoute('app_admin_categoria_no_usada');
    }

}