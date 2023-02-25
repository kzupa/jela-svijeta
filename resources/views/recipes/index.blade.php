<x-layout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($recipes) == 0)

    @foreach($recipes as $recipe)
    <x-recipe-card :recipe="$recipe" />
    @endforeach

    @else
    <p>There are no recipes found</p>
    @endunless

  </div>

</x-layout>