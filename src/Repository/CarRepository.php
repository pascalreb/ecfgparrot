<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    /**
     * Shows cars linked to a search by price, year or kilometers
     * @return Car[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('car');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('car.brand LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->prixmin)) {
            $query = $query
                ->andWhere('car.price >= :prixmin')
                ->setParameter('prixmin', $search->prixmin);
        }

        if (!empty($search->prixmax)) {
            $query = $query
                ->andWhere('car.price <= :prixmax')
                ->setParameter('prixmax', $search->prixmax);
        }

        if (!empty($search->kilomin)) {
            $query = $query
                ->andWhere('car.kilometers >= :kilomin')
                ->setParameter('kilomin', $search->kilomin);
        }

        if (!empty($search->kilomax)) {
            $query = $query
                ->andWhere('car.kilometers <= :kilomax')
                ->setParameter('kilomax', $search->kilomax);
        }

        if (!empty($search->yearmin)) {
            $query = $query
                ->andWhere('car.year >= :yearmin')
                ->setParameter('yearmin', $search->yearmin);
        }

        if (!empty($search->yearmax)) {
            $query = $query
                ->andWhere('car.year <= :yearmax')
                ->setParameter('yearmax', $search->yearmax);
        }

        return $query->getQuery()->getResult();
    }
}
