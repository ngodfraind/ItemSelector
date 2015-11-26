<?php

namespace CPASimUSante\ItemSelectorBundle\Repository;

use Doctrine\ORM\EntityRepository;
use UJM\ExoBundle\Repository\ExerciseRepository;

class ItemSelectorExerciseRepository extends ExerciseRepository
{

    /**
     * Get all filtered exercises
     *
     * @return array|\Doctrine\ORM\Query
     */
    public function getQbFilteredExercise($orderedBy = 'title')
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('e')
            ->from('UJM\ExoBundle\Entity\Exercise', 'e')
            ->where('e.title LIKE :item')
            ->orderBy('e.'.$orderedBy, 'ASC')
            ->setParameter('item', 'ecn-%');
        return $qb;
    }

    public function getFilteredExercise($executeQuery = true, $orderedBy = 'title')
    {
        $qb = $this->getQbFilteredExercise($executeQuery, $orderedBy);
        $query = $qb->getQuery();
        return $executeQuery ? $query->getResult() : $query;
    }
}