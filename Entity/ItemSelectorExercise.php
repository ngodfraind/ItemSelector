<?php
namespace CPASimUSante\ItemSelectorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UJM\ExoBundle\Entity\Exercise;

/**
 * @ORM\Entity(repositoryClass="CPASimUSante\ItemSelectorBundle\Repository\ItemSelectorExerciseRepository")
 */
class ItemSelectorExercise extends Exercise
{

}