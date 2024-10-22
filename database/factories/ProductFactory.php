<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => $faker->unique()->word,
        //     'description' => $this->faker->sentence,
        //     'price' => $this->faker->randomFloat(2, 50, 1000000),
        //     'stock_quantity' => $this->faker->numberBetween(1, 100),
        //     'user_id' => User::inRandomOrder()->first()->id, // Assign a random user_id
        // ];

        // return [
        //     'title' => $this->faker->sentence,
        //     'regular_price' => $this->faker->randomFloat(2, 10, 100),
        //     'sale_price' => $this->faker->optional()->randomFloat(2, 5, 50),
        //     'stock' => $this->faker->numberBetween(1, 100),
        //     'sku' => 'SKU-' . strtoupper($this->faker->unique()->bothify('##??##')),
        //     'category_id' => Category::inRandomOrder()->first()->id,  // Catégorie aléatoire
        // ];

        return [
            'title' => $this->faker->words(3, true), // Générer un titre de produit aléatoire
            'regular_price' => $this->faker->randomFloat(2, 100, 1000), // Générer un prix régulier entre 100 et 1000
            'sale_price' => $this->faker->optional()->randomFloat(2, 50, 900), // Générer un prix de vente optionnel
            'stock' => $this->faker->numberBetween(10, 200),
            'sku' => $this->faker->unique()->bothify('UY-####'),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['New', 'Featured', 'Out of Stock']),
            'is_starred' => $this->faker->boolean(30),
        ];


    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Attacher des catégories après la création du produit
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id'); // Récupérer 1 à 3 catégories aléatoires
            $product->categories()->attach($categories); // Insérer dans la table pivot
        })->afterCreating(function (Product $product) {
            // Attacher des tags après la création du produit
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id'); // Récupérer 1 à 5 tags aléatoires
            $product->tags()->attach($tags); // Insérer dans la table pivot
        });
    }

}
