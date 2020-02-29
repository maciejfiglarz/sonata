<?php

namespace App\Admin;

use App\Entity\Category;
use App\Entity\BlogPost;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class BlogPostAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view
    }

    //

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
            ->with('Content', ['class' => 'col-md-9'])
            ->add('title', TextType::class)
            ->add('body', TextareaType::class)
            
            ->end()
            ->end()
            ->tab('Publish Options')
            ->with('Meta data', ['class' => 'col-md-3'])
            ->add('category', ModelType::class, [
                'class' => Category::class,
                'property' => 'name',
            ])
            ->end()
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->addIdentifier('body');
        $listMapper->addIdentifier('draft');
        $listMapper->addIdentifier('category.name');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('title',null,[
            'operator_type' => 'hidden',
            'advanced_filter' => false
        ])
        ->add('category', null, [], EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            
        ])
    ;
    }
    
}
