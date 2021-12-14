<div class="container py-12">

    <x-jet-form-section submit="save" class="mb-6">

        <x-slot name="title">Nueva marca</x-slot>

        <x-slot name="description">En esta sección podra agregar una nueva marca</x-slot>

        <x-slot name="form">

            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input type="text" wire:model="createForm.name" class="w-full"></x-jet-input>

                <x-jet-input-error for="createForm.name"></x-jet-input-error>

            </div>

        </x-slot>

        <x-slot name="actions">

            <x-jet-button>Agregar</x-jet-button>

        </x-slot>

    </x-jet-form-section>

    <x-jet-action-section>

        <x-slot name="title">
            Lista de marcas
        </x-slot>

        <x-slot name="description">
            Aquí encontrara todas las marcas agregadas
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

                    @foreach($brands as $brand)

                        <tr>
                            <td class="py-2">
                                <span class="uppercase">{{ $brand->name }}</span>
                            </td>
                            <td >
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a href="#" wire:click="edit('{{ $brand->id }}')" class="pr-2 hover:text-blue-600 cursor-pointer">Editar</a>
                                    <a href="#" wire:click="$emit('deleteBrand', '{{ $brand->id }}')" class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </x-slot>

    </x-jet-action-section>

    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">Editar Marca</x-slot>

        <x-slot name="content">

            <x-jet-label>Nombre</x-jet-label>

            <x-jet-input type="text" wire:model="editForm.name" class="w-full"></x-jet-input>

                <x-jet-input-error for="editForm.name"></x-jet-input-error>

        </x-slot>

        <x-slot name="footer">

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">Actualizar</x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

    @push('script')

        <script>

            Livewire.on('deleteBrand', subcategoryId => {
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
                        Livewire.emitTo('admin.brand-component', 'delete', subcategoryId)
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
