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

/**
 * @ORM\Table(name="cpasimusante__itemselector")
 * @ORM\Entity(repositoryClass="CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorRepository")
 */
class ItemSelector extends AbstractResource
{
    /**
     *
     * @ORM\Column(name="code", type="text", nullable=true)
     */
    protected $code;

    /**
     * Wiki to select
     * @var \Claroline\CoreBundle\Entity\Resource\Activity
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

    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ItemSelector
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
}
