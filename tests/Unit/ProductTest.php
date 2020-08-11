<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    protected $product; 

    protected function addNewProduct()
    {
        $this->product = new Product("Fallout 4", 25);
    }

    /** @test */
    public function product_has_a_name()
    {
        $this->addNewProduct();
        $this->assertEquals("Fallout 4",$this->product->getName());
    }
    /** @test */
    public function ProductHasAPrice()
    {        
        $this->addNewProduct();
        $this->assertEquals(25,$this->product->getPrice());
    }
}
