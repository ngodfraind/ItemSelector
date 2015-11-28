<?php

namespace CPASimUSante\ItemSelectorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MainConfigType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resourcetype', 'entity', array(
                'label'         => 'Type',
                'class'         => 'Claroline\CoreBundle\Entity\Resource\ResourceType',
                'choice_label'  =>'name',
            ))
            ->add('workspace', 'entity', array(
                'label'         => 'Workspace',
                'class'         => 'Claroline\CoreBundle\Entity\Workspace\Workspace',
                'choice_label'  =>'name',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CPASimUSante\ItemSelectorBundle\Entity\MainConfig'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cpasimusante_itemselectorbundle_mainconfig';
    }
}
