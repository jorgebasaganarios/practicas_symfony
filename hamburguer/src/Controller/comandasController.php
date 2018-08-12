<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 25/04/2018
 * Time: 23:51
 */


namespace App\Controller;
use App\Entity\Comanda;
use App\Entity\Producto;
use App\Form\ComandaType;
use App\Form\ProductoType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\OrderByItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class comandasController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/comandas{numeromesa}", name="app_form_comanda")
     */
    public function crearAccion($numeromesa)
    {
        $action = $this->generateUrl('app_comanda_creando', array('numeromesa' => $numeromesa));
        $comanda = new Comanda();
        $form = $this->createForm(ComandaType::class, $comanda);

        return $this->render('crearcomanda.html.twig',
            ['action' => $action,
                'form' => $form->createView()]
        );
    }
    /**
     *@return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/comandas/crear{numeromesa}", name="app_comanda_creando")
     */
    public function hacerCrearAccion(EntityManagerInterface $em, Request $request, $numeromesa)
    {
        $comanda = new Comanda();
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('App:Mesa');
        $mesa = $repository->find($numeromesa);
        $formulario = $this->createForm(ComandaType::class, $comanda);
        $formulario->handleRequest($request);
        $prod1 = $comanda->getProd1();
        $prod2 = $comanda->getProd2();
        $prod3 = $comanda->getProd3();
        $comanda->addProducto($prod1);
        $comanda->addProducto($prod2);
        $comanda->addProducto($prod3);
        $comanda->setMesa($mesa);
        if ($formulario->isValid()) {
            $em->persist($comanda);
            $em->flush();
            return $this->redirectToRoute('app_camarero');
        }
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *  @Route(path="/comandas/lista", name="app_listar_comanda")
     */

    public function actionListar(EntityManagerInterface $em)
    {
        $estado = "En preparación";
        //$em = $this->getDoctrine()->getManager(); es lo mismo que entitymanagerInterface $em
        $comandaRepo=$em->getRepository(Comanda::class);

        $comanda=$comandaRepo->findbyEstado($estado);
        return $this->render('listaComandas.html.twig', ['comandas'=>$comanda]);
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     *  @Route(path="/comandas/cambia/{id}", name="app_cambia_estado")
     */
    public function actionCambiaEstado(EntityManagerInterface $em, Request $request, $id)
    {
        $e= "Listo";
        $estat = "En preparación";
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Comanda::class);
        $estado = $repository->find($id)->setEstado($e);


        $em->flush();
        $comandaRepo=$em->getRepository(Comanda::class);
        $comanda = $comandaRepo->findbyEstado($estat);
        return $this->redirectToRoute("app_listar_comanda", ['comandas' => $comanda]);

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *  @Route(path="/comandas/listacamarero", name="app_listar_comandaC")
     */

    public function actionListarCam(EntityManagerInterface $em)
    {
        $estado = "Listo";
        //$em = $this->getDoctrine()->getManager(); es lo mismo que entitymanagerInterface $em
        $comandaRepo=$em->getRepository(Comanda::class);

        $comanda=$comandaRepo->findbyEstado($estado);
        return $this->render('listaComandasCam.html.twig', ['comandas'=>$comanda]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route(path="/comandas/comandaBorrar/{id}", name="app_borra")
     */
    public function actionBorrar($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comandaRepo = $em->getRepository(Comanda::class);
        $comanda = $comandaRepo->find($id);
        $comanda->setEstado('Servida');

        $em->flush();


        return $this->redirectToRoute('app_listar_comandaC');

    }

}
