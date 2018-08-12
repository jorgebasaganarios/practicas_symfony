<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 25/04/2018
 * Time: 23:43
 */

namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class camareroController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/camarero", name="app_camarero")
     */
    public function camarero()
    {
        return $this->render('camarero.html.twig');
    }

    /**
     *@return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/mesas", name="app_mesas")
     */
    public function camareroComanda()
    {
        return $this->render('mesas.html.twig');
    }


}