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
     * @EXT\Route("/choose/{id}", name="cpasimusante_choose_item", requirements={"id" = "\d+"}, options={"expose"=true})
     * @EXT\ParamConverter("itemselector", class="CPASimUSanteItemSelectorBundle:ItemSelector", options={"id" = "id"})
     * @EXT\Template("CPASimUSanteItemSelectorBundle:ItemSelector:choose.html.twig")
     */
    public function chooseAction(Request $request, ItemSelector $itemSelector)
    {
        $em = $this->getDoctrine()->getManager();

/*        $item1 = new Item();
        $item1->setItemcode('xxx');
        $itemSelector->addItem($item1);
        $item2 = new Item();
        $item2->setItemcode('yyy');
        $itemSelector->addItem($item2);
*/
        $originalItems = new ArrayCollection();

        // Create an ArrayCollection of the current Item objects in the database
        foreach ($itemSelector->getItems() as $item) {
            $originalItems->add($item);
        }

        //working because call to service_container in controller.yml
        $form = $this->get('form.factory')
            ->create(new ItemSelectorType(), $itemSelector);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // remove the relationship between the item and the ItemSelector
            foreach ($originalItems as $item) {
                if (false === $itemSelector->getItems()->contains($item)) {
                    // remove the Task from the Tag
                    //$item->getTasks()->removeElement($itemSelector);

                    // if it was a many-to-one relationship, remove the relationship like this
                    $item->setItemSelector(null);

                    $em->persist($item);

                    // if you wanted to delete the Item entirely, you can also do that
                    // $em->remove($tag);
                }
            }

            $em->persist($itemSelector);
            $em->flush();
        }

        return array(
            '_resource' => $itemSelector,
            'form'      => $form->createView(),
        );
    }
}
