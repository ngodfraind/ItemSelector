<?php

namespace CPASimUSante\ItemSelectorBundle\Controller;

use CPASimUSante\ItemSelectorBundle\Entity\MainConfig;
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

        //working because call to service_container in controller.yml
        $form = $this->get('form.factory')
            ->create(new MainConfigType(), new MainConfig());

        return array(
            'form'      => $form->createView(),
        );
    }

    /**
     * Configuration save
     *
     * @EXT\Route("/admin/submit", name="cpasimusante_itemselector_admin_submit", options={"expose"=true})
     * @EXT\Template("CPASimUSanteItemSelectorBundle::config.html.twig")
     */
    public function adminSubmitAction()
    {
        $form = $this->get('form.factory')
            ->create(new MainConfigType());
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $this->get('claroline.config.platform_config_handler')->setParameter('video_player', $form->get('player')->getData());

            return $this->redirect($this->generateUrl('claro_admin_plugins'));
        }

        return array('form_group' => $form->createView());
    }
}