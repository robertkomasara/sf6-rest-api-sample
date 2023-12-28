<?php

namespace App\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProducts(int $page,int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('p');
        
        $qb->join('p.prices','pp');
        $qb->orderBy('p.id','asc');
        $qb->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }
}