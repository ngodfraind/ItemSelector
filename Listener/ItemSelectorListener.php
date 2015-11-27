<?php

namespace CPASimUSante\ItemSelectorBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Claroline\CoreBundle\Event\CopyResourceEvent;
use Claroline\CoreBundle\Event\CreateFormResourceEvent;
use Claroline\CoreBundle\Event\CreateResourceEvent;
use Claroline\CoreBundle\Event\OpenResourceEvent;
use Claroline\CoreBundle\Event\DeleteResourceEvent;
use CPASimUSante\ItemSelectorBundle\Entity\ItemSelector;
use CPASimUSante\ItemSelectorBundle\Form\ItemSelectorType;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class ItemSelectorListener extends ContainerAware
{
    public function onCreateForm(CreateFormResourceEvent $event)
    {
        // Create form
        $form = $this->container->get('form.factory')
            ->create(new ItemSelectorType(), new ItemSelector());

        $content = $this->container->get('templating')
            ->render(
                'ClarolineCoreBundle:Resource:createForm.html.twig',
                array(
                    'form' => $form->createView(),
                    'resourceType' => 'cpasimusante_itemselector'
                )
            );

        $event->setResponseContent($content);
        $event->stopPropagation();
    }

    public function onCreate(CreateResourceEvent $event)
    {
        $request = $this->container->get('request');
        $form = $this->container->get('form.factory')->create(new ItemSelectorType(), new ItemSelector());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $itemselector = $form->getData();
            //update name
            $itemselector->setName($itemselector->getTitle());

            $event->setResources(array($itemselector));
            $event->stopPropagation();

            return;
        }

        $content = $this->container->get('templating')->render(
            'ClarolineCoreBundle:Resource:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => 'cpasimusante_itemselector'
            )
        );
        $event->setErrorFormContent($content);
        $event->stopPropagation();
    }

    public function onDelete(DeleteResourceEvent $event)
    {
        $event->stopPropagation();
    }

    public function onCopy(CopyResourceEvent $event)
    {
        $newRes = null;
        $event->setCopy($newRes);
        $event->stopPropagation();
    }

    public function onOpen(OpenResourceEvent $event)
    {
        $route = $this->container
            ->get('router')
            ->generate(
                'cpasimusante_choose_item',
                array(
                    'id' => $event->getResource()->getId()
                )
            );
        $event->setResponse(new RedirectResponse($route));
        $event->stopPropagation();

/*
        $form = $this->container->get('form.factory')
            ->create(new ItemSelectorType(), new ItemSelector());
        $content = $this->container->get('templating')->render(
            'CPASimUSanteItemSelectorBundle:ItemSelector:index.html.twig',
            array(
                '_resource' => $event->getResource(),
                'form'   => $form->createView(),
            )
        );
        $response = new Response($content);
        $event->setResponse($response);
        $event->stopPropagation();
*/
    }

    /**
     * @param PluginOptionsEvent $event
     */
    public function onPluginConfigure(PluginOptionsEvent $event)
    {
        //retrieve the plugin manager with its Service name
        $pluginManager = $this->container
            ->get("cpasimusante_itemselector.plugin.manager.config");
        $form = $pluginManager->getPluginconfigForm();

        $content = $this->templating
            ->render(
                'CPASimUSanteItemSelectorBundle::config.html.twig',
                array(
                    //'form' => $form->createView()
                )
            );
        //PluginOptionsEvent require a setResponse()
        $event->setResponse(new Response($content));
        $event->stopPropagation();
    }
}
