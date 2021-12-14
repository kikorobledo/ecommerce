@props([
    'category'
])


<div class="grid grid-cols-4 p-4">

    <div>

        <p class="text-lg font-bold text-center text-trueGray-500 space-y-3">Subcategorias</p>

        <ul>

            @foreach($category->subcategories as $subCategory)

                <li>

                    <a href="{{ route('categories.show', $category) . '?subcategoria=' . $subCategory->slug }}" class="text-trueGray-500 font-semibold py-1 px-4 hover:text-orange-500 block">{{ $subCategory->name }}</a>

                </li>

            @endforeach

        </ul>

    </div>

    <div class="col-span-3">

        <img class="h-64 w-full object-cover object-center" src="{{ Storage::url($category->image) }}" alt="Category image">

    </div>

</div>
