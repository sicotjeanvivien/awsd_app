<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgCard;
use App\Repository\trait\CommunMethodsRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgCard>
 *
 * @method MtgCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgCard[]    findAll()
 * @method MtgCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgCardRepository extends ServiceEntityRepository
{
    use CommunMethodsRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgCard::class);
    }

    public function add(MtgCard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgCard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return MtgCard[] Returns an array of MtgCard objects
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

    //    public function findOneBySomeField($value): ?MtgCard
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
