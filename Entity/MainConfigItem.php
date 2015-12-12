<?php

namespace CPASimUSante\ItemSelectorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainConfigItem
 *
 * @ORM\Table(name="cpasimusante__mainconfig_item")
 * @ORM\Entity(repositoryClass="CPASimUSante\ItemSelectorBundle\Repository\MainConfigItemRepository")
 */
class MainConfigItem
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
     * @var integer
     *
     * @ORM\Column(name="itemcount", type="smallint")
     */
    private $itemCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="namepattern", type="string", length=255, nullable=true)
     */
    private $namePattern;

    /**
     * Resource type to select
     * @var \Claroline\CoreBundle\Entity\Resource\ResourceType
     *
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\Resource\ResourceType", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    private $resourcetype;

    /**
     * Workspace to apply
     * @var \Claroline\CoreBundle\Entity\Workspace\Workspace
     *
     * @ORM\ManyToOne(targetEntity="Claroline\CoreBundle\Entity\Workspace\Workspace", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    private $workspace;

    /**
     * @var MainConfig
     *
     * @ORM\ManyToOne(targetEntity="CPASimUSante\ItemSelectorBundle\Entity\MainConfig", inversedBy="items")
     * @ORM\JoinColumn(name="mainconfig_id", referencedColumnName="id")
     */
    protected $mainconfig;

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
     * Get itemCount
     *
     * @return integer
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * Set itemCount
     *
     * @return MainConfigItem
     */
    public function setItemCount($itemCount = 3)
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    /**
     * Set namePattern
     *
     * @param string $namePattern
     *
     * @return MainConfigItem
     */
    public function setNamePattern($namePattern)
    {
        $this->namePattern = $namePattern;

        return $this;
    }

    /**
     * Get namePattern
     *
     * @return string
     */
    public function getNamePattern()
    {
        return $this->namePattern;
    }

    /**
     * Set resourcetype
     *
     * @param \Claroline\CoreBundle\Entity\Resource\ResourceType $resourcetype
     *
     * @return MainConfigItem
     */
    public function setResourcetype(\Claroline\CoreBundle\Entity\Resource\ResourceType $resourcetype = null)
    {
        $this->resourcetype = $resourcetype;

        return $this;
    }

    /**
     * Get resourcetype
     *
     * @return \Claroline\CoreBundle\Entity\Resource\ResourceType
     */
    public function getResourcetype()
    {
        return $this->resourcetype;
    }

    /**
     * Set workspace
     *
     * @param \Claroline\CoreBundle\Entity\Workspace\Workspace $workspace
     *
     * @return MainConfigItem
     */
    public function setWorkspace(\Claroline\CoreBundle\Entity\Workspace\Workspace $workspace = null)
    {
        $this->workspace = $workspace;

        return $this;
    }

    /**
     * Get workspace
     *
     * @return \Claroline\CoreBundle\Entity\Workspace\Workspace
     */
    public function getWorkspace()
    {
        return $this->workspace;
    }

    /**
     * Set mainconfig
     *
     * @param \CPASimUSante\ItemSelectorBundle\Entity\MainConfig $mainconfig
     *
     * @return Item
     */
    public function setMainconfig(\CPASimUSante\ItemSelectorBundle\Entity\MainConfig $mainconfig = null)
    {
        $this->mainconfig = $mainconfig;

        return $this;
    }

    /**
     * Get mainconfig
     *
     * @return \CPASimUSante\ItemSelectorBundle\Entity\MainConfig
     */
    public function getMainconfig()
    {
        return $this->mainconfig;
    }
}
