<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $imagePath = $this->faker->image(public_path('images'), 640, 480, null, false);

        return [
            //
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'starting_price' => $this->faker->randomFloat(2,10,100),
            'countdown_date' => date('Y-m-d H:i:s'),
            'image' => basename($imagePath),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
}
