<?php

namespace CPASimUSante\ItemSelectorBundle\Controller;

use CPASimUSante\ItemSelectorBundle\Entity\Item;
use CPASimUSante\ItemSelectorBundle\Entity\ItemSelector;
use CPASimUSante\ItemSelectorBundle\Form\ItemSelectorType;
use CPASimUSante\ItemSelectorBundle\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ItemSelectorController
 *
 * @category   Controller
 * @package    CPASimUSante
 * @subpackage ItemSelector
 * @author     CPASimUSante <contact@simusante.com>
 * @copyright  2015 CPASimUSante
 * @license    http://www.opensource.org/licenses/mit-license.php MIT License
 * @version    0.1
 * @link       http://simusante.com
 *
 * @EXT\Route(
 *      "/",
 *      name    = "cpasimusante_itemselector",
 *      service = "cpasimusante_itemselector.controller.itemselector"
 * )
 */
class ItemSelectorController extends Controller
{
    /**
     * Show main page
     *
     * @EXT\Route("/choose/{id}", name="cpasimusante_choose_item", requirements={"id" = "\d+"}, options={"expose"=true})
     * @EXT\ParamConverter("itemselector", class="CPASimUSanteItemSelectorBundle:ItemSelector", options={"id" = "id"})
     * @EXT\Template("CPASimUSanteItemSelectorBundle:ItemSelector:choose.html.twig")
     * @param Request $request
     * @param ItemSelector $itemSelector
     * @return array
     */
    public function chooseAction(Request $request, ItemSelector $itemSelector)
    {
        $em = $this->getDoctrine()->getManager();

        //retrieve ItemSelector configuration for this WS
        $config = $this->getConfig($itemSelector->getResource()->getWorkspace()->getId());

        $resourceType = $config['resourceType'];
        $namePattern = $config['namePattern'];

        $form = $this->get('form.factory')
            ->create(new ItemSelectorType($resourceType, $namePattern), $itemSelector);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($itemSelector);
            $em->flush();
        }

        return array(
            '_resource' => $itemSelector,
            'form'      => $form->createView(),
            'itemCount' => $config['itemCount'],
        );
    }

    private function getConfig($workspace){
        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository('CPASimUSanteItemSelectorBundle:MainConfigItem')
            ->findOneByWorkspace($workspace);
        //Default configuration
        if (null == $res)
        {
            $defaultResourceType = $em->getRepository('ClarolineCoreBundle:Resource\ResourceType')
                ->findOneByName('file');
            $config = array(
                'itemCount' => 3,
                'namePattern' => '',
                'resourceType' => $defaultResourceType->getId(),
            );
        }
        else
        {
            $config = array(
                'itemCount' => $res->getItemCount(),
                'namePattern' => $res->getNamePattern(),
                'resourceType' => $res->getResourceType()->getId(),
            );
        }
        return $config;
    }
}
