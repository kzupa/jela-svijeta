<x-layout>
    <div class="mx-4">
        <x-card>
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6" src="{{asset('images/hamburger.png')}}" alt=""/>
                <h3 class="text-2xl mb-2">{{$recipe->recipe_translations[0]->name}}</h3>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <x-recipe-categories :categories="$recipe->categories" />
                    <x-recipe-tags :tags="$recipe->tags" />
                    <x-recipe-ingredients :ingredients="$recipe->ingredients" />
                    <div class="text-lg space-y-6">{{$recipe->recipe_translations[0]->description}}</div>
                </div>
            </div>
        </x-card>
    </div>
</x-layout>