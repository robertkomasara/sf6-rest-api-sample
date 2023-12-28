<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="api_fixtures")
 */
class ApiFixture
{
    use EntityTrait;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @ORM\Column(name="fixture", type="string", nullable=false)
     */
    private string $fixture;

    /**
     * @ORM\Column(name="loaded_at", type="datetime", nullable=false)
     */
    private \DateTime $loadedAt;
}
