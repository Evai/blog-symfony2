<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class BlogPostAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $formMapper
//            ->add('title', 'text')
//            ->add('body', 'ckeditor', array('autoload' => true))
//            ->add('subject', 'sonata_type_model', array(
//                'class' => 'AppBundle\Entity\Subject',
//                'property' => 'name',
//            ))
//            ->add('category', 'sonata_type_model', array(
//                'class' => 'AppBundle\Entity\Category',
//                'property' => 'name',
//            ))
//            ->add('create_time', 'sonata_type_date_picker', array(
//                'format'=>'yyyy-MM-dd HH:mm:ss',
//                'dp_default_date'        => date('Y-m-d H:i:s'),));
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
            ->add('title', 'text')
            ->add('image', 'sonata_type_model', array(
                'property' => 'name'
            ))
            ->add('body', 'ckeditor', array('autoload' => true))
            ->add('create_time', 'sonata_type_date_picker', array(
                'format'=>'yyyy-MM-dd HH:mm:ss',
                'dp_default_date'        => date('Y-m-d H:i:s'),))
            ->end()

            ->with('Meta data', array('class' => 'col-md-3'))
            ->add('subject', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Subject',
                'property' => 'name',
            ))
            ->add('category', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Category',
                'property' => 'name',
            ))
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('subject.name')
            ->add('category.name')
            ->add('image.name')
            ->add('createTime')
        ;
    }
}