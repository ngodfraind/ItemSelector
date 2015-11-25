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
            ->add(
                'name', 'hidden', array(
                    'data' => 'exercise'
                )
            )
            ->add(
                'title', 'text', array(
                    'label' => 'title'
                )
            )
            ->add(
                'resource',
                'resourcePicker',
                array(
                    'required' => true,
                    'attr' => array(
                        'data-is-picker-multi-select-allowed'   => 0,
                        'data-is-directory-selection-allowed'   => 0,
                        'data-type-wite-list'                  => 'icap_wiki',
                        /*'data-restrict-for-owner'               => 0,*/
                    ),
                    'label' => 'resource_to_open'
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CPASimUSante\ItemSelectorBundle\Entity\ItemSelector',
            'translation_domain' => 'resource'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cpasimusante_itemselector';
    }
}