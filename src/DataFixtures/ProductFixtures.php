<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\ProductPrice;

class ProductFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $em)
    {
        $samples = $this->getSamples();
        
        foreach ( $samples as $values )
        {
            $product = new Product(['name' => $values['name']]);
            $em->persist($product);

            foreach ( $values['prices'] as $currency => $value)
            {
                $productPrice = new ProductPrice([
                   'product' => $product,
                   'value' => $value,
                   'currency' => $currency,
                ]);
                $em->persist($productPrice);
            }

            $em->flush();
        }
    }

    private function getSamples(): array
    {
        $products = [];
        
        $products[] = ['name' => 'hub asmbl','prices' => ['PLN' => 19999]];
        $products[] = ['name' => 'hub seal','prices' => ['USD' => 299]];
        $products[] = ['name' => 'knuckle seal','prices' => ['EUR' => 899]];
        $products[] = ['name' => 'inner bearing','prices' => ['PLN' => 5769]];
        $products[] = ['name' => 'outer bearing','prices' => ['USD' => 3969]];
        $products[] = ['name' => 'seal-dust','prices' => ['EUR' => 959]];

        return $products;
    }
}