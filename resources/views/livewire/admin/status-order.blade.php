<div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6">

            <div class="flex items-center">

                <div class="relative">

                    <div class="{{ ($order->status >= 2 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">

                        <i class="fas fa-check text-white"></i>

                    </div>

                    <div class="absolute -left-1.5 mt-0.5">

                        <p>Recibido</p>

                    </div>

                </div>

                <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

                <div class="relative">

                    <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">

                        <i class="fas fa-truck text-white"></i>

                    </div>

                    <div class="absolute -left-1 mt-0.5">

                        <p>Enviado</p>

                    </div>

                </div>

                <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

                <div class="relative">

                    <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">

                        <i class="fas fa-check text-white"></i>

                    </div>

                    <div class="absolute -left-2 mt-0.5">

                        <p>Entregado</p>

                    </div>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">

            <p class="text-gray-700 uppercase">
                <span class="font-semibold">Número de orden:</span>
                {{ $order->id }}
            </p>

            <form wire:submit.prevent="update">

                <div class="flex items-center space-x-3 mt-2">

                    <x-jet-label>

                        <input type="radio" name="status" value="2" class="mr-2" wire:model="status">

                        RECIBIDO

                    </x-jet-label>

                    <x-jet-label>

                        <input type="radio" name="status" value="3" class="mr-2" wire:model="status">

                        ENVIADO

                    </x-jet-label>

                    <x-jet-label>

                        <input type="radio" name="status" value="4" class="mr-2" wire:model="status">

                        ENTREGADO

                    </x-jet-label>

                    <x-jet-label>

                        <input type="radio" name="status" value="5" class="mr-2" wire:model="status">

                        ANULADO

                    </x-jet-label>

                </div>

                <div class="flex items-center mt-2">

                    <x-jet-button class="ml-auto">Actualizar</x-jet-button>

                </div>

            </form>

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">

            <div class="grid grid-cols-2 gap-6 text-gray-700">

                <div class="">

                    <p class="uppercase text-lg font-semibold">Envío</p>

                    @if($order->envio_type == 1)

                        <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                        <p class="text-sm">Calle falsa 123</p>

                    @else

                        <p class="text-sm">Los productos seran enviados a:</p>
                        <p class="text-sm">{{ $envio->address }}</p>
                        <p class="text-sm">{{ $envio->department }} - {{ $envio->city }} - {{ $envio->district }}</p>

                    @endif

                </div>

                <div>

                        <p class="uppercase text-lg font-semibold">Datos de contacto</p>
                        <p class="text-sm">Persona que recibirá el producto:</p>
                        <p class="text-sm">{{ $order->contact }} - {{ $order->phone }}</p>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">

            <p class="text-gray-700 text-xl font-semibold mb-4">Resumen</p>

            <table class="table-auto w-full">

                <thead>

                    <tr>

                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @foreach ($items as $item)

                        <tr>

                            <td class="flex">

                                <img class="object-cover h-15 w-20 mr-4" src="{{ $item->options->image }}" alt="">

                                <article>

                                    <h1 class="font-bold">{{ $item->name }}</h1>

                                    <div class="flex text-xs">

                                        @isset($item->options->color)

                                            Color: {{__($item->options->color)}}

                                        @endisset

                                        @isset($item->options->size)

                                            - {{__($item->options->size)}}

                                        @endisset


                                    </div>

                                </article>

                            </td>
                            <td class="text-center">{{ $item->price }} USD</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-center">{{ $item->price * $item->qty }}USD</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
