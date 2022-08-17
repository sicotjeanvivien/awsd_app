<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgSet;
use App\Repository\trait\CommunMethodsRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgSet>
 *
 * @method MtgSet|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgSet|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgSet[]    findAll()
 * @method MtgSet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgSetRepository extends ServiceEntityRepository
{

    use CommunMethodsRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgSet::class);
    }

    public function add(MtgSet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgSet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return MtgSet[] Returns an array of MtgSet objects
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

    //    public function findOneBySomeField($value): ?MtgSet
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
