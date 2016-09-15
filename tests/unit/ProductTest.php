<?php

use App\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{

    protected $product;

    public function setUp()
    {
        $this->product = new Product('The Final Empire', 59);
    }

    public function testAProductHasName()
    {
        $this->assertEquals('The Final Empire', $this->product->name());

    }
    public function testAProductHasCost()
    {

        $this->assertEquals(59, $this->product->cost());

    }

}