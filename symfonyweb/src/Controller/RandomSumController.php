<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 14/12/2017
 * Time: 15:43
 */

// src/Controller/SumController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RandomSumController extends Controller
{
    public function random()
    {
        $num1 = mt_rand(0, 100);
        $num2 = mt_rand(0, 100);
        $total = $num1 + $num2 ;
        $route = $this->generateUrl('app_lucky_random');
        return new Response(
        '<html><body>Resultado: ('.$num1. ' + ' .$num2. ') ' .$total.' <a href="'. $route . '"> URL </a></body></html>');
        return $this->render('lucky/total.html.twig',
            ['total' => $total]
        );
    }
}