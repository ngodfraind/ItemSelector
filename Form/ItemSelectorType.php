<?php

namespace CPASimUSante\ItemSelectorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemSelectorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('field', 'text', array(
                'label' => 'field'
            ))
            //->add('resourceNode')
        ;
    }

    public function getDefaultOptions()
    {
        return array (
            'data_class' => 'CPASimUSante\ItemSelectorBundle\Entity\ItemSelector',
            'translation_domain' => 'resource'
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cpasimusante_itemselector';
    }
}