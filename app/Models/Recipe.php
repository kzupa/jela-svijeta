<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Recipe extends Model
{
    use HasFactory;
    use Translatable;

    public function recipe_translations()
    {
        return $this->hasMany('App\Models\RecipeTranslation');
    }

    public function tags()
    {
        return $this->hasManyThrough('App\Models\TagTranslation', 'App\Models\Tag');
    }

    public function ingredients()
    {
        return $this->hasManyThrough('App\Models\IngredientTranslation', 'App\Models\Ingredient');
    }

    public function categories()
    {
        return $this->hasManyThrough('App\Models\CategoryTranslation', 'App\Models\Category');
    }

    public $translatedAttributes = ['name', 'description'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('category', 'like', '%' . request('search') . '%')
            ->orWhere('ingredients', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}
