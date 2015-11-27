<?php
namespace CPASimUSante\ItemSelector\Manager;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormFactoryInterface;
use Claroline\CoreBundle\Persistence\ObjectManager;

use Symfony\Component\HttpFoundation\Request;

class ItemSelectorConfigManager
{
    /**
     * @var object object manager
     */
    private $om;

    private $em;
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $formFactory;


}