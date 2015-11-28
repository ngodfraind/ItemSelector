<?php

namespace CPASimUSante\ItemSelectorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MainConfig
 *
 * @ORM\Table(name="cpasimusante__mainconfig")
 * @ORM\Entity(repositoryClass="CPASimUSante\ItemSelectorBundle\Repository\MainConfigRepository")
 */
class MainConfig
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set resourcetype
     *
     * @param \Claroline\CoreBundle\Entity\Resource\ResourceType $resourcetype
     *
     * @return MainConfig
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
     * @return MainConfig
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
}
