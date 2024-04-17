<?php

namespace Database\Factories\Backend\Orders;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'delivery_type' => 'livraison à domicile',
            'delivery_location' => fake()->address(),
            'customer_id' => 1,
            'total' => '50',
            'status' => 'en attente de paiement',
        ];
    }
}
