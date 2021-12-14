<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>

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

            <select class="w-full form-control" wire:model="subcategory_id">

                <option value="" disabled selected>Seleccione una subcategoría</option>

                @foreach($subcategories as $subcategory)

                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>

                @endforeach

            </select>

            <x-jet-input-error for="subcategory_id" />

        </div>

    </div>

    {{-- Nombre --}}
    <div class="mb-4">

        <x-jet-label value="Nombre" />

        <x-jet-input class="w-full" type="text" placeholder="Ingrese el nombre del producto" wire:model="name" />

        <x-jet-input-error for="name" />

    </div>

    {{-- Slug --}}
    <div class="mb-4">

        <x-jet-label value="Slug" />

        <x-jet-input class="w-full bg-gray-200" type="text" placeholder="Ingrese el slug del producto" wire:model="slug" disabled />

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
                x-data
                x-init="
                    ClassicEditor
                    .create( $refs.miEditor )
                    .then(function(editor){
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
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

        <x-jet-input-error for="description" />

    </div>

    {{-- Marca/Precio --}}
    <div class="grid grid-cols-2 gap-4 mb-4">

        <div>

            <x-jet-label value="Marca" />

            <select class="w-full form-control" wire:model="brand_id">

                <option value="" disabled selected>Seleccione una marca</option>

                @foreach($brands as $brand)

                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>

                @endforeach

            </select>

            <x-jet-input-error for="brand_id" />

        </div>

        <div>

            <x-jet-label value="Precio" />

            <x-jet-input class="w-full" type="number" placeholder="Ingrese el precio del producto" wire:model="price" step="0.01" />

            <x-jet-input-error for="price" />

        </div>

    </div>

    @if($this->subcategory)

        @if(!$this->subcategory->color && !$this->subcategory->size)

            <div class="mb-4">

                <x-jet-label value="Cantidad" />

                <x-jet-input class="w-full" type="number" placeholder="Ingrese el precio del producto" wire:model="quantity" step="0.01" />

                <x-jet-input-error for="quantity" />

            </div>

        @endif

    @endif

    <div class="flex">

        <x-jet-button class="ml-auto" wire:click="save" wire:loading.attr="disabled" wire:target="save">Crear Producto</x-jet-button>

    </div>

</div>
