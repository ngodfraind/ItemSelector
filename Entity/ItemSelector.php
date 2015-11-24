<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CPASimUSante\ItemSelectorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\Resource\AbstractResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="cpasimusante__itemselector")
 * @ORM\Entity(repositoryClass="CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorRepository")
 */
class ItemSelector extends AbstractResource
{
    /**
     * @var Items[]
     *
     * @ORM\OneToMany(targetEntity="CPASimUSante\ItemSelectorBundle\Entity\Item", mappedBy="itemselector", cascade={"all"})
     */
    protected $items;

    /**
     * Wiki to select = Clinical case...
     * @var \Icap\WikiBundle\Entity\Wiki
     *
     * @ORM\ManyToOne(targetEntity="Icap\WikiBundle\Entity\Wiki", cascade={"persist"})
     * @ORM\JoinColumn(name="wiki_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $resource;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * Set resource
     *
     * @param \Icap\WikiBundle\Entity\Wiki $resource
     *
     * @return ItemSelector
     */
    public function setResource(\Icap\WikiBundle\Entity\Wiki $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Icap\WikiBundle\Entity\Wiki
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Add item
     *
     * @param \CPASimUSante\ItemSelectorBundle\Entity\Item $item
     *
     * @return ItemSelector
     */
    public function addItem(\CPASimUSante\ItemSelectorBundle\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \CPASimUSante\ItemSelectorBundle\Entity\Item $item
     */
    public function removeItem(\CPASimUSante\ItemSelectorBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
