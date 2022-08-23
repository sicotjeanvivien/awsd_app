<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgRarity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgRarity>
 *
 * @method MtgRarity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgRarity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgRarity[]    findAll()
 * @method MtgRarity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgRarityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgRarity::class);
    }

    public function add(MtgRarity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgRarity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MtgRarity[] Returns an array of MtgRarity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MtgRarity
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
