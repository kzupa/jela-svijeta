@props(['categories'])

<ul class="h-12">
    @foreach($categories as $category)
        <li">
            {{$category->title}}
        </li>
    @endforeach
</ul>