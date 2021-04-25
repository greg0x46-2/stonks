<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['B', 'S'];

        return [
            'type' => $types[rand(0,1)],
            'executed_at' => now(),
            'amount' => rand(1, 9999999) / rand(1, 9),
            'price' => rand(1, 9999999) / rand(1, 9),
        ];
    }
}
