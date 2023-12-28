<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=ProductPriceRepository::class)
 * @ORM\Table(name="products_prices")
 */
class ProductPrice
{
    use EntityTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    public int $value;

    /**
     * @ORM\Column(type="string",length=3)
     * @Assert\NotBlank()
     */
    public string $currency;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id",referencedColumnName="id",nullable=true)
     * @Assert\NotBlank()
     */
    public Product $product;
}