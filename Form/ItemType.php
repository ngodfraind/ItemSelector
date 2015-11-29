<?php

namespace CPASimUSante\ItemSelectorBundle\Form;

use CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorResourceNodeRepository;
use CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorExerciseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'itemcode', 'entity', array(
                    'label'         => 'Code',
                    'class'         => 'CPASimUSanteItemSelectorBundle:ItemSelectorResourceNode',
                    'choice_label'  =>'name',
                    'empty_value' => 'Choisissez un item',
                    'query_builder' => function(ItemSelectorResourceNodeRepository $er) {
                        return $er->getQbFilteredBy(18, 'ecn-%');
                    }
                )
            );
/*
            ->add(
                'itemcode', 'text', array(
                    'label' => 'Code'
                )
            );
*/
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CPASimUSante\ItemSelectorBundle\Entity\Item'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cpasimusante_itemselectorbundle_item';
    }
}
