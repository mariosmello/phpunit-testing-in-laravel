<?php

use App\Product;
use App\Order;

class OrderTest extends PHPUnit_Framework_TestCase
{

    protected function createOrderWithProducts()
    {
        $order = new Order();

        $product1 = new Product('100 anos de solidão', 50);
        $product2 = new Product('Memórias de minhas putas tristes', 30);

        $order->addProduct($product1);
        $order->addProduct($product2);

        return $order;
    }

    public function testCountOfProductsIntoOrder()
    {
        $order = $this->createOrderWithProducts();

        $this->assertCount(2, $order->products());
    }

    public function testTotalCostOrder()
    {
        $order = $this->createOrderWithProducts();

        $this->assertEquals(80, $order->total());
    }

}