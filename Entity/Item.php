<?php

namespace CPASimUSante\ItemSelectorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Item
 *
 * @ORM\Table(name="cpasimusante__item")
 * @ORM\Entity(repositoryClass="CPASimUSante\ItemSelectorBundle\Repository\ItemRepository")
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="itemcode", type="string", length=255)
     */
    private $itemcode;


    /**
     * @var ItemSelector
     *
     * @ORM\ManyToOne(targetEntity="CPASimUSante\ItemSelectorBundle\Entity\ItemSelector", inversedBy="items")
     * @ORM\JoinColumn(name="itemselector_id", referencedColumnName="id")
     */
    protected $itemselector;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set itemcode
     *
     * @param string $itemcode
     *
     * @return Item
     */
    public function setItemcode($itemcode)
    {
        $this->itemcode = $itemcode;

        return $this;
    }

    /**
     * Get itemcode
     *
     * @return string
     */
    public function getItemcode()
    {
        return $this->itemcode;
    }

    /**
     * Set itemselector
     *
     * @param \CPASimUSante\ItemSelectorBundle\Entity\ItemSelector $itemselector
     *
     * @return Item
     */
    public function setItemselector(\CPASimUSante\ItemSelectorBundle\Entity\ItemSelector $itemselector = null)
    {
        $this->itemselector = $itemselector;

        return $this;
    }

    /**
     * Get itemselector
     *
     * @return \CPASimUSante\ItemSelectorBundle\Entity\ItemSelector
     */
    public function getItemselector()
    {
        return $this->itemselector;
    }
}
