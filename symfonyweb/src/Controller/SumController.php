<?php

namespace App\Controller;
use App\Model\SumModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SumController extends Controller
{

    public function selection(){
        return $this->render('lucky/selection.html.twig');
    }

    public function sumAction()
    {
        $action = 'link_doSum';
//        $route = $this->generateUrl('link_doSum');
        return $this->render('lucky/result.html.twig', ['action'=>$action]);
    }

    public function doSumAction(Request $request)
    {
        $num1=$request->request->get('num1');
        $num2=$request->request->get('num2');

        $suma = new SumModel($num1, $num2);
//        $model = this->get
        $suma->sum();
        $result = $suma->getResult();
        return $this->render('lucky/final.html.twig', ['result' => $result]);
    }

    public function subsAction()
    {
        $action = 'link_doSubs';
        return $this->render('lucky/result.html.twig', ['action'=>$action]);
    }

    public function doSubsAction(Request $request)
    {
        $num1=$request->request->get('num1');
        $num2=$request->request->get('num2');

        $resta = new SumModel($num1, $num2);
        $resta->substract();
        $result = $resta->getResult();
        return $this->render('lucky/final.html.twig', ['result' => $result]);
    }

//    public function multAction()
//    {
//        $action = 'link_doSum';
//        return $this->render('lucky/result.html.twig', array('action'=>$action));
//    }
//
//    public function doMultAction(Request $request)
//    {
//        $num1=$request->request->get('num1');
//        $num2=$request->request->get('num2');
//
//        $model = new SumModel($num1, $num2);
//        $model->multiply();
//        $result = $model->getResult();
//        return $this->render('lucky/final.html.twig',
//            ['result' => $result]
//        );
//    }
//
//    public function divAction()
//    {
//        $action = 'link_doSum';
//        return $this->render('lucky/result.html.twig', array('action'=>$action));
//    }
//
//    public function doDivAction(Request $request)
//    {
//        $num1=$request->request->get('num1');
//        $num2=$request->request->get('num2');
//
//        $model = new SumModel($num1, $num2);
//        $model->divide();
//        $result = $model->getResult();
//        return $this->render('lucky/final.html.twig',
//            ['result' => $result]
//        );
//    }
}