<div>

    <header class="bg-white shadow-xl">

        <div class="max-w-4xl mx-auto px-4 py-6 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center">

                <h1 class="font-semibold text-xl text-gray-700 leading-tight">Productos</h1>

                <x-jet-danger-button wire:click="$emit('delete')">Eliminar</x-jet-danger-button>

            </div>

        </div>

    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

        <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para actualizar un producto</h1>

        <div class="mb-4" wire:ignore>

            <form
                action="{{ route('admin.products.files', $product) }}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone"
            ></form>

        </div>

        @if($product->images->count())

            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">

                <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del producto</h1>

                <ul class="flex flex-wrap space-x-4">

                    @foreach($product->images as $image)

                        <li class="relative">

                            <img class="object-cover w-32 h-20 " src="{{ Storage::url($image->url) }}" alt="Foto del producto">

                            <x-jet-danger-button
                                class="absolute top-2 right-2"
                                wire:click="deleteImage({{ $image->id }})"
                                wiere:key="image-{{ $image->id }}"
                                wire:loading.attr="disabled"
                                wire:target="deleteImage({{ $image->id }})"
                                >X</x-jet-danger-button>

                        </li>

                    @endforeach

                </ul>

            </section>

        @endif

        @livewire('admin.status-product', ['product' => $product], key('status-product' . $product->id))

        <div class="bg-white rounded-lg shadow-xl p-6">

            {{-- Categoría --}}
            <div class="grid grid-cols-2 gap-4 mb-4">

                <div>

                    <x-jet-label value="Categorías" />

                    <select class="w-full form-control" wire:model="category_id">

                        <option value="" disabled selected>Seleccione una categoría</option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                        @endforeach

                    </select>

                    <x-jet-input-error for="category_id" />

                </div>

                <div>

                    <x-jet-label value="Subcategorías" />

                    <select class="w-full form-control" wire:model="product.subcategory_id">

                        <option value="" disabled selected>Seleccione una subcategoría</option>

                        @foreach($subcategories as $subcategory)

                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>

                        @endforeach

                    </select>

                    <x-jet-input-error for="product.subcategory_id" />

                </div>

            </div>

            {{-- Nombre --}}
            <div class="mb-4">

                <x-jet-label value="Nombre" />

                <x-jet-input class="w-full" type="text" placeholder="Ingrese el nombre del producto" wire:model="product.name" />

                <x-jet-input-error for="product.name" />

            </div>

            {{-- Slug --}}
            <div class="mb-4">

                <x-jet-label value="Slug" />

                <x-jet-input class="w-full bg-gray-200" type="text" wire:model="slug" disabled />

                <x-jet-input-error for="slug" />

            </div>

            {{-- Descripción --}}
            <div class="mb-4">

                <div wire:ignore>

                    <x-jet-label value="Descripción" />

                    <textarea
                        class="w-full form-control"
                        cols="30"
                        rows="4"
                        wire:model="product.description"
                        x-data
                        x-init="
                            ClassicEditor
                            .create( $refs.miEditor )
                            .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('product.description', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );
                        "
                        x-ref="miEditor"
                    >
                    </textarea>

                </div>

                <x-jet-input-error for="product.description" />

            </div>

            {{-- Marca/Precio --}}
            <div class="grid grid-cols-2 gap-4 mb-4">

                <div>

                    <x-jet-label value="Marca" />

                    <select class="w-full form-control" wire:model="product.brand_id">

                        <option value="" disabled selected>Seleccione una marca</option>

                        @foreach($brands as $brand)

                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>

                        @endforeach

                    </select>

                    <x-jet-input-error for="product.brand_id" />

                </div>

                <div>

                    <x-jet-label value="Precio" />

                    <x-jet-input class="w-full" type="number" placeholder="Ingrese el precio del producto" wire:model="product.price" step="0.01" />

                    <x-jet-input-error for="product.price" />

                </div>

            </div>

            @if($this->subcategory)

                @if(!$this->subcategory->color && !$this->subcategory->size)

                    <div class="mb-4">

                        <x-jet-label value="Cantidad" />

                        <x-jet-input class="w-full" type="number" placeholder="Ingrese el precio del producto" wire:model="product.quantity" step="0.01" />

                        <x-jet-input-error for="product.quantity" />

                    </div>

                @endif

            @endif

            <div class="flex justify-end items-center">

                <x-jet-action-message class="mr-3" on="saved">Actualizado</x-jet-action-message>

                <x-jet-button class="" wire:click="save" wire:loading.attr="disabled" wire:target="save">Actualizar Producto</x-jet-button>

            </div>

        </div>

        @if($this->subcategory)

            @if($this->subcategory->size)

                @livewire('admin.size-product', ['product' => $product], key('size-product' . $product->id))

            @elseif($this->subcategory->color)

                @livewire('admin.color-product', ['product' => $product], key('color-product' . $product->id))

            @endif

        @endif

    </div>

    @push('script')

            <script>

                Dropzone.options.myAwesomeDropzone = {
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dictDefaultMessage:"Arrastre una imágen al recuadro",
                    acceptedFiles: 'image/*',
                    paramName: "file",
                    maxFilesize: 2,
                    complete: function(file){

                        this.removeFile(file);

                    },
                    queuecomplete: function(){

                        Livewire.emitTo('admin.edit-product', 'refreshProduct');

                    }
                };

                Livewire.on('deleteSize', size => {
                    Swal.fire({
                        title: '¿Esta seguro que quiere eliminar la información?',
                        text: "¡No sera posble recuperar la información!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, borrar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('adimn.size-product', 'delete', size)
                            Swal.fire(
                            '¡Borrado!'
                            )
                        }
                    })
                })

                Livewire.on('deletePivot', pivot => {
                    Swal.fire({
                        title: '¿Esta seguro que quiere eliminar la información?',
                        text: "¡No sera posble recuperar la información!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, borrar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('admin.color-product','delete', pivot)
                            Swal.fire(
                            '¡Borrado!'
                            )
                        }
                    })
                })

                Livewire.on('deleteColorSize', pivot => {
                    Swal.fire({
                        title: '¿Esta seguro que quiere eliminar la información?',
                        text: "¡No sera posble recuperar la información!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, borrar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('admin.color-size','delete', pivot)
                            Swal.fire(
                            '¡Borrado!'
                            )
                        }
                    })
                })

                Livewire.on('delete', () => {
                    Swal.fire({
                        title: '¿Esta seguro que quiere eliminar la información?',
                        text: "¡No sera posble recuperar la información!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, borrar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('admin.edit-product', 'deleteProduct');
                            Swal.fire(
                            '¡Borrado!'
                            )
                        }
                    })
                })


            </script>

        @endpush

</div>
