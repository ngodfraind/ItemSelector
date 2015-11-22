<?php

namespace CPASimUSante\ItemSelectorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;

class ItemSelectorController extends Controller
{
    /**
     * @EXT\Route("/index", name="cpasimusante_itemselector_index")
     * @EXT\Template
     *
     * @return Response
     */
    public function indexAction()
    {
        throw new \Exception('hello');
    }
}
