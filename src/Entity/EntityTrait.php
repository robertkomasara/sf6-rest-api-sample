<?php

namespace App\Entity;

trait EntityTrait
{
    public function getId(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return json_encode($this);
    }
    
    public function __construct(private array $values = [])
    {
        if ( sizeof($this->values) ){
            foreach( $values as $column => $value )
            {
                if ( property_exists($this,$column) ){
                    $this->{$column} = $value;
                }
            }    
        }
    }
}
