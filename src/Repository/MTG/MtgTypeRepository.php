<?php

namespace App\Repository\MTG;

use App\Entity\MTG\MtgType;
use App\Repository\trait\CommunMethodsRepositoryTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MtgType>
 *
 * @method MtgType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MtgType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MtgType[]    findAll()
 * @method MtgType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MtgTypeRepository extends ServiceEntityRepository
{

    use CommunMethodsRepositoryTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MtgType::class);
    }

    public function add(MtgType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MtgType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



//    /**
//     * @return MtgType[] Returns an array of MtgType objects
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

//    public function findOneBySomeField($value): ?MtgType
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
