<?php
/**
 * User: Mario Giustiniani
 * Date: 12/04/14
 * Time: 16.57
 */

namespace Manticora\RestExtraBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JsonPatchType extends CollectionType {


    public function getName()
    {
        return null;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
           'type' => new JsonPatchLineType(),
            'allow_add'   => true,
        ));
    }
} 