@props(['recipe'])

<x-card class="inline-block group p-6 border-2 hover:bg-blue-50 hover:border-gray-300">
    <div>
        <div>
            <h3 class="text-2xl">
                <a href="/recipes/{{$recipe->id}}">{{$recipe->recipe_translations[0]->name}}</a>
            </h3>
            <x-recipe-categories :categories="$recipe->categories" />
            <x-recipe-tags :tags="$recipe->tags" />
            <x-recipe-ingredients :ingredients="$recipe->ingredients" />
            <div class="text-sm mb-4">{{$recipe->recipe_translations[0]->description}}</div>
            <div class="text-lg mb-4">Status: {{$recipe->status}}</div>
            <div class="text-lg mb-4">Deleted: {{$recipe->status == 'deleted' ? $recipe->deleted_at : 'NA'}}</div>
        </div>
    </div>
</x-card>