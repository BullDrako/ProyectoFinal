<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 23/05/16
 * Time: 19:46
 */

namespace AppBundle\Controller;


use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpKernel\Tests\Controller;

class votoController extends Controller
{

    public function votarAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();
    }

}