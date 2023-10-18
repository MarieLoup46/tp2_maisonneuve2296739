<?php

namespace Database\Factories;
use App\Models\Etudiant;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_fr' => $this->faker->name(),
            'adresse' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'date_naissance' => $this->faker->date(),
            'ville_id' => ville::all()->random()->id
        ];
    }
}
