<div x-data>

    <p class="text-gray-700 mb-4"><span class="font-bold text-lg">Stock disponible: {{ $quantity }}</span></p>

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
                x-bind:disabled="$wire.qty > $wire.quantity"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem"
                class="w-full" color="orange">Agregar al carrito de compras</x-button>

        </div>

    </div>

</div>
