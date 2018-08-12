<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 25/04/2018
 * Time: 23:46
 */

namespace App\Controller;
use App\Entity\Producto;
use App\Form\ProductoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
class productosController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/productos", name="app_producto")
     */
    public function indice()
    {
        return $this->render('producto.html.twig');
    }
    /**
     *@return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/productos/formulario", name="app_form_producto")
     */
    public function crearAccion()
    {
        $action = $this->generateUrl('app_producto_creando');
        $product = new Producto();
        $form = $this->createForm(ProductoType::class, $product);
        return $this->render('crearproducto.html.twig',
            ['action' => $action,
                'form' => $form->createView()]
        );
    }
    /**
     *@return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/productos/crear", name="app_producto_creando")
     */
    public function hacerCrearAccion(EntityManagerInterface $em, Request $request)
    {
        $producto = new Producto();
        $formulario = $this->createForm(ProductoType::class, $producto);
        $formulario->handleRequest($request);
        if ($formulario->isValid()) {
            $em->persist($producto);
            $em->flush();
            return $this->redirectToRoute('app_producto');
        }
    }

    /**
     *@return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/productos/listar", name="app_producto_listar")
     */
    public function hacerListarAccion(EntityManagerInterface $em)
    {

        $productoRepo = $em->getRepository(Producto::class);
        $products = $productoRepo->findAll();
        return $this->render('listarproductos.html.twig',
            ['productos'=>$products]
        );
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/productos/actualizar{id}", name="app_producto_actualizar")
     */
    public function actualizarAction(EntityManagerInterface $em, $id)
    {

        $productRepo = $em->getRepository(Producto::class);
        $product = $productRepo->find($id);
        $form = $this->createForm(ProductoType::class, $product);
        return $this->render('actualizarproducto.html.twig',[
            'producto' => $product,
                'form'  => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @Route(path="/productos/actualizando{id}", name="app_actualizar")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function hacerActualizarAction(EntityManagerInterface $em, Request $request, $id)
    {

        $productRepo = $em->getRepository(Producto::class);
        $product = $productRepo->find($id);
        $form = $this->createForm(ProductoType::class, $product);
        $form->handleRequest($request);
        if($form->isValid()) {

            $em->flush();
            return $this->redirectToRoute('app_producto_listar');
        }

    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/productos/eliminando{id}", name="app_producto_eliminar")
     */
    public function eliminarAccion(EntityManagerInterface $em, $id)
    {

        $productRepo = $em->getRepository('App\Entity\Producto'); //<- Llamamos al repositorio para poder actualizar.
        $product = $productRepo->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('app_producto_listar');
    }

}