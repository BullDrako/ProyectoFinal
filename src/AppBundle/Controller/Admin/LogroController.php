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
                return $this->redirectToRoute('app_logros_todos');
            }
        }

        return $this->render(':logro:logro-form.html.twig', [
            'form'  => $form->createView(),
            'titulo' => 'Nuevo Logro',
        ]);
    }

}