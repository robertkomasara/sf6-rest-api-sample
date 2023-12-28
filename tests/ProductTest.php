<?php 

namespace App\Tests;

use App\Entity\Product;
use App\Entity\ProductPrice;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testAddProduct(): void
    {
        $product = new Product([
            'name' => 'test name',
            'description' => 'test description',
        ]);

        $this->assertInstanceOf(Product::class,$product);

        $productPrice = new ProductPrice([
            'product' => $product,
            'currency' => 'PLN',
            'value' => 12345,
        ]);

        $this->assertInstanceOf(ProductPrice::class,$productPrice);
    }
}