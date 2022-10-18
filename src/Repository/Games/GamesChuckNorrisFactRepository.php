<?php

namespace App\Repository\Games;

use App\Entity\Games\GamesChuckNorrisFact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GamesChuckNorrisFact>
 *
 * @method GamesChuckNorrisFact|null find($id, $lockMode = null, $lockVersion = null)
 * @method GamesChuckNorrisFact|null findOneBy(array $criteria, array $orderBy = null)
 * @method GamesChuckNorrisFact[]    findAll()
 * @method GamesChuckNorrisFact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamesChuckNorrisFactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GamesChuckNorrisFact::class);
    }

    public function add(GamesChuckNorrisFact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GamesChuckNorrisFact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findRandom()
    {
        $sql = "SELECT f
        FROM App\Entity\Games\GamesChuckNorrisFact f WHERE f.isValided = TRUE
        ORDER BY f.updated ASC
        ";

        return $this->getEntityManager()->createQuery($sql)->setMaxResults(1)->getOneOrNullResult();
    }

    //    /**
    //     * @return GamesChuckNorrisFact[] Returns an array of GamesChuckNorrisFact objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GamesChuckNorrisFact
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
