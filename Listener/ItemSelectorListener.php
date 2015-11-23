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


class ItemSelectorListener extends ContainerAware
{
    public function onCreateForm(CreateFormResourceEvent $event)
    {
        // Create form
        $form = $this->container->get('form.factory')->create('cpasimusante_itemselector', new ItemSelector());

        $content = $this->container->get('templating')->render(
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
        $form = $this->container->get('form.factory')->create('cpasimusante_itemselector', new ItemSelector());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $published = $form->get('published')->getData();
            $event->setPublished($published);
            $event->setResources(array($form->getData()));
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
        $response = null;
        $event->setResponse($response);
        $event->stopPropagation();
    }
}
