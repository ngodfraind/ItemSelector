<?php

namespace CPASimUSante\ItemSelectorBundle\Form;

use CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorResourceNodeRepository;
use CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorExerciseRepository;
use Claroline\CoreBundle\Repository\ResourceNodeRepository;
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

    public function __construct($resourceType = 'ujm_exercice', $namePattern = 'ecn-%')
    {
        //not used yet
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
                'resourceNode', 'entity', array(
                    'label'         => 'Code',
                    'class'         => 'ClarolineCoreBundle:Resource\ResourceNode',
                    'choice_label'  => 'name',
                    'empty_value'   => 'Choisissez un item',
                    'query_builder' => function(ResourceNodeRepository $er) use ($resourceType, $namePattern) {
                        $qb = $er->createQueryBuilder('rn');

                        return $qb;
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
