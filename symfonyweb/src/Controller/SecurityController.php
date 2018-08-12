<?php
// src/Controller/SecurityController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/security/login", name="login")
     */

    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route(
     *     path="security/check", name="check"
     * )
     */
    public function loginCheckAction()
    {
        $formResult = 'Te has logeado con éxito.';
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));

    }

    /**
     * @Route(
     *     path="security/logout", name="logout"
     * )
     */
    public function logoutAction()
    {

        $formResult = 'Has cerrado sesión.';
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));

    }

}