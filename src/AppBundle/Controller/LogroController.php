<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 9/05/16
 * Time: 16:24
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Logro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Edgar\UserBundle\Entity\User;

class LogroController extends Controller
{
    /**
     * @Route("/logrosUsuario/{id}", name="app_logros_usuario_id")
     */
    
    public function logrosUsuarioIdAction(Request $request, $id)
    {
        $m = $this->getDoctrine()->getManager();
        $logroRepositorio= $m->getRepository('AppBundle:Logro');

        $query = $logroRepositorio->buscarLogrosDeUnUsuario($id);

        $paginator = $this->get('knp_paginator');

        $logros =$paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Logro::PAGINATION_ITEMS,
            [
                'wrap-queries' => true,
            ]
        );


        $response = $this->render(':logro:logros.html.twig', [
            'logros'  => $logros

        ]);

        return $response;

    }
}