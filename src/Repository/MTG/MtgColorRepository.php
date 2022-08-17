<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgColor;
use App\Repository\trait\CommunMethodsRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgColor>
 *
 * @method MtgColor|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgColor|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgColor[]    findAll()
 * @method MtgColor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgColorRepository extends ServiceEntityRepository
{
    
    use CommunMethodsRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgColor::class);
    }

    public function add(MtgColor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgColor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return MtgColor[] Returns an array of MtgColor objects
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

    //    public function findOneBySomeField($value): ?MtgColor
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
