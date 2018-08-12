<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 08/02/2018
 * Time: 17:32
 */
namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Form;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'Nombre:'))
            ->add('price', TextType::class,array('label'=>'Precio:'))
            ->add('description', TextType::class,array('label'=>'Descripción:'))
            ->add('Crear', SubmitType::class);
//            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Product::class,));
    }

    public function getName()
    {
        return 'app_product_type';
    }
}