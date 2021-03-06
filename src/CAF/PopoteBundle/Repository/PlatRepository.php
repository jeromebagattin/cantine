<?php

namespace CAF\PopoteBundle\Repository;

/**
 * PlatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlatRepository extends \Doctrine\ORM\EntityRepository {

    public function mFindAll() {
        return $this
                        ->createQueryBuilder('a')
        ;
    }

    public function findEntree() {
        return $this
                        ->createQueryBuilder('a')
                        ->where('a.typePlat = :id')
                        ->setParameter('id', 2)
                        
        ;
    }
    
    public function myFindAll() {
        return $this
                        ->createQueryBuilder('a')
                        ->getQuery()
                        ->getResult()
        ;
    }
    
    public function findByMenu($id) {
        return $this
                        ->createQueryBuilder('p')
                        ->leftJoin('p.mp', 'mp')
                        ->leftJoin('mp.menu', 'menu')
                        ->addSelect('p')
                        ->where('menu.id = :id')
                        ->setParameter('id', $id)
        ;
    }

    public function findByRepaId($id) {
        return $this
                        ->createQueryBuilder('p')
                        ->leftJoin('p.mp', 'mp')
                        ->leftJoin('mp.menu', 'menu')
                        ->addSelect('p')
                        ->where('menu.id = :id')
                        ->setParameter('id', $id)
        ;
    }
    
    public function tout(QueryBuilder $qb) {
        $qb
                ->andwhere('a.id > :par')
                ->setparameter('par', 0)
        ;
    }

    public function myFind() {
        $qb = $this->createQueryBuilder('a');

        $qb
                ->where('a.id < :p')
                ->setParameter('p', 7)
        ;

        $this->tout($qb);
        $qb->orderBy('a.libelle', 'ASC');

        return $qb
                        ->getQuery()
                        ->getResult()
        ;
    }

    public function myFindId($id) {
        return $this
                        ->createQueryBuilder('a')
                        ->where('a.id = :id')
                        ->setParameter('id', $id)
                        ->getQuery()
                        ->getOneOrNullResult()
        ;
    }

    public function myFindOne($id, $par) {
        $qb = $this->createQueryBuilder('a');

        $qb
                ->where('a.id < :id')
                ->setParameter('id', $id)
                ->andwhere('a.libelle  = :par')
                ->setParameter('par', $par)
                ->orderby('a.id', 'DESC')
        ;

        return $qb
                        ->getQuery()
                        ->getResult()
        ;
    }

}
