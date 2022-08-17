<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgSubtype;
use App\Repository\trait\CommunMethodsRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgSubtype>
 *
 * @method MtgSubtype|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgSubtype|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgSubtype[]    findAll()
 * @method MtgSubtype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgSubtypeRepository extends ServiceEntityRepository
{
    use CommunMethodsRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgSubtype::class);
    }

    public function add(MtgSubtype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgSubtype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return MtgSubtype[] Returns an array of MtgSubtype objects
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

    //    public function findOneBySomeField($value): ?MtgSubtype
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
