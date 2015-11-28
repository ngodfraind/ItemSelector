<?php
namespace CPASimUSante\ItemSelectorBundle\Manager;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormFactoryInterface;
use Claroline\CoreBundle\Persistence\ObjectManager;

use Symfony\Component\HttpFoundation\Request;

class PluginManager
{
    /**
     * @var object object manager
     */
    private $om;
    private $em;

    public function getPluginConfigForm()
    {

    }

}