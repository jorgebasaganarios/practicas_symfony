<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 08/02/2018
 * Time: 17:32
 */
namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Form;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, array('label'=>'Autor:'))
            ->add('title', TextType::class,array('label'=>'Titulo:'))
            ->add('content', TextType::class,array('label'=>'Contenido:'))
            ->add('Crear', SubmitType::class);
//            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Article::class,));
    }

    public function getName()
    {
        return 'app_article_type';
    }
}