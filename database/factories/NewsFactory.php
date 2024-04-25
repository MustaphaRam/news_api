<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->title(),
            'contenu' => fake()->text(),
            'Categorie' => 'Str::random(10)',
            'Date_debut' => now(),
            'Date_expiration' => "",
        ];
    }
}
