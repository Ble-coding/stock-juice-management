<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    protected $model = Stock::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $products->random()->id, // Sélectionne aléatoirement un ID de produit existant
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 50, 1000000),
            'supplier_id' => $suppliers->random(),
            'user_id' => User::inRandomOrder()->first()->id, // Assign a random user_id
        ];
    }
}
