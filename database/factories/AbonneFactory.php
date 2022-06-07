<?php

namespace Database\Factories;

use App\Models\Abonne;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AbonneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Abonne::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->name,
            'abonnement_fin' => $this->faker->date,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'photo' => $this->faker->imageUrl()
        ];
    }
}
