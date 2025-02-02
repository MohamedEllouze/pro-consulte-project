<?php

namespace App\Repository;

use App\Entity\Specialist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Specialist>
 *
 * @method Specialist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specialist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specialist[]    findAll()
 * @method Specialist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specialist::class);
    }

    public function add(Specialist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Specialist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Specialist[] Returns an array online specialist
     */
    public function findAllOrdredByState(): array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.online', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    //    public function findOneBySomeField($value): ?Specialist
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
