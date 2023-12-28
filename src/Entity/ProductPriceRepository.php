<?php

namespace App\Entity;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductPrice::class);
    }

    public function getProductPrices(int $productId): array
    {
        $qb = $this->createQueryBuilder('pp');

        $qb->where('pp.product = :productId');
        $qb->orderBy('pp.id','asc');

        $qb->setParameter('productId',$productId);

        return $qb->getQuery()->getResult();
    }
}