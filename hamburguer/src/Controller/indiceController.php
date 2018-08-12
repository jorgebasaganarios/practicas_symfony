<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 16/04/2018
 * Time: 23:52
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class indiceController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/indice", name="app_indice")
     */
    public function indice()
    {
        return $this->render('indice.html.twig');
    }
}