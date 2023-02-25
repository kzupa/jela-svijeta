<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class RecipeTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return([]);
    }

    public function withLocale($locale, $id)
    {
        return $this->state([
            'name' => 'Recipe name number ' . $id . ' on ' . $locale,
            'description' => 'Recipe description number ' . $id . ' on ' . $locale,
        ]);
    }
}
