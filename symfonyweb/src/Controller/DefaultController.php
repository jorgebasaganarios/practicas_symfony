<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 22/02/2018
 * Time: 19:43
 */

namespace App\Controller;


// src/Controller/DefaultController.php
// ...

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}