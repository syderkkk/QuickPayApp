@php
    $navLinks = [
        ['name' => 'Inicio', 'route' => 'dashboard'],
        ['name' => 'Enviar y Solicitar', 'route' => 'transactions.send.step1'],
        ['name' => 'Cartera', 'route' => 'payment-methods.index'],
        ['name' => 'Movimientos', 'route' => 'transactions.index'],
    ];
@endphp

<nav x-data="{ open: false }" class="bg-primary w-full font-secondary shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <span class="flex items-center font-extrabold text-white text-2xl select-none">
                Q<span class="ml-1 text-yellow-400 text-3xl -mt-1">⚡</span>
            </span>
        </div>
        <!-- Desktop Menu -->
        <div class="hidden md:flex flex-1 justify-center">
            <ul class="flex gap-8 items-center">
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}"
                            class="px-5 py-2 rounded-full transition font-bold uppercase tracking-wide text-base
                            {{ request()->routeIs($link['route'])
                                ? 'bg-white text-primary shadow-lg'
                                : 'text-white hover:bg-white hover:text-primary hover:shadow-lg' }}">
                            {{ $link['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Iconos y cerrar sesión (desktop) -->
        <div class="hidden md:flex items-center gap-8">
            <!-- Notificaciones -->
            <button type="button" class="text-white hover:text-yellow-400 transition" title="Notificaciones">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <!-- Perfil (tuerca) -->
            <a href="{{ route('profile.edit') }}" class="text-white hover:text-yellow-400 transition" title="Perfil">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <mask id="lineMdCogFilled0">
                        <defs>
                            <symbol id="lineMdCogFilled1">
                                <path
                                    d="M11 13L15.74 5.5C16.03 5.67 16.31 5.85 16.57 6.05C16.57 6.05 16.57 6.05 16.57 6.05C16.64 6.1 16.71 6.16 16.77 6.22C18.14 7.34 19.09 8.94 19.4 10.75C19.41 10.84 19.42 10.92 19.43 11C19.43 11 19.43 11 19.43 11C19.48 11.33 19.5 11.66 19.5 12z">
                                    <animate fill="freeze" attributeName="d" begin="0.5s" dur="0.2s"
                                        values="M11 13L15.74 5.5C16.03 5.67 16.31 5.85 16.57 6.05C16.57 6.05 16.57 6.05 16.57 6.05C16.64 6.1 16.71 6.16 16.77 6.22C18.14 7.34 19.09 8.94 19.4 10.75C19.41 10.84 19.42 10.92 19.43 11C19.43 11 19.43 11 19.43 11C19.48 11.33 19.5 11.66 19.5 12z;M11 13L15.74 5.5C16.03 5.67 16.31 5.85 16.57 6.05C16.57 6.05 19.09 5.04 19.09 5.04C19.25 4.98 19.52 5.01 19.6 5.17C19.6 5.17 21.67 8.75 21.67 8.75C21.77 8.92 21.73 9.2 21.6 9.32C21.6 9.32 19.43 11 19.43 11C19.48 11.33 19.5 11.66 19.5 12z" />
                                </path>
                            </symbol>
                        </defs>
                        <g fill="none" stroke="#fff" stroke-width="2">
                            <path stroke-dasharray="36" stroke-dashoffset="36" stroke-width="5"
                                d="M12 7c2.76 0 5 2.24 5 5c0 2.76 -2.24 5 -5 5c-2.76 0 -5 -2.24 -5 -5c0 -2.76 2.24 -5 5 -5Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s"
                                    values="36;0" />
                                <set fill="freeze" attributeName="opacity" begin="0.5s" to="0" />
                            </path>
                            <g fill="#fff" stroke="none" opacity="0">
                                <use href="#lineMdCogFilled1" />
                                <use href="#lineMdCogFilled1" transform="rotate(60 12 12)" />
                                <use href="#lineMdCogFilled1" transform="rotate(120 12 12)" />
                                <use href="#lineMdCogFilled1" transform="rotate(180 12 12)" />
                                <use href="#lineMdCogFilled1" transform="rotate(240 12 12)" />
                                <use href="#lineMdCogFilled1" transform="rotate(300 12 12)" />
                                <set fill="freeze" attributeName="opacity" begin="0.5s" to="1" />
                            </g>
                        </g>
                        <circle cx="12" cy="12" r="3.5" />
                    </mask>
                    <rect width="24" height="24" fill="currentColor" mask="url(#lineMdCogFilled0)" />
                </svg>
            </a>
            <!-- Cerrar sesión -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-white hover:text-yellow-400 font-bold uppercase text-base transition"
                    title="Cerrar sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m4-8V5a2 2 0 10-4 0v1" />
                    </svg>
                    CERRAR SESIÓN
                </button>
            </form>
        </div>
        <!-- Botón hamburguesa (mobile) -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open" class="text-white focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    <!-- Menú móvil -->
    <div x-show="open" x-transition class="md:hidden bg-primary px-4 pb-4">
        <ul class="flex flex-col gap-2 mt-2">
            @foreach ($navLinks as $link)
                <li>
                    <a href="{{ route($link['route']) }}"
                        class="block w-full text-center px-5 py-2 rounded-full transition font-bold uppercase tracking-wide text-base
                        {{ request()->routeIs($link['route'])
                            ? 'bg-white text-primary shadow-lg'
                            : 'text-white hover:bg-white hover:text-primary hover:shadow-lg' }}">
                        {{ $link['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-center gap-6 mt-4">
            <button type="button" class="text-white hover:text-yellow-400 transition" title="Notificaciones">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
            <a href="{{ route('profile.edit') }}" class="text-white hover:text-yellow-400 transition" title="Perfil">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.43 12.98l1.77-1.03a2 2 0 000-3.46l-1.77-1.03.34-1.93a2 2 0 00-2.45-2.45l-1.93.34-1.03-1.77a2 2 0 00-3.46 0l-1.03 1.77-1.93-.34a2 2 0 00-2.45 2.45l.34 1.93-1.77 1.03a2 2 0 000 3.46l1.77 1.03-.34 1.93a2 2 0 002.45 2.45l1.93-.34 1.03 1.77a2 2 0 003.46 0l1.03-1.77 1.93.34a2 2 0 002.45-2.45l-.34-1.93z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-white hover:text-yellow-400 font-bold uppercase text-base transition"
                    title="Cerrar sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m4-8V5a2 2 0 10-4 0v1" />
                    </svg>
                    CERRAR SESIÓN
                </button>
            </form>
        </div>
    </div>
</nav>