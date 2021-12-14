<div>

    <x-jet-dropdown width="96">

        <x-slot name="trigger">

            <span class="relative inline-block cursor-pointer">

                <x-cart color="white" />

                @if(Cart::count())

                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>

                @else

                    <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>

                @endif

            </span>

        </x-slot>

        <x-slot name="content">

            <ul class="">

                @forelse (Cart::content() as $item)

                    <li class="flex p-2 border-b border-gray-200">

                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="Imagen del producto">

                        <article class="flex-1">

                            <h1 class="font-bold">{{ $item->name }}</h1>

                            <div class="flex">

                                <p class="">Cant: {{ $item->qty }}</p>

                                @isset($item->options['color'])

                                    <p class="mx-2 capitalize">- Color: {{ __($item->options->color) }}</p>

                                @endisset

                                @isset($item->options['size'])

                                    <p class="mx-2 capitalize">{{ $item->options->size }}</p>

                                @endisset

                            </div>

                            <p class="">USD {{ $item->price }}</p>

                        </article>

                    </li>

                @empty

                    <div class="px-4 py-6">

                        <p class="text-center text-gray-500">No tiene agregado ningun item en el carrito.</p>

                    </div>

                @endforelse

            </ul>

            @if(Cart::count())

                <div class="p-2 px-3">

                    <p class="mt-2 text-lg text-gray-700 mb-3"><span class="font-bold">Total: USD {{ Cart::subtotal() }}</span></p>

                    <x-button-enlace href="{{ route('shopping-cart')}}" class="w-full" color="orange">Ir al carrito de compras</x-button-enlace>

                </div>

            @endif

        </x-slot>

    </x-jet-dropdown>

</div>
