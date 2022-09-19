<?php

namespace App\Repository\Organisator;

use App\Entity\Organisator\OrganisatorTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrganisatorTask>
 *
 * @method OrganisatorTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrganisatorTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrganisatorTask[]    findAll()
 * @method OrganisatorTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganisatorTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrganisatorTask::class);
    }

    public function add(OrganisatorTask $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrganisatorTask $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrganisatorTask[] Returns an array of OrganisatorTask objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrganisatorTask
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
