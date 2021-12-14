<div>

    <div class="bg-white shadow-xl rounded-lg p-6 mb-4">

        <p class="text-2xl text-center font-semibold mb-2">Estado del producto</p>

        <div class="flex space-x-6">

            <label>

                <input name="status" type="radio" value="1" wire:model.defer="status">
                Marcar producto como borrador
            </label>

            <label>

                <input name="status" type="radio" value="2" wire:model.defer="status">
                Marcar producto como publicado
            </label>

        </div>

        <div class="flex justify-end items-center">

            <x-jet-action-message class="mr-3" on="saved">Actualizado</x-jet-action-message>

            <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save">Actualizar</x-jet-button>

        </div>

    </div>

</div>
