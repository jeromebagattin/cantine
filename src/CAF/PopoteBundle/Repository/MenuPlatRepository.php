<?php

namespace CAF\PopoteBundle\Repository;

/**
 * MenuPlatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuPlatRepository extends \Doctrine\ORM\EntityRepository
{
     public function mFindAll() {
        return $this
                        ->createQueryBuilder('mp')
        ;
    }
}
