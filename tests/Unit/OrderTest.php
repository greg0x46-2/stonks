<?php


namespace Tests\Unit;


use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_total_fee_method()
    {
        $order = Order::factory()
            ->state(['price' => 50, 'amount' => 2, 'fee' => 5, 'fee_percentage' => 1.5])
            ->make();

        $this->assertEquals(6.5, $order->totalFee());
    }

    public function test_total_price_method()
    {
        $order = Order::factory()
            ->state(['price' => 50, 'amount' => 2, 'fee' => 5, 'fee_percentage' => 2])
            ->make();

        $this->assertEquals(107, $order->totalPrice());
    }
}
