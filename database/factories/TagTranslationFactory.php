<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class TagTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [];
    }

    public function withLocale($locale, $name_suffix, $id)
    {
        return $this->state([
            'title' => 'Tag_' . $locale . '_' . $name_suffix,
            'slug' => 'Tag-' . $id,
        ]);
    }
}
