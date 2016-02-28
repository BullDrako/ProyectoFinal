<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 10/02/16
 * Time: 15:54
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
}