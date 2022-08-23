<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgManaCost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ManaCost>
 *
 * @method ManaCost|null find($id, $lockMode = null, $lockVersion = null)
 * @method ManaCost|null findOneBy(array $criteria, array $orderBy = null)
 * @method ManaCost[]    findAll()
 * @method ManaCost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgManaCostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgManaCost::class);
    }

    public function add(MtgManaCost $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgManaCost $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ManaCost[] Returns an array of ManaCost objects
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

//    public function findOneBySomeField($value): ?ManaCost
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
