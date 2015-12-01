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
     * @var int the resource type (18 = Exercise)
     */
    private $resourceType;

    /**
     * @var string the pattern to filter the resource
     */
    private $namePattern;

    public function __construct($resourceType = 18, $namePattern = 'ecn-%')
    {
        $this->resourceType = $resourceType;
        $this->namePattern = $namePattern;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $resourceType   = $this->resourceType;
        $namePattern    = $this->namePattern;

        $builder
            ->add(
                'itemcode', 'entity', array(
                    'label'         => 'Code',
                    'class'         => 'CPASimUSanteItemSelectorBundle:ItemSelectorResourceNode',
                    'choice_label'  =>'name',
                    'empty_value'   => 'Choisissez un item',
                    'query_builder' => function(ItemSelectorResourceNodeRepository $er) use ($resourceType, $namePattern) {
                        return $er->getQbFilteredBy($resourceType, $namePattern);
                    }
                )
            );
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
