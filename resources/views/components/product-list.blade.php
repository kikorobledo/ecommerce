@props([
    'product'
])

<li class="bg-white rounded-lg shadow">

    <article class="md:flex">

        <figure>

            <img class="h-48 w-full md:w-56 object-cover object-center" src="{{ Storage::url($product->images->first()->url)}}" alt="">

        </figure>

        <div class="flex-1 py-4 px-6 flex flex-col">

            <div class="lg:flex justify-between">

                <div>

                    <h1 class="font-bold text-lg text-gray-700">{{ $product->name }}</h1>

                    <p class="font-bold text-gray-700">USD {{ $product->price }}</p>

                </div>

                <div class="flex space-x-2 items-center">

                    <ul class="flex text-sm text-yellow-400 space-x-3">

                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>

                    </ul>

                    <span class="text-gray-700 text-sm">(24)</span>

                </div>

            </div>

            <div class="mt-4 md:mt-auto">

                <x-danger-enlace href="{{ route('products.show', $product) }}">Más información</x-danger-enlace>

            </div>

        </div>

    </article>

</li>
