<div>

    <x-jet-form-section submit="save" class="mb-6">

        <x-slot name="title">

            Crear nueva categorías

        </x-slot>

        <x-slot name="description">

            Complete la información necesaria para crear la categoría

        </x-slot>

        <x-slot name="form">

            <div class=" col-span-6 sm:col-span-4">

                <x-jet-label>Nombre</x-jet-label>

                <x-jet-input wire:model="createForm.name" type="text" class="mt-1 w-full"></x-jet-input>

                <x-jet-input-error for="createForm.name" />

            </div>

            <div class=" col-span-6 sm:col-span-4">

                <x-jet-label>Slug</x-jet-label>

                <x-jet-input wire:model="createForm.slug" disabled type="text" class="mt-1 w-full bg-gray-100"></x-jet-input>

                <x-jet-input-error for="createForm.slug" />

            </div>

            <div class=" col-span-6 sm:col-span-4">

                <x-jet-label>Icono</x-jet-label>

                <x-jet-input wire:model.defer="createForm.icon" type="text" class="mt-1 w-full"></x-jet-input>

                <x-jet-input-error for="createForm.icon" />

            </div>

            <div class=" col-span-6 sm:col-span-4">

                <x-jet-label>Marcas</x-jet-label>

                <div class="grid grid-cols-4">

                    @foreach($brands as $brand)

                        <x-jet-label>

                            <x-jet-checkbox
                                wire:model.defer="createForm.brands"
                                name="brands[]"
                                value="{{ $brand->id }}"
                            />{{ $brand->name }}

                        </x-jet-label>

                    @endforeach

                </div>

                <x-jet-input-error for="createForm.brands" />

            </div>

            <div class=" col-span-6 sm:col-span-4">

                <x-jet-label>Imagen</x-jet-label>

                <x-jet-input wire:model="createForm.image" type="file" class="mt-1 w-full" id="rand" accept="image/*"></x-jet-input>

                <x-jet-input-error for="createForm.image" />

            </div>

        </x-slot>

        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">Categoría creada</x-jet-action-message>

            <x-jet-button>Agregar</x-jet-button>

        </x-slot>

    </x-jet-form-section>

    <x-jet-action-section>

        <x-slot name="title">
            Lista de categorías
        </x-slot>

        <x-slot name="description">
            Aquí encontrara todas las categorías
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

                    @foreach($categories as $category)

                        <tr>
                            <td class="py-2">
                                <span class="mr-3 inline-block w-8 text-center">{!! $category->icon !!}</span>
                                <a href="{{ route('admin.categories.show', $category) }}" class="uppercase underline hover:text-blue-600">{{ $category->name }}</a>
                            </td>
                            <td >
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a href="#" wire:click="edit('{{ $category->slug }}')" class="pr-2 hover:text-blue-600 cursor-pointer">Editar</a>
                                    <a href="#" wire:click="$emit('deleteCategory', '{{ $category->slug }}')" class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </x-slot>

    </x-jet-action-section>

    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">Editar categoría</x-slot>

        <x-slot name="content">

            <div class="">

                @if($editImage)

                    <img class="w-full h-64 object-cover object-center" src="{{ $editImage->temporaryUrl() }}" alt="">

                @else

                    <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($editForm['image']) }}" alt="">

                @endif

            </div>

            <div class="space-y-3">

                <div class="">

                    <x-jet-label>Nombre</x-jet-label>

                    <x-jet-input wire:model="editForm.name" type="text" class="mt-1 w-full"></x-jet-input>

                    <x-jet-input-error for="editForm.name" />

                </div>

                <div class="">

                    <x-jet-label>Slug</x-jet-label>

                    <x-jet-input wire:model="editForm.slug" disabled type="text" class="mt-1 w-full bg-gray-100"></x-jet-input>

                    <x-jet-input-error for="editForm.slug" />

                </div>

                <div class="">

                    <x-jet-label>Icono</x-jet-label>

                    <x-jet-input wire:model.defer="editForm.icon" type="text" class="mt-1 w-full"></x-jet-input>

                    <x-jet-input-error for="editForm.icon" />

                </div>

                <div class="">

                    <x-jet-label>Marcas</x-jet-label>

                    <div class="grid grid-cols-4">

                        @foreach($brands as $brand)

                            <x-jet-label>

                                <x-jet-checkbox
                                    wire:model.defer="editForm.brands"
                                    name="brands[]"
                                    value="{{ $brand->id }}"
                                />{{ $brand->name }}

                            </x-jet-label>

                        @endforeach

                    </div>

                    <x-jet-input-error for="editForm.brands" />

                </div>

                <div class="">

                    <x-jet-label>Imagen</x-jet-label>

                    <x-jet-input wire:model="editImage" type="file" class="mt-1 w-full" id="rand" accept="image/*"></x-jet-input>

                    <x-jet-input-error for="editImage" />

                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-danger-button wire:loading.attr="disabled" wire:target="editImage, update" wire:click="update">Actualizar</x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

    @push('script')

        <script>

            Livewire.on('deleteCategory', categorySlug => {
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
                        Livewire.emitTo('admin.create-category', 'delete', categorySlug)
                        Swal.fire(
                        '¡Borrada!',
                        'Con exito'
                        )
                    }
                })
            });

        </script>

    @endpush

</div>
