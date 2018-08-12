<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 14/12/2017
 * Time: 15:43
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    public function number()
    {
        $num1 = mt_rand(0, 100);
        $num2 = mt_rand(0, 100);
        $route = $this->generateUrl('app_lucky_number');
//        return new Response(
//            '<html><body>Lucky number: ('.$num1.'-'.$num2.') <a href="'. $route . '"> URL </a></body></html>');
        return $this->render('lucky/number.html.twig',
            ['num1' => $num1, 'num2' => $num2]
            );
    }
}