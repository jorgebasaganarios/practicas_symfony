<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 25/04/2018
 * Time: 23:45
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class cocinaController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/cocina", name="app_cocina")
     */
    public function cocina()
    {
        return $this->render('cocina.html.twig');
    }
}


