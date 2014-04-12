<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 16.57
 */

namespace Manticora\RestExtraBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class JsonPatchLineType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('op')
            ->add('path')
            ->add('value')
        ->add('from', 'text', array('required'=>false));
    }

    public function getName()
    {
        return null;
    }
} 