<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6" >

    <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-4">

                <x-jet-label value="Nombre de contácto" />

                <x-jet-input wire:model.defer="contact" class="w-full" type="text" placeholder="Ingrese el nombre de la persona que recibirá el producto" />

                <x-jet-input-error for="contact" />

            </div>

            <div class="mb-4">

                <x-jet-label value="Teléfono" />

                <x-jet-input wire:model.defer="phone" class="w-full" type="text" placeholder="Ingrese un número de contacto" />

                <x-jet-input-error for="phone" />

            </div>

        </div>

        <div x-data="{ envio_type : @entangle('envio_type') }">

            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

            <label class="bg-white rounded-lg shadow py-4 px-6 flex items-center mb-4">

                <input x-model="envio_type" type="radio" name="envio_type" value="1" class=" text-gray-600">

                <span class="ml-2 text-gray-700">Recojo en tienda (Calle falsa 123)</span>

                <span class="font-semibold text-gray-700 ml-auto">Gratis</span>

            </label>

            <div class="bg-white rounded-lg shadow">

                <label class="py-4 px-6 flex items-center">

                    <input x-model="envio_type" type="radio" name="envio_type" value="2" class=" text-gray-600">

                    <span class="ml-2 text-gray-700">Envio a domicilio</span>

                </label>

                <div
                    :class="{'hidden' : envio_type != 2 }"
                    class="px-6 pb-6 grid grid-cols-2 gap-6 hidden">

                    <div>

                        <x-jet-label value="Departamento" />

                        <select wire:model="department_id" class="form-control w-full">

                            <option value="" disabled selected>Seleccione un departamento</option>

                            @foreach ($departments as $department)

                                <option value="{{ $department->id}}">{{ $department->name}}</option>

                            @endforeach

                        </select>

                        <x-jet-input-error for="department_id" />

                    </div>

                    <div>

                        <x-jet-label value="Ciudad" />

                        <select wire:model="city_id" class="form-control w-full">

                            <option value="" disabled selected>Seleccione una ciudad</option>

                            @foreach ($cities as $city)

                                <option value="{{ $city->id}}">{{ $city->name}}</option>

                            @endforeach

                        </select>

                        <x-jet-input-error for="city_id" />

                    </div>

                    <div>

                        <x-jet-label value="Distrito" />

                        <select wire:model="district_id" class="form-control w-full">

                            <option value="" disabled selected>Seleccione un distrito</option>

                            @foreach ($districts as $district)

                                <option value="{{ $district->id}}">{{ $district->name}}</option>

                            @endforeach

                        </select>

                        <x-jet-input-error for="district_id" />

                    </div>

                    <div>

                        <x-jet-label value="Dirección" />

                        <x-jet-input class="w-full" wire:model="address" type="text" />

                        <x-jet-input-error for="address" />

                    </div>

                    <div class="col-span-2">

                        <x-jet-label value="Referencia" />

                        <x-jet-input class="w-full" wire:model="reference" type="text" />

                        <x-jet-input-error for="reference" />

                    </div>

                </div>

            </div>

        </div>

        <div>

            <x-jet-button
                wire:click="createOrder"
                wire:loading.attr="disbled"
                wire:target="createOrder"
                class="mt-6 mb-4">
                Continuar con la compra
            </x-jet-button>

        </div>

        <hr>

        <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa beatae est nisi, modi debitis maiores quae consequatur incidunt sed atque porro ullam accusantium sunt, nulla, placeat ipsam eius itaque cupiditatea. <a href="" class="font-semibold text-orange-500">Politicas y privacidad</a></p>


    </div>

    <div class=" order-1 lg:order-2 lg:col-span-1 xl:col-span-2">

        <div class="bg-white rounded-lg shadow p-6">

            <ul class="mb-4">

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

            <div class="text-gray-700">

                <p class="flex justify-between items-center">Subtotal:
                    <span class="font-semibold">{{ Cart::subtotal()}}</span>
                </p>

                <p class="flex justify-between items-center">Envio:
                    <span class="font-semibold">
                        @if($envio_type == 1 || $shipping_cost == 0)

                            Gratis

                        @else

                            {{ $shipping_cost }}

                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex font-semibold justify-between items-center"><span class="text-lg">Total:</span>
                    @if($envio_type == 1)

                        {{Cart::subtotal()}}

                    @else

                        {{Cart::subtotal() + $shipping_cost}}

                    @endif
                </p>
            </div>

        </div>

    </div>

</div>
