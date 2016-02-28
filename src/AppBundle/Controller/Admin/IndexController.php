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

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_admin_index_index")
     */
    public function indexAction()
    {
        return $this->render(':admin/index:index.html.twig');
    }
}