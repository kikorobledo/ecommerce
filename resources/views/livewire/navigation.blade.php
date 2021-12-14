

<header class="bg-trueGray-700 sticky top-0" style="z-index: 900" x-data="dropdown()">

    <div class="container flex items-center h-16 space-x-4 justify-between md:justify-start">

        <a
            x-on:click="show()"
            :class="{ 'text-orange-500 bg-opacity-100' : open}"
            href="#"
            class="h-full flex flex-col items-center justify-center px-6 md:px-4 bg-white bg-opacity-25 text-white cursor-pointer font-semibold order-last md:order-first"
        >

            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <span class="text-sm hidden md:block">Categorías</span>

        </a>

        <a href="/" class="">

            <x-jet-application-mark class="block h-9 w-auto"/>

        </a>

        <div class="flex-1 hidden md:block">

            @livewire('search')

        </div>

        <div class="ml-3 relative hidden md:block">

            @auth

                <x-jet-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>

                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            Mis Ordenes
                        </x-jet-dropdown-link>

                        @role('admin')

                            <x-jet-dropdown-link href="{{ route('admin.index') }}">
                                Administrador
                            </x-jet-dropdown-link>

                        @endrole

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>

                </x-jet-dropdown>

            @else

                <x-jet-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>

                    </x-slot>

                    <x-slot name="content">

                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-jet-dropdown-link>

                    </x-slot>

                </x-jet-dropdown>

            @endauth

        </div>

        <div class="hidden md:block">

            @livewire('dropdown-cart')

        </div>

    </div>

    <nav
        x-show="open"
        :class="{ 'block' : open, 'hidden' : !open}"
        id="navigation-menu"
        class="bg-trueGray-700 bg-opacity-25 absolute w-full hidden"
    >

        {{-- Menu desktop --}}
        <div class="container h-full hidden md:block">

            <div
                x-on:click.away="close()"
                class="grid grid-cols-4 h-full relative"
            >

                <ul class="bg-white">

                    @foreach ($categories as $category )

                        <li class="text-trueGray-500 hover:bg-orange-500 cursor-pointer hover:text-white navigation-link">

                            <a href="{{ route('categories.show', $category) }}" class="py-2 px-4 text-sm flex space-x-4">

                                <span class="items-center flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>

                                <p>
                                    {{ $category->name }}
                                </p>

                            </a>

                            <div class="hidden bg-gray-100 absolute w-3/4 right-0 top-0 h-full navigation-sub-menu">

                                <x-navigation-subcategories :category="$category" />

                            </div>

                        </li>

                    @endforeach

                </ul>

                <div class="col-span-3 bg-gray-100">

                    <x-navigation-subcategories :category="$category->first()" />

                </div>

            </div>

        </div>

        {{-- Menu mobile --}}
        <div class="bg-white h-full overflow-y-auto">

            <div class="container py-3 bg-gray-100">

                @livewire('search')

            </div>

            <ul>

                @foreach ($categories as $category)

                    <li class="text-trueGray-500 hover:bg-orange-500 cursor-pointer hover:text-white">

                        <a href="{{ route('categories.show', $category) }}" class="py-2 px-4 text-sm flex space-x-4">

                            <span class="items-center flex justify-center w-9">
                                {!! $category->icon !!}
                            </span>

                            <p>
                                {{ $category->name }}
                            </p>

                        </a>

                    </li>

                @endforeach

            </ul>

            <p class="text-trueGray-500 px-6 py-2">USUARIOS</p>

            @livewire('cart-mobile')

            @auth

                <a href="{{ route('profile.show') }}" class="py-2 px-4 text-sm flex text-trueGray-500 hover:bg-orange-500 cursor-pointer hover:text-white">

                    <span class="items-center flex justify-center w-9">
                        <i class="far fa-address-card"></i>
                    </span>

                    <p>
                        Perfil
                    </p>

                </a>

                <a
                    onclick="
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    "
                    href=""
                    class="py-2 px-4 text-sm flex text-trueGray-500 hover:bg-orange-500 cursor-pointer hover:text-white"
                >

                    <span class="items-center flex justify-center w-9">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>

                    <p>
                        Cerrar Sesión
                    </p>

                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

            @else

                <a href="{{ route('login') }}" class="py-2 px-4 text-sm flex text-trueGray-500 hover:bg-orange-500 cursor-pointer hover:text-white">

                    <span class="items-center flex justify-center w-9">
                        <i class="fas fa-user-circle"></i>
                    </span>

                    <p>
                        Iniciar Sesión
                    </p>

                </a>

                <a href="{{ route('register') }}" class="py-2 px-4 text-sm flex text-trueGray-500 hover:bg-orange-500 cursor-pointer hover:text-white">

                    <span class="items-center flex justify-center w-9">
                        <i class="fas fa-fingerprint"></i>
                    </span>

                    <p>
                        Registrate
                    </p>

                </a>

            @endauth

        </div>

    </nav>

</header>
