<?php

namespace App\Classes;

use App\Models\Recipe;

class FetchRecipes
{
    public $response;

    public function __construct($props)
    {
        $this->response = null;
        $this->locale = ($props->input('lang') == 'de' || $props->input('lang') == 'fr') ? $props->input('lang') : 'en';
        $this->diff_time = $props->input('diff_time');
        $this->with = explode(',', $props->input('with')) ?? false;
        $this->tags = explode(',', $props->input('tags')) ?? false;
        $this->categories = explode(',', $props->input('categories')) ?? false;
    }

    public function call()
    {
        // Builds base structure with recipes and their translations
        $this->base($this->locale);

        // Filtering by diff_time
        $this->filter_by_time($this->diff_time);

        // Decides to include tags, ingredients and categories by value of with
        in_array('tags', $this->with) ? $this->tags($this->locale) : $this->tags('NULL');
        in_array('ingredients', $this->with) ? $this->ingredients($this->locale) : $this->ingredients('NULL');
        in_array('categories', $this->with) ? $this->categories($this->locale) : $this->categories('NULL');         

        // Filters by tag property
        if($this->tags)
            $this->filter_tags($this->tags);

        // Filters by categories property
        if($this->categories)
            $this->filter_categories($this->categories);

        return $this->response;
    }

    private function base($locale)
    {
        $this->response = Recipe::select('recipes.*')
                                ->with('recipe_translations', function ($query) use ($locale) {
                                    return $query->where('locale', '=', $locale);
                                  });
    }

    private function filter_by_time($diff_time)
    {
        if(!is_numeric($diff_time))
            $this->response->where('status', '!=', 'deleted');
        else
        {
            $date_time = gmdate("Y-m-d H:i:s", $diff_time);
            $this->response->where(function($query) use ($date_time){
                               $query->where('created_at', '>=', $date_time)
                                     ->orWhere('updated_at', '>=', $date_time)
                                     ->orWhere('deleted_at', '>=', $date_time);
                             });
        }
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

    private function filter_tags($tags)
    {
        foreach($tags as $tag)
        {
            if(is_numeric($tag))
            {
                $this->response->whereHas('tags', function($query) use ($tag){
                    $query->where('title', 'LIKE', 'Tag_______' . $tag);
                });
            }
        }
    }

    private function filter_categories($categories)
    {
        foreach($categories as $category)
        {
            if(is_numeric($category))
            {
                $this->response->whereHas('categories', function($query) use ($category){
                                   $query->where('title', 'LIKE', 'Category______' . $category);
                                 });
            }
            elseif($category == 'null')
            {
                $this->response->doesntHave('categories');
            }
        }
    }
}