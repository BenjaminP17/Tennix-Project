<?php

namespace App\Repository;

use App\Entity\Rencontre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rencontre>
 *
 * @method Rencontre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rencontre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rencontre[]    findAll()
 * @method Rencontre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RencontreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rencontre::class);
    }

   public function findAllByDateDESC(): array
   {
       return $this->createQueryBuilder('r')
           
           ->orderBy('r.date', 'DESC')
           ->getQuery()
           ->getResult();
       ;
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
    
   
    // public function AllVictoriesCurrentYear()
    // {
    //     $currentYear = (new \DateTime())->format('Y');  

    //     return $this->createQueryBuilder('r')
    //         ->select('COUNT(r.id) AS victoryCount')
    //         ->where('r.resultat = :result')  
    //         ->andWhere('YEAR(r.date) = :currentYear')
    //         ->setParameter('result', 'Victoire')
    //         ->setParameter('currentYear', $currentYear)
    //         ->getQuery()
    //         ->getSingleScalarResult();
    // }

    public function AllVictoriesCurrentYear($user)
    {
        $currentYear = (new \DateTime())->format('Y');  

        return $this->createQueryBuilder('r')
            ->select('COUNT(r.id) AS victoryCount')
            ->where('r.resultat = :result')  
            ->andWhere('YEAR(r.date) = :currentYear')
            ->andWhere('r.user = :user')
            ->setParameter('result', 'Victoire')
            ->setParameter('currentYear', $currentYear)
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function AllDefeatsCurrentYear($user)
    {
        $currentYear = (new \DateTime())->format('Y');  

        return $this->createQueryBuilder('r')
            ->select('COUNT(r.id) AS defeatCount')
            ->where('r.resultat = :result')  
            ->andWhere('YEAR(r.date) = :currentYear')
            ->andWhere('r.user = :user')
            ->setParameter('result', 'Défaite')
            ->setParameter('currentYear', $currentYear)
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();

    }

    public function AllMatchsCurrentYear($user)

    {
        $currentYear = (new \DateTime())->format('Y');

        return $this->createQueryBuilder('r')
            ->select('COUNT(r.id) AS matchPlayed')
            ->Where('YEAR(r.date) = :currentYear')
            ->andWhere('r.user = :user')
            ->setParameter('currentYear', $currentYear)
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();


    }

    
}
