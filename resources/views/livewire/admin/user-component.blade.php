<div>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Usuarios
        </h2>

    </x-slot>

    <div class="container py-12">

        <x-table-responsive>

            <div class="px-6 py-4">

                <x-jet-input type="text" placeholder="Ingrese el nombre del producto" class="w-full" wire:model="search" />

            </div>

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Id
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @forelse($users as $user)

                        <tr wire:key="{{$user->email}}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="px-6 py-4  font-medium text-gray-900">
                                    {{ $user->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="px-6 py-4  font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="px-6 py-4  font-medium text-gray-900">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap  text-gray-500">
                                <div class="px-6 py-4  font-medium text-gray-900">
                                    @if($user->roles->count())
                                        Administrador
                                    @else
                                        Sin Role
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <label>
                                    <input {{ count($user->roles) ? 'checked' : ''}} type="radio" value="1" name="{{ $user->email }}" wire:click="assingRole({{ $user->id }}, $event.target.value)">
                                    Si
                                </label>
                                <label class="ml-2">
                                    <input {{ count($user->roles) ? '' : 'checked'}} type="radio" value="2" name="{{ $user->email }}" wire:click="assingRole({{ $user->id }}, $event.target.value)">
                                    No
                                </label>
                            </td>
                        </tr>
                    @empty

                        <div class="px-6 py-4">

                            No hay registros coincidentes.

                        </div>

                    @endforelse


                </tbody>

            </table>

            @if($users->hasPages())

                <div class="px-6 py-4">

                    {{ $users->links() }}

                </div>

            @endif

        </x-table-responsive>

    </div>

</div>
