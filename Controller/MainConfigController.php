<?php

namespace CPASimUSante\ItemSelectorBundle\Controller;

use CPASimUSante\ItemSelectorBundle\Entity\MainConfig;
use CPASimUSante\ItemSelectorBundle\Exception\NoMainConfigException;
use CPASimUSante\ItemSelectorBundle\Form\MainConfigType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MainConfigController
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
 *      "/config",
 *      name    = "cpasimusante_itemselector_mainconfig",
 *      service = "cpasimusante_itemselector.controller.mainconfig"
 * )
 */
class MainConfigController extends Controller
{
    /**
     * Configuration
     *
     * @EXT\Route("/choose", name="cpasimusante_mainconfig", options={"expose"=true})
     * @EXT\Template("CPASimUSanteItemSelectorBundle::config.html.twig")
     */
    public function adminOpenAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $mainConfig = $this->getMainConfig();

        //working because call to service_container in controller.yml
        $form = $this->get('form.factory')
            ->create(new MainConfigType(), $mainConfig);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($mainConfig);
            $em->flush();
        }

        return array(
            'form'      => $form->createView(),
        );
    }

    public function getMainConfig()
    {
        try {
            $mainConfig = $this->getDoctrine()
                ->getManager()
                ->getRepository('CPASimUSanteItemSelectorBundle:MainConfig')
                ->findAll();
            if (sizeof($mainConfig) == 0) {
                throw new NoMainConfigException();
            } else {
                return $mainConfig[0];
            }
        } catch (NoMainConfigException $nme) {
            return new MainConfig();
        }
    }
}