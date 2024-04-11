<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Item::class;
    public function definition(): array
    {
        $imagePath = $this->faker->image(public_path('images'), 640, 480, null, false);

        return [
            //
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2,10,100),
            'countdown_date' => $this->faker->dateTimeBetween('now', '+1 week')-> format('Y-m-d H:i:s'),
            'image' => basename($imagePath),
            'seller_id' => $this->faker->randomDigit(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
