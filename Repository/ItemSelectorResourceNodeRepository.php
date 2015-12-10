<?php

namespace CPASimUSante\ItemSelectorBundle\Repository;

use Claroline\CoreBundle\Repository\ResourceNodeRepository;
use Doctrine\ORM\EntityRepository;

class ItemSelectorResourceNodeRepository extends ResourceNodeRepository
{
    /**
     * Get all filtered ResourceNode
     *
     * @param int $resourcetype
     * @param string $itemname
     * @param string $orderedBy
     * @return array|\Doctrine\ORM\Query
     */
    public function getQbFilteredBy($type = 'ujm_exercise', $itemname='', $orderedBy = 'name')
    {
        var_dump($type);
        $qb = $this->_em->createQueryBuilder()
            ->select('rn')
            ->from('Claroline\CoreBundle\Entity\Resource\ResourceNode', 'rn')
            ->join('rn.resourceType', 'type')
            ->where('type.name LIKE :type')
            ->setParameter('type', '%' . $type . '%');
        /*
        if ($itemname != '')
        {
            $qb->andWhere('rn.name LIKE :itemname')
                ->setParameter('itemname', $itemname);
        }*/
        $qb->orderBy('rn.'.$orderedBy, 'ASC');
        return $qb;
    }

    /**
     * @param bool $executeQuery
     * @param string $orderedBy
     * @return mixed
     */
    public function getFilteredBy($executeQuery = true, $orderedBy = 'title')
    {
        $qb = $this->getQbFilteredBy($executeQuery, $orderedBy);
        $query = $qb->getQuery();
        return $executeQuery ? $query->getResult() : $query;
    }
}