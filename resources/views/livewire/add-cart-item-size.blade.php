<div class="space-y-3" x-data>

    <div>

        <p class="text-xl text-gray-700 mb-4">Talla:</p>

        <select class="form-control w-full" wire:model="size_id">

            <option value="" selected disabled>Seleccionar una talla</option>

            @foreach ($sizes as $size)

                <option value="{{ $size->id }}">{{ $size->name }}</option>

            @endforeach

        </select>

    </div>

    <div>

        <p class="text-xl text-gray-700 mb-4">Color:</p>

        <select class="form-control w-full"  wire:model="color_id">

            <option value="" selected disabled>Seleccionar un color</option>

            @foreach ($colors as $color)

                <option class="capitalize" value="{{ $color->id }}">{{ __($color->name) }}</option>

            @endforeach

        </select>

    </div>

    <p class="text-gray-700 mb-4">

        <span class="font-bold text-lg">Stock disponible:</span>

        @if($quantity)

            {{ $quantity }}

        @else

            {{ $product->stock }}

        @endif

    </p>

    <div class="flex space-x-4">

        <div>

            <x-jet-secondary-button
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement"
            >-</x-jet-secondary-button>

            <span class="text-gray-700 mx-3">{{ $qty }}</span>

            <x-jet-secondary-button
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment"
            >+</x-jet-secondary-button>

        </div>

        <div class="flex-1">

            <x-button

                x-bind:disabled="!$wire.quantity"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem"
                class="w-full"
                color="orange"
            >Agregar al carrito de compras</x-button>

        </div>

    </div>

</div>
