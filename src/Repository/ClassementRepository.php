<?php

namespace App\Repository;

use App\Entity\Classement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classement>
 *
 * @method Classement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classement[]    findAll()
 * @method Classement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classement::class);
    }

    public function findBySelectedYear($year, $user, $month)
    {
        return $this->createQueryBuilder('r')
            ->where('YEAR(r.date) = :year')
            ->andwhere('r.user = :user')
            ->andWhere('MONTH(r.date) = :month')
            ->setParameter('year', $year)
            ->setParameter('user', $user)
            ->setParameter('month', $month)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findByCurrentYearAndMonth($user, $month)
    {

        $currentYear = date('Y');
        
        return $this->createQueryBuilder('v')
            ->select('v.value') 
            ->where('v.user = :user')
            ->andWhere('YEAR(v.date) = :year')
            ->andWhere('MONTH(v.date) = :month')
            ->setParameter('year', $currentYear)
            ->setParameter('user', $user)
            ->setParameter('month', $month)
            ->getQuery()
            ->getResult();
    }

    

    public function currentRank($user)
    {
        $currentYear = date('Y'); 
        $currentMonth = date('m'); 

        return $this->createQueryBuilder('v')
            ->select('v.value')
            ->where('v.user = :user')
            ->andWhere('YEAR(v.date) = :year')
            ->andWhere('MONTH(v.date) = :month')
            ->setParameter('year', $currentYear)
            ->setParameter('month', $currentMonth)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

}