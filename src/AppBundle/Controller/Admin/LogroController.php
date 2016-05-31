<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 22/05/16
 * Time: 12:58
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Logro;

use AppBundle\Form\LogroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class LogroController extends Controller
{
    /**
     * @Route("/nuevo-logro", name="app_logro_nuevo")
     * 
     */

    public function NuevoLogroAction(Request $request)
    {
        $logro = new Logro();
        $form = $this->createForm(LogroType::class, $logro);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $logroRepo = $m->getRepository('AppBundle:Logro');
                
                $m->persist($logro);
                $m->flush();
                return $this->redirectToRoute('app_admin_todos_logros');
            }
        }

        return $this->render(':logro:logro-form.html.twig', [
            'form'  => $form->createView(),
            'titulo' => 'Nuevo Logro',
        ]);
    }

    /**
     * @Route("/todos-logros", name="app_admin_todos_logros")
     */
    public function mostrarTodosLogros(Request $request){

        $m = $this->getDoctrine()->getManager();
        $logrosRepositorio = $m->getRepository('AppBundle:Logro');

        $query = $logrosRepositorio->todosLogros();

        $paginator = $this->get('knp_paginator');

        $query = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Logro::PAGINATION_ITEMS,
            [
                'wrap-queries' => true,
            ]
        );


        $response = $this->render(':logro:todos-logros.html.twig', [
            'logros' => $query,
            'titulo' => 'Todos los logros'

        ]);

        return $response;


    }

}