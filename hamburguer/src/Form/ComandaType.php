<?php
/**
 * Created by PhpStorm.
 * User: JuanMa
 * Date: 25/04/2018
 * Time: 18:07
 */
namespace App\Form;
use App\Entity\Camarero;
use App\Entity\Comanda;
use App\Entity\Producto;
use App\Repository\ProductoRepository;



use Doctrine\ORM\QueryBuilder;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\ChoiceList\Factory\ChoiceListFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class ComandaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('camarero', EntityType::class, array('label'=>'Camarero', 'class'=>Camarero::class,))
            ->add('prod1', EntityType::class, array('label'=>'Hamburguesa', 'class'=>Producto::class, 'query_builder'=>function (ProductoRepository $repo3) {return $repo3->createQueryBuilder('p')->where('p.tipo = :tipo')->setParameter('tipo', '1');
                }))->add('prod2', EntityType::class, array('label'=>'Complementos', 'class'=>Producto::class, 'query_builder'=>function (ProductoRepository $repo3) {
                    return $repo3->createQueryBuilder('p')->where('p.tipo = :tipo')->setParameter('tipo', '2');
                }))->add('prod3', EntityType::class, array('label'=>'Bebidas', 'class'=>Producto::class, 'query_builder'=>function (ProductoRepository $repo3) {
                    return $repo3->createQueryBuilder('p')->where('p.tipo = :tipo')->setParameter('tipo', '3');
                }))->add('save', SubmitType::class, array('label' => 'CREAR PEDIDO'));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class'=>Comanda::class,

        ]);
    }


}
