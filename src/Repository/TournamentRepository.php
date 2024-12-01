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

    //permet la sélection des tournois par année choisie
    public function findBySelectedYear($year, $user)
    {
        return $this->createQueryBuilder('r')
            ->where('YEAR(r.date) = :year')
            ->andwhere('r.user = :user')
            ->setParameter('year', $year)
            ->setParameter('user', $user)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Va chercher tous les compétitions de l'année de l'user
    public function findByCurrentYear($user)
    {

    $currentYear = date('Y');

    return $this->createQueryBuilder('r')
        ->where('YEAR(r.date) = :year')
        ->andwhere('r.user = :user')
        ->setParameter('year', $currentYear)
        ->setParameter('user', $user)
        ->orderBy('r.date', 'DESC')
        ->getQuery()
        ->getResult();
    }

}
