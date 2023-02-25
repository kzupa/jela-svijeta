@props(['ingredients'])

<ul class="list-disc list-inside m-2 ml-6">
    @foreach($ingredients as $ingredient)
        <li>
            {{$ingredient->title}}
        </li>
    @endforeach
</ul>