<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Blog;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('featuredContent', TextareaType::class, array(
                'attr' => array(
                    'id' => 'featuredContent',
                    'name' => 'blogFeaturedContent',
                    'form' => 'createblog',
                    'placeholder' => 'Enter your featured content here ...'
                ),
            ))
            ->add('featuredPhoto', FileType::class, array(
                'attr' => array(
                    'id' => 'blogFeaturedPhoto',
                    'name' => 'blogFeaturedPhoto',
                    'form' => 'createblog',
                ),
                'label' => 'Featured Photo: ',
            ))
            ->add('title', TextType::class,array(
                'attr' => array(
                    'id' => 'blogTitle',
                    'name' => 'blogTitle',
                    'placeholder' => 'Blog Title'
                ),
            ))
            ->add('content', TextareaType::class, array(
                'attr' => array(
                    'id' => 'blogContent',
                    'name' => 'blogContent',
                    'placeholder' => 'Enter your content here ...'
                ),
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array(
                    'class' => 'do-btn post',
                    'form' => 'createblog',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Blog::class,
        ));
    }
}

?>