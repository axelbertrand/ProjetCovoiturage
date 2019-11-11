<?php

namespace App\Repository;

use App\Entity\DeparturePublication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DeparturePublication|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeparturePublication|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeparturePublication[]    findAll()
 * @method DeparturePublication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeparturePublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeparturePublication::class);
    }

    // /**
    //  * @return DeparturePublication[] Returns an array of DeparturePublication objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeparturePublication
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	
	public function findByDepartureAndArrivalCity($departure, $arrival)
	{
		return $this->createQueryBuilder('d')
            ->where('LOWER(d.departureCity) = LOWER(:departureCity)')
            ->setParameter('departureCity', $departure)
            ->andWhere('LOWER(d.arrivalCity) = LOWER(:arrivalCity)')
            ->setParameter('arrivalCity', $arrival)
            ->andWhere('d.departureDatetime > :now')
            ->setParameter('now', date('Y/m/d H:i:s'))
            ->orderBy('d.departureDatetime', 'DESC')
            ->getQuery()
            ->getResult()
        ;
	}
}
