<?php

namespace App\Repository;

use App\Entity\Tournament;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tournament>
 *
 * @method Tournament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tournament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tournament[]    findAll()
 * @method Tournament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tournament::class);
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

    public function findByCurrentYear()
    {

    $currentYear = date('Y');

    return $this->createQueryBuilder('r')
        ->where('YEAR(r.date) = :year')
        ->setParameter('year', $currentYear)
        ->orderBy('r.date', 'DESC')
        ->getQuery()
        ->getResult();
    }

}
