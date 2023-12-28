<?php

namespace App\Entity;

use \Doctrine\ORM\PersistentCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="products")
 */
class Product
{
    use EntityTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="string",length=150,nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min=1,max=150)
     */
    public string $name;

    /**
     * @ORM\Column(type="string",length=1000,nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min=1,max=1000)
     */
    public string $description;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductPrice", mappedBy="product")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    public PersistentCollection $prices;
}