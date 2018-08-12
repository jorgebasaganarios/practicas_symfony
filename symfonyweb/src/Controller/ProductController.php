<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("form/select", name="app_selector")
     */

    public function select(){
        return $this->render('form/select.html.twig');
    }

    public function crear(){
        $action = 'link_doCrear';
        return $this->render('form/form.html.twig', ['action'=>$action]);
    }

    /**
     * @Route("/product", name="app_product_index")
     * @var EntityManagerInterface $em
     */
    //PREFERIBLE PONERLE app_product enlugar de product

    public function doCrear(EntityManagerInterface $em, Request $request)
    {
        $product1 = new Product();
        $product1->setName($request->request->get('nombre'));
        $product1->setPrice($request->request->get('precio'));
        $product1->setDescription($request->request->get('desc'));

        $em->persist($product1); //Poner en cola para ir a la base de datos PERSIST
        $em->flush();
        $formResult = 'Creado nuevo producto con id '.$product1->getId();
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
    }

    /**
     * @Route("form/buscar", name="app_product_buscar")
     * @var EntityManagerInterface $em
     */

    public function buscar(){
        $action='link_doBuscar';
        return $this->render('form/buscar.html.twig', array ('action' => $action));
    }

    /**
     * @Route("/buscar", name="app_product_buscar")
     * @var EntityManagerInterface $em
     */
    //PREFERIBLE PONERLE app_product en lugar de product

    public function doBuscar(EntityManagerInterface $em, Request $request)
    {
        $id = $request->request->get('id');

        $productRepo = $em->getRepository('App:Product');
        $product1 = $productRepo->find($id);
        $em->flush();
        if(!$product1){
            $formResult = 'El producto de id '.$id.' no se encuentra en la base de datos.';
            return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
        }else{
            $formResult = 'El producto de id ' . $product1->getId() . ' sí se encuentra en la base de datos. [ Nombre: ' . $product1->getName() . ' / Precio: ' . $product1->getPrice() . ' / Descripción: ' . $product1->getDescription() . ' ]';
            return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
        }
    }

    /**
     * @Route("form/lista", name="app_product_list")
     * @var EntityManagerInterface $em
     */

    public function listar(EntityManagerInterface $em)
    {
        $productRepo = $em->getRepository('App:Product');
        $product1 = $productRepo->findAll();

        $action='link_doListar';
        return $this->render('form/lista.html.twig', array ('product1'=>$product1, 'action' => $action));
    }

    /**
     * @Route("/lista", name="app_product_search")
     * @var EntityManagerInterface $em
     */
    //PREFERIBLE PONERLE app_product en lugar de product

    public function doListar(EntityManagerInterface $em, Request $request)
    {
        $id = $request->request->get('id');
        $productRepo = $em->getRepository('App:Product');
        $product1 = $productRepo->find($id);

        $name = $request->request->get('nombre');
        $price = $request->request->get('precio');
        $description = $request->request->get('desc');

        if($name){
            $product1->setName($name);
        }
        if($price){
            $product1->setPrice($price);
        }
        if($description) {
            $product1->setDescription($description);
        }

        $em->flush();
        $formResult = 'El producto de id '.$product1->getId().' se ha actualizado.';
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
    }

    /**
     * @Route("form/update/{id}/{name}/{price}/{description}", name="app_product_update")
     * @var EntityManagerInterface $em
     */

    public function update($id, $name, $price, $description)
    {
        $action = 'link_doUpdate';
        return $this->render('form/search.html.twig', array('action' => $action, 'id' => $id, 'name' => $name, 'price' => $price, 'description' => $description));
    }
    /**
     * @Route("form/update", name="app_product_update")
     * @var EntityManagerInterface $em
     */

    public function doUpdate(EntityManagerInterface $em, Request $request)
    {
        $id = $request->request->get('id');
        $productRepo = $em->getRepository('App:Product');
        $product1 = $productRepo->find($id);

        $name = $request->request->get('nombre');
        $price = $request->request->get('precio');
        $description = $request->request->get('desc');

        if($name){
            $product1->setName($name);
        }
        if($price){
            $product1->setPrice($price);
        }
        if($description) {
            $product1->setDescription($description);
        }
        $em->flush();
        $formResult = 'El producto de id '.$product1->getId().' se ha actualizado.';
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
    }

    /**
     * @param EntityManagerInterface $em
     * @Route("/remove", name="app_product_remove")
     * @return Response
     */

    public function remove(EntityManagerInterface $em, Request $request){
        $id = $request->query->get('id');
        $productRepo = $em->getRepository('App:Product');
        $product1 = $productRepo->find($id);
        $em->remove($product1);
        $em->flush();
        $formResult = 'Producto eliminado.';
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
    }

    /**
     * @Route("form/formsymf", name="app_product_form")
     */

    public function form(){
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $action = 'link_doForm';
        return $this->render('form/formsymf.html.twig', ['form' => $form->createView(), 'action' => $action]);
    }

    /**
     * @Route("/formulario", name="app_product_formunuevo")
     * @var EntityManagerInterface $em
     */

    public function formDoAction(Request $request)
    {
        $product1 = new Product();
        $form = $this->createForm(ProductType::class, $product1);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product1);
            $em->flush();
        }
        $formResult = 'Creado nuevo producto con id '.$product1->getId();
        return $this->render('form/formResult.html.twig', array ('formResult' => $formResult));
    }

    /**
     * @Route("/actualizar/{product1}", name="app_product_actualizar")
     * @var EntityManagerInterface $em
     */

    public function actualizar(EntityManagerInterface $em, $id)
    {
        $action = 'link_doUpdate';
        $productRepo = $em->getRepository('App:Product');
        $product1 = $productRepo->find($id);
        return $this->render('form/actualizar.html.twig', array('action' => $action, 'product1' => $product1));
    }
}