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

    public function findBySelectedYear($year)
    {
        return $this->createQueryBuilder('r')
            ->where('YEAR(r.date) = :year')
            ->setParameter('year', $year)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findByCurrentYear($user)
    {
    $currentYear = date('Y');

    return $this->createQueryBuilder('v')
        ->select('v.value') 
        ->where('v.user = :user')
        ->andWhere('YEAR(v.date) = :year')
        ->setParameter('year', $currentYear)
        ->setParameter('user', $user)
        ->orderBy('v.date', 'ASC')
        ->getQuery()
        ->getResult();
    }

}
