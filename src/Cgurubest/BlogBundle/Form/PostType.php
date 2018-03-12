<?php

namespace Cgurubest\BlogBundle\Form;

use Cgurubest\BlogBundle\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('body');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => Post::class,
        ));
    }

    public function getName()
    {
        return 'post';
    }

    public function getBlockPrefix()
    {
        return 'cgurubest_blog_bundle_post_type';
    }

}
