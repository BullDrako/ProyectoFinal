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

  


}