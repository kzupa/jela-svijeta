<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeTranslation;
use App\Models\Tag;
use App\Models\TagTranslation;
use App\Models\Ingredient;
use App\Models\IngredientTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($counter = 1; $counter <= 50; $counter++)
        {
            $updated = $faker->randomElement([true, false, false]);
            $created_at = $faker->dateTimeBetween('-2 years', '-1 week');
            $status = $updated ? $faker->randomElement(['updated', 'updated', 'updated', 'deleted']) : $faker->randomElement(['created', 'created', 'created', 'deleted']);
            Recipe::factory()->create([
                'status' => $status,
                'created_at' => $created_at,
                'updated_at' => $updated ? $faker->dateTimeBetween($created_at, '-1 minute') : $created_at,
                'deleted_at' => $status == 'deleted' ? $faker->dateTimeBetween($created_at, '-1 minute') : null,
            ]);
        }

        foreach(Recipe::all() as $key=>$value)
        {
            RecipeTranslation::factory()->withLocale('en_GB', $value->id)->create(['locale' => 'en', 'recipe_id' => $value->id]);
            RecipeTranslation::factory()->withLocale('fr_FR', $value->id)->create(['locale' => 'fr', 'recipe_id' => $value->id]);
            RecipeTranslation::factory()->withLocale('de_DE', $value->id)->create(['locale' => 'de', 'recipe_id' => $value->id]);

            $random = $faker->numberBetween(1,7);
            for($count = 0; $count < $random; $count++)
            {
                $tag = Tag::factory()->create(['recipe_id' => $value->id]);
                $random_tag_name = $faker->numberBetween(1,20);
                $id = $tag->pluck('id')->last();

                TagTranslation::factory()->withLocale('en_GB', $random_tag_name, $id)->create(['locale' => 'en', 'tag_id' => $id]);
                TagTranslation::factory()->withLocale('fr_FR', $random_tag_name, $id)->create(['locale' => 'fr', 'tag_id' => $id]);
                TagTranslation::factory()->withLocale('de_DE', $random_tag_name, $id)->create(['locale' => 'de', 'tag_id' => $id]);
            }

            $random = $faker->numberBetween(1,12);
            for($count = 0; $count < $random; $count++)
            {
                $ingredient = Ingredient::factory()->create(['recipe_id' => $value->id]);
                $random_ingredient_name = $faker->numberBetween(1,35);
                $id = $ingredient->pluck('id')->last();

                IngredientTranslation::factory()->withLocale('en_GB', $random_ingredient_name, $id)->create(['locale' => 'en', 'ingredient_id' => $id]);
                IngredientTranslation::factory()->withLocale('fr_FR', $random_ingredient_name, $id)->create(['locale' => 'fr', 'ingredient_id' => $id]);
                IngredientTranslation::factory()->withLocale('de_DE', $random_ingredient_name, $id)->create(['locale' => 'de', 'ingredient_id' => $id]);
            }

            $random = $faker->numberBetween(0,3);
            for($count = 0; $count < $random; $count++)
            {
                $category = Category::factory()->create(['recipe_id' => $value->id]);
                $random_category_name = $faker->numberBetween(1,10);
                $id = $category->pluck('id')->last();

                CategoryTranslation::factory()->withLocale('en_GB', $random_category_name, $id)->create(['locale' => 'en', 'category_id' => $id]);
                CategoryTranslation::factory()->withLocale('fr_FR', $random_category_name, $id)->create(['locale' => 'fr', 'category_id' => $id]);
                CategoryTranslation::factory()->withLocale('de_DE', $random_category_name, $id)->create(['locale' => 'de', 'category_id' => $id]);
            }
        }
    }
}
