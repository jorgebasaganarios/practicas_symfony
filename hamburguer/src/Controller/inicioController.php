<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 16/04/2018
 * Time: 23:29
 */
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class inicioController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/", name="app_inicio")
     */

    public function inicio()
    {
        return $this->render('inicio.html.twig');

    }


}