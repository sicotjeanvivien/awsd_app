<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgSupertype;
use App\Repository\trait\CommunMethodsRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgSupertype>
 *
 * @method MtgSupertype|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgSupertype|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgSupertype[]    findAll()
 * @method MtgSupertype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgSupertypeRepository extends ServiceEntityRepository
{

    use CommunMethodsRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgSupertype::class);
    }

    public function add(MtgSupertype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgSupertype $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return MtgSupertype[] Returns an array of MtgSupertype objects
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

    //    public function findOneBySomeField($value): ?MtgSupertype
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
