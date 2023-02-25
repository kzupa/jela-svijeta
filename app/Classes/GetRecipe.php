<?php

namespace App\Classes;

use App\Models\Recipe;

class GetRecipe
{
    public $response;

    public function __construct($props)
    {
        $this->response = null;
        $this->locale = ($props->input('lang') == 'de' || $props->input('lang') == 'fr') ? $props->input('lang') : 'en';
    }

    public function call()
    {
        $this->base($this->locale);

        $this->tags($this->locale);
        $this->ingredients($this->locale);
        $this->categories($this->locale);       

        return $this->response;
    }

    private function base($locale)
    {
        $this->response = Recipe::select('recipes.*')
                                 ->with('recipe_translations', function ($query) use ($locale) {
                                   return $query->where('locale', '=', $locale);
                                 });
    }

    private function tags($locale)
    {
        $this->response->with('tags', function ($query) use ($locale) {
            return $query->where('locale', '=', $locale);
          });
    }

    private function ingredients($locale)
    {
        $this->response->with('ingredients', function ($query) use ($locale) {
            return $query->where('locale', '=', $locale);
          });

    }

    private function categories($locale)
    {
        $this->response->with('categories', function ($query) use ($locale) {
            return $query->where('locale', '=', $locale);
          });
    }
}