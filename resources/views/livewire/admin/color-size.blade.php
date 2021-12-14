<div class="mt-4">

    <div class="bg-gray-100 rounded-lg shadow-lg p-6">

        <div class="mb-6">

            <x-jet-label>Color</x-jet-label>

            <div class="grid grid-cols-6 gap-4">

                @foreach($colors as $color)

                    <label >

                        <input type="radio" name="color_id" value="{{ $color->id }}" wire:model.defer="color_id">

                        <span class="ml-2 text-gray-700 capitalize">{{ __($color->name) }}</span>

                    </label>

                @endforeach

            </div>

            <x-jet-input-error for="color_id" />

        </div>

        <div class="mb-4">

            <x-jet-label>Cantidad</x-jet-label>

            <x-jet-input type="number" wire:model.defer="quantity" placeholder="Ingrese una cantidad" class="w-full"></x-jet-input>

            <x-jet-input-error for="quantity" />

        </div>

        <div class="flex justify-end items-center">

            <x-jet-action-message class="mr-3" on="saved">Agregado</x-jet-action-message>

            <x-jet-button class="" wire:click="save" wire:loading.attr="disabled" wire:target="save">Agregar</x-jet-button>

        </div>

    </div>

    @if($size_colors->count())

        <div class="mt-8">

            <table>

                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($size_colors as $size_color)

                        <tr wire:key="size_color-{{ $size_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">{{ __($colors->find($size_color->pivot->color_id)->name) }}</td>
                            <td class="px-4 py-2">{{$size_color->pivot->quantity}} Unidades</td>
                            <td class="px-4 py-2 flex">

                                <x-jet-secondary-button
                                    class="ml-auto mr-2"
                                    wire:click="edit({{$size_color->pivot->id}})"
                                    wire:loading.attr="disabled"
                                    wire:target="edit({{$size_color->pivot->id}})"
                                >
                                Actualizar</x-jet-secondary-button>

                                <x-jet-danger-button wire:click="$emit('deleteColorSize', {{$size_color->pivot->id}})">Eliminar</x-jet-danger-button>

                            </td>
                        </tr>

                    @endforeach
                </tbody>

            </table>

        </div>

    @endif

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">Editar colores</x-slot>

        <x-slot name="content">

            <div class="mb-4">

                <x-jet-label>Color</x-jet-label>

                <select class="w-full form-control" wire:model="pivot_color_id">

                    <option value="">Seleccione un color</option>

                    @foreach($colors as $color)

                        <option value="{{ $color->id }}">{{ ucfirst(__($color->name)) }}</option>

                    @endforeach

                </select>

            </div>

            <div>

                <x-jet-label>Cantidad</x-jet-label>

                <x-jet-input wire:model="pivot_quantity" type="number" placeholder="Ingrese una cantidad" class="w-full"></x-jet-input>

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button  wire:click="$set('open', false)" wire:loading.attr="disabled">Cancelar</x-jet-secondary-button>

            <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update">Actualizar</x-jet-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
