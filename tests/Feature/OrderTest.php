<?php

namespace Tests\Feature;

use App\Models\Asset;
use App\Models\Market;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_create()
    {
        Sanctum::actingAs(User::factory()->create());

        $relations = [
            'asset_id' => Asset::factory()->create()->id,
            'market_id' => Market::factory()->create()->id
        ];

        $this->withHeaders(['accept' => 'application/json'])
            ->post('/api/order', array_merge(
                Order::factory()->state(['type' => 'B'])->make()->toArray(),
                $relations
            ))
            ->assertStatus(201);

        $this->withHeaders(['accept' => 'application/json'])
            ->post('/api/order', array_merge(
                Order::factory()->state(['type' => 'S'])->make()->toArray(),
                $relations
            ))
            ->assertStatus(201);
    }

    public function test_on_create_order_event()
    {
        $user = User::factory()->create();
        $assets = Asset::factory()->count(2)->create();
        $markets = Market::factory()->count(2)->create();
        Wallet::factory()->for($markets[0])->for($user)->create();
        $wallet = Wallet::factory()->for($markets[1])->for($user)->create();

        Sanctum::actingAs($user);

        $order = Order::factory()->state(['price' => 20, 'amount' => 2, 'type' => 'B'])
            ->for($assets[0])
            ->for($wallet)
            ->create();

        $this->assertEquals(2, $order->wallet->asset($order->asset)->pivot->amount);
        $this->assertEquals(20, $order->wallet->asset($order->asset)->pivot->avg_price);

        $order = Order::factory()->state(['price' => 10, 'amount' => 1, 'type' => 'S'])
            ->for($assets[0])
            ->for($wallet)
            ->create();

        $this->assertEquals(1, $order->wallet->asset($order->asset)->pivot->amount);
        $this->assertEquals(20, $order->wallet->asset($order->asset)->pivot->avg_price);


        $order = Order::factory()->state(['price' => 10, 'amount' => 2, 'type' => 'B'])
            ->for($assets[0])
            ->for($wallet)
            ->create();


        $this->assertEquals(3, $order->wallet->asset($order->asset)->pivot->amount);
        $this->assertEquals(13.333333333333, $order->wallet->asset($order->asset)->pivot->avg_price);
    }
}
