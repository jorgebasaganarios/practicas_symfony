<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * @Route("article/select", name="app_article_selection")
     */

    public function select(){
        return $this->render('article/select.html.twig');
    }

    public function crear(){
        $action = 'article_doCrear';
        return $this->render('article/form.html.twig', ['action'=>$action]);
    }

    /**
     * @Route("/article", name="app_article_index")
     * @var EntityManagerInterface $em
     */
    //PREFERIBLE PONERLE app_product en lugar de product

    public function doCrear(EntityManagerInterface $em, Request $request)
    {
        $article1 = new Article();
        $article1->setAuthor($request->request->get('author'));
        $article1->setTitle($request->request->get('title'));
        $article1->setContent($request->request->get('content'));

        $em->persist($article1); //Poner en cola para ir a la base de datos PERSIST
        $em->flush();
        $articleResult = 'Creado nuevo artículo con id '.$article1->getId();
        return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
    }

    /**
     * @Route("article/buscar", name="app_article_buscar")
     * @var EntityManagerInterface $em
     */

    public function buscar(){
        $action='article_doBuscar';
        return $this->render('article/buscar.html.twig', array ('action' => $action));
    }

    /**
     * @Route("/buscar", name="app_article_buscar")
     * @var EntityManagerInterface $em
     */
    //PREFERIBLE PONERLE app_product en lugar de product

    public function doBuscar(EntityManagerInterface $em, Request $request)
    {
        $id = $request->request->get('id');

        $articleRepo = $em->getRepository('App:Article');
        $article1 = $articleRepo->find($id);
        $em->flush();
        if(!$article1){
            $articleResult = 'El artículo de id '.$id.' no se encuentra en la base de datos.';
            return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
        }else{
            $articleResult = 'El artículo de id ' . $id . ' sí se encuentra en la base de datos. [ Autor: ' . $article1->getAuthor() . ' / Título: ' . $article1->getTitle() . ' / Contenido: ' . $article1->getContent() . ' ]';
            return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
        }
    }

    /**
     * @Route("article/lista", name="app_article_list")
     * @var EntityManagerInterface $em
     */

    public function listar(EntityManagerInterface $em)
    {
        $articleRepo = $em->getRepository('App:Article');
        $article1 = $articleRepo->findAll();

        $action='article_doListar';
        return $this->render('article/lista.html.twig', array ('article1'=>$article1, 'action' => $action));
    }

    /**
     * @Route("/article", name="app_article_search")
     * @var EntityManagerInterface $em
     */
    //PREFERIBLE PONERLE app_article en lugar de product

    public function doListar(EntityManagerInterface $em, Request $request)
    {
        $id = $request->request->get('id');
        $articleRepo = $em->getRepository('App:Article');
        $article1 = $articleRepo->find($id);

        $author = $request->request->get('author');
        $title = $request->request->get('title');
        $content = $request->request->get('content');

        if($author){
            $article1->setAuthor($author);
        }
        if($title){
            $article1->setTitle($title);
        }
        if($content) {
            $article1->setContent($content);
        }

        $em->flush();
        $articleResult = 'El artículo de id '.$article1->getId().' se ha actualizado.';
        return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
    }

    /**
     * @Route("article/update/{id}/{author}/{title}/{content}", name="app_article_update")
     * @var EntityManagerInterface $em
     */

    public function update($id, $author, $title, $content)
    {
        $action = 'article_doUpdate';
        return $this->render('article/search.html.twig', array('action' => $action, 'id' => $id, 'author' => $author, 'title' => $title, 'content' => $content));
    }
    /**
     * @Route("article/update", name="app_article_update")
     * @var EntityManagerInterface $em
     */

    public function doUpdate(EntityManagerInterface $em, Request $request)
    {
        $id = $request->request->get('id');
        $articleRepo = $em->getRepository('App:Article');
        $article1 = $articleRepo->find($id);

        $author = $request->request->get('author');
        $title = $request->request->get('title');
        $content = $request->request->get('content');

        if($author){
            $article1->setName($author);
        }
        if($title){
            $article1->setPrice($title);
        }
        if($content) {
            $article1->setDescription($content);
        }
        $em->flush();
        $articleResult = 'El artículo de id '.$article1->getId().' se ha actualizado.';
        return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
    }

    /**
     * @param EntityManagerInterface $em
     * @Route("/remove", name="app_article_remove")
     * @return Response
     */

    public function remove(EntityManagerInterface $em, Request $request){
        $id = $request->query->get('id');
        $articleRepo = $em->getRepository('App:Article');
        $article1 = $articleRepo->find($id);
        $em->remove($article1);
        $em->flush();
        $articleResult = 'Artículo eliminado.';
        return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
    }

    /**
     * @Route("article/formsymf", name="app_article_form")
     */

    public function form(){
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $action = 'article_doForm';
        return $this->render('article/formsymf.html.twig', ['form' => $form->createView(), 'action' => $action]);
    }

    /**
     * @Route("/formulario", name="app_article_formunuevo")
     * @var EntityManagerInterface $em
     */

    public function formDoAction(Request $request)
    {
        $article1 = new Article();
        $form = $this->createForm(ArticleType::class, $article1);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article1);
            $em->flush();
        }
        $articleResult = 'Creado nuevo artículo con id '.$article1->getId();
        return $this->render('article/articleResult.html.twig', array ('articleResult' => $articleResult));
    }

    /**
     * @Route("/actualizar/{article1}", name="app_article_actualizar")
     * @var EntityManagerInterface $em
     */

    public function actualizar(EntityManagerInterface $em, $id)
    {
        $action = 'article_doUpdate';
        $articleRepo = $em->getRepository('App:Article');
        $article1 = $articleRepo->find($id);
        return $this->render('article/actualizar.html.twig', array('action' => $action, 'article1' => $article1));
    }
}