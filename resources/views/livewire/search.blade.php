<div class="flex-1 relative " x-data>

    <form action="{{ route('search') }}"  autocomplete="off">

        <x-jet-input wire:model="search" name="name" type="text" class="w-full " placeholder="¿Estas buscando algun producto?"/>

        <button class="absolute top-0 right-0 w-12 h-full bg-orange-600 flex items-center justify-center rounded-r-md text-white">

            <x-search color="white" />

        </button>

    </form>

    <div
        :class="{ 'hidden' : !$wire.open }"
        x-on:click.away="$wire.open = false"
        class="absolute w-full hidden"
    >

        <div class="bg-white rounded-lg shadow mt-1">

            <div class="px-4 py-3 space-y-1">

                @forelse ($products as $product)

                    <div class="flex overflow-y-auto">

                        <a class="block" href="{{ route('products.show', $product->id) }}">

                            <img class="w-16 h-12 object-cover" src="{{ Storage::url($product->images->first()->url) }}" alt="Imágen del producto">

                            <div class="ml-4 text-gray-700">

                                <p class="text-xl font-semibold leading-5">{{ $product->name }}</p>

                                <p>Categoría: {{ $product->subcategory->category->name }}</p>

                        </a>

                        </div>

                    </div>

                @empty

                    <p class="text-xl font-semibold leading-5 text-center my-5">No existe ningún registro con los parametros especificados</p>

                @endforelse

            </div>

        </div>

    </div>

</div>
