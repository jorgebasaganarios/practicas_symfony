<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 16/05/2018
 * Time: 11:17
 */

namespace App\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Comanda;
use App\Entity\Mesa;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CuentaController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/cuenta", name="app_cuenta")
     */
    public function mostrarMesas()
    {
        return $this->render('mesascuenta.html.twig');
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/cuenta/mesa{numeromesa}", name="app_cuenta_mesa")
     */
    public function calcularCuenta($numeromesa)
    {
        $estado = 'Servida';
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository(Mesa::class);
        $mesa = $repository->find($numeromesa);
        $comandas = $mesa->getComandas();
        $comandarray = array();

        foreach ($comandas as $comanda) {
                if($comanda->getEstado() == $estado)
                $comandarray[] = $comanda;
        }


        $cuentatotal = $mesa->calculaPrecio();

        $m->flush();

        return $this->render('cuenta.html.twig',
            ['comandas' => $comandarray,
                'mesa'  => $mesa,
                'cuentatotal' => $cuentatotal]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/vaciar/mesa/{numeromesa}", name="app_vaciar_mesa")
     */

    public function vaciarMesa($numeromesa, EntityManagerInterface $em)
    {

        $estado='Servida';
        $nuevo ='Pagado';

        $em=$this->getDoctrine()->getManager();
        $repo=$em->getRepository(Mesa::class);
        $mesa=$repo->find($numeromesa);
        $comandas=$mesa->getComandas();


        foreach ($comandas as $comanda) {
            if($comanda->getEstado() == $estado){
              $comanda->setEstado($nuevo);
            }
        }



        $em->flush();

        return $this->redirectToRoute('app_camarero');

    }
}