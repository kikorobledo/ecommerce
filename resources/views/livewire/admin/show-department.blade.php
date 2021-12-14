<div>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Departamento: {{ $department->name }}
        </h2>

    </x-slot>

    <div class="container py-12">

        <x-jet-form-section submit="save" class="mb-6">

            <x-slot name="title">Agregar una nueva ciudad</x-slot>

            <x-slot name="description">Complete la información para agregar una ciudad</x-slot>

            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">

                    <x-jet-label>Nombre</x-jet-label>

                    <x-jet-input type="text" wire:model.defer="createForm.name" class="w-full mt-1"></x-jet-input>

                    <x-jet-input-error for="createForm.name"></x-jet-input-error>

                </div>

                <div class="col-span-6 sm:col-span-4">

                    <x-jet-label>Costo</x-jet-label>

                    <x-jet-input type="number" wire:model="createForm.cost" class="w-full mt-1"></x-jet-input>

                    <x-jet-input-error for="createForm.cost"></x-jet-input-error>

                </div>

            </x-slot>

            <x-slot name="actions">

                <x-jet-action-message class="mr-3" on="saved">Departamento agregado</x-jet-action-message>

                <x-jet-button>Agregar</x-jet-button>

            </x-slot>

        </x-jet-form-section>

        <x-jet-action-section>

            <x-slot name="title">
                Lista de ciudades
            </x-slot>

            <x-slot name="description">
                Aquí encontrara todas las ciudades
            </x-slot>

            <x-slot name="content">

                <table class="text-gray-600">

                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">

                        @foreach($cities as $city)

                            <tr>
                                <td class="py-2">
                                    <a href="{{ route('admin.cities.show', $city) }}" class="uppercase underline hover:text-blue-600">{{ $city->name }}</a>
                                </td>
                                <td >
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a href="#" wire:click="edit('{{ $city->id }}')" class="pr-2 hover:text-blue-600 cursor-pointer">Editar</a>
                                        <a href="#" wire:click="$emit('deleteCity', '{{ $city->id }}')" class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
                                    </div>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </x-slot>

        </x-jet-action-section>

        <x-jet-dialog-modal wire:model="editForm.open">

            <x-slot name="title">Editar ciudad</x-slot>

            <x-slot name="content">

                <div class="space-y-3">

                    <div class="">

                        <x-jet-label>Nombre</x-jet-label>

                        <x-jet-input wire:model.defer="editForm.name" type="text" class="mt-1 w-full"></x-jet-input>

                        <x-jet-input-error for="editForm.name" />

                    </div>

                </div>

                <div class="space-y-3">

                    <div class="">

                        <x-jet-label>Costo</x-jet-label>

                        <x-jet-input wire:model="editForm.cost" type="number" class="mt-1 w-full"></x-jet-input>

                        <x-jet-input-error for="editForm.cost" />

                    </div>

                </div>

            </x-slot>

            <x-slot name="footer">

                <x-jet-danger-button wire:loading.attr="disabled" wire:target="update" wire:click="update">Actualizar</x-jet-danger-button>

            </x-slot>

        </x-jet-dialog-modal>

    </div>

    @push('script')

        <script>

            Livewire.on('deleteCity', cityId => {
                Swal.fire({
                    title: '¿Esta seguro que quiere borrar la información?',
                    text: "No sera posible recuperarla",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borrar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.show-deparment', 'delete', cityId)
                        Swal.fire(
                        '¡Borrada!',
                        'Con exito',
                        'success'
                        )
                    }
                })
            });

        </script>

    @endpush

</div>
