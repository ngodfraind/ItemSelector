<?php

namespace CPASimUSante\ItemSelectorBundle\Listener;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Claroline\CoreBundle\Event\CopyResourceEvent;
use Claroline\CoreBundle\Event\CreateFormResourceEvent;
use Claroline\CoreBundle\Event\CreateResourceEvent;
use Claroline\CoreBundle\Event\OpenResourceEvent;
use Claroline\CoreBundle\Event\DeleteResourceEvent;
use Claroline\CoreBundle\Event\DownloadResourceEvent;
use Claroline\CoreBundle\Event\CustomActionResourceEvent;
use Claroline\CoreBundle\Event\ExportResourceTemplateEvent;
use Claroline\CoreBundle\Event\ImportResourceTemplateEvent;
use CPASimUSante\ItemSelectorBundle\Entity\ItemSelector;
use CPASimUSante\ItemSelectorBundle\Form\ItemSelectorType;

/**
 *  @DI\Service()
 */
class ItemSelectorResourceListener
{
    private $container;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @DI\Observe("create_form_cpasimusante_itemselector")
     *
     * @param CreateFormResourceEvent $event
     */
    public function onCreateForm(CreateFormResourceEvent $event)
    {
        $form = $this->container->get('form.factory')->create(new ItemSelectorType(), new ItemSelector());
        $content = $this->container->get('templating')->render(
            'CPASimUSanteItemSelectorBundle:ItemSelector:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => 'cpasimusante_itemselector'
            )
        );
        $event->setResponseContent($content);
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("create_cpasimusante_itemselector")
     *
     * @param CreateResourceEvent $event
     */
    public function onCreate(CreateResourceEvent $event)
    {
        $request = $this->container->get('request');
        $form = $this->container->get('form.factory')->create(new ItemSelectorType(), new ItemSelector());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $published = $form->get('published')->getData();
            $event->setPublished($published);
            $event->setResources(array($form->getData()));
            $event->stopPropagation();

            return;
        }

        $content = $this->container->get('templating')->render(
            'CPASimUSanteItemSelectorBundle:ItemSelector:createForm.html.twig',
            array(
                'form' => $form->createView(),
                'resourceType' => $event->getResourceType()
            )
        );
        $event->setErrorFormContent($content);
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("delete_cpasimusante_itemselector")
     *
     * @param DeleteResourceEvent $event
     */
    public function onDelete(DeleteResourceEvent $event)
    {
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("copy_cpasimusante_itemselector")
     *
     * @param CopyResourceEvent $event
     */
    public function onCopy(CopyResourceEvent $event)
    {
        $newRes = null;
        $event->setCopy($newRes);
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("download_cpasimusante_itemselector")
     *
     * @param DownloadResourceEvent $event
     */
    public function onDownload(DownloadResourceEvent $event)
    {
        $path = '/path/to/dledfile';
        $event->setItem($path);
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("open_cpasimusante_itemselector")
     *
     * @param OpenResourceEvent $event
     */
    public function onOpen(OpenResourceEvent $event)
    {
        $response = null;
        $event->setResponse($response);
        $event->stopPropagation();
    }
}
