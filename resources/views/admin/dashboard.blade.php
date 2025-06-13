<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <!-- Sidebar personalizado -->
        <aside
            class="z-20 hidden md:block flex-shrink-0 w-64 h-screen sticky top-0 left-0 overflow-y-auto bg-[#284494] border-r border-[#e0e7ff]">
            <div class="py-6 text-[#e0e7ff]">
                <a class="ml-6 text-2xl font-extrabold font-secondary tracking-widest text-white" href="#">
                    QuickPay⚡
                </a>
                <ul class="mt-10">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-[#2563eb] rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-base font-bold text-white transition-colors duration-150 hover:text-[#2563eb]"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <span class="ml-4">Forms</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="ml-4">Cards</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                            href="{{-- {{ route('admin.banks.index') }} --}}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 10v6a2 2 0 002 2h14a2 2 0 002-2v-6"></path>
                                <path d="M16 10V6a4 4 0 00-8 0v4"></path>
                            </svg>
                            <span class="ml-4">Bancos</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                            href="#">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span class="ml-4">Charts</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full">


            <!-- Header -->
            <header class="z-10 py-4 bg-white shadow-md border-b border-[#e0e7ff]">
                <div class="container flex items-center justify-between h-full px-6 mx-auto text-[#284494]">
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div class="relative w-full max-w-xl mr-6 focus-within:text-[#2563eb]">
                            <div class="absolute inset-y-0 flex items-center pl-2">
                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input
                                class="w-full pl-8 pr-2 text-sm text-[#284494] placeholder-[#b3b8d0] bg-[#ede8f6] border-0 rounded-md focus:bg-white focus:border-[#2563eb] focus:outline-none focus:shadow-outline-purple form-input"
                                type="text" placeholder="Buscar en el dashboard" aria-label="Buscar" />
                        </div>
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                                aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full border-2 border-[#2563eb]"
                                    src="{{ asset('avatar-2.jpg') }}" alt="" aria-hidden="true" />
                            </button>
                        </li>
                    </ul>
                </div>
            </header>


            <main class="h-full overflow-y-auto">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <h2
                        class="mb-6 text-2xl font-extrabold text-[#284494] tracking-tight text-center drop-shadow-[0_6px_6px_rgba(37,99,235,0.10)]">
                        Panel de Administración
                    </h2>
                    <!-- Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div
                            class="flex items-center p-4 bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full shadow">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-bold text-[#284494]">Usuarios Totales</p>
                                <p class="text-lg font-extrabold text-[#222]">6389</p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div
                            class="flex items-center p-4 bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full shadow">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-bold text-[#284494]">Balance Plataforma</p>
                                <p class="text-lg font-extrabold text-[#222]">$ 46,760.89</p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div
                            class="flex items-center p-4 bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full shadow">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-bold text-[#284494]">Nuevas Transacciones</p>
                                <p class="text-lg font-extrabold text-[#222]">376</p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div
                            class="flex items-center p-4 bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full shadow">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-bold text-[#284494]">Reembolsos pendientes</p>
                                <p class="text-lg font-extrabold text-[#222]">35</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla -->
                    <div
                        class="w-full overflow-hidden rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff] bg-white mb-8">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap font-secondary">
                                <thead>
                                    <tr
                                        class="text-xs font-bold tracking-wide text-left text-[#284494] uppercase border-b bg-[#ede8f6]">
                                        <th class="px-4 py-3">Cliente</th>
                                        <th class="px-4 py-3">Monto</th>
                                        <th class="px-4 py-3">Estado</th>
                                        <th class="px-4 py-3">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y">
                                    <tr class="text-[#222]">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="{{ asset('avatar-2.jpg') }}" alt=""
                                                        loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-bold">Hans Burger</p>
                                                    <p class="text-xs text-[#284494]">10x Developer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">$ 863.45</td>
                                        <td class="px-4 py-3 text-xs">
                                            <span
                                                class="px-2 py-1 font-bold leading-tight text-green-700 bg-green-100 rounded-full">
                                                Aprobado
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">6/10/2020</td>
                                    </tr>
                                    <tr class="text-[#222]">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="{{ asset('avatar-2.jpg') }}" alt=""
                                                        loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-bold">Jolina Angelie</p>
                                                    <p class="text-xs text-[#284494]">Unemployed</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">$ 369.95</td>
                                        <td class="px-4 py-3 text-xs">
                                            <span
                                                class="px-2 py-1 font-bold leading-tight text-orange-700 bg-orange-100 rounded-full">
                                                Pendiente
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">6/10/2020</td>
                                    </tr>
                                    <tr class="text-[#222]">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="{{ asset('avatar-2.jpg') }}" alt=""
                                                        loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-bold">Sarah Curry</p>
                                                    <p class="text-xs text-[#284494]">Designer</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">$ 86.00</td>
                                        <td class="px-4 py-3 text-xs">
                                            <span
                                                class="px-2 py-1 font-bold leading-tight text-red-700 bg-red-100 rounded-full">
                                                Denegado
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">6/10/2020</td>
                                    </tr>
                                    <tr class="text-[#222]">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="{{ asset('avatar-2.jpg') }}" alt=""
                                                        loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-bold">Wenzel Dashington</p>
                                                    <p class="text-xs text-[#284494]">Actor</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">$ 863.45</td>
                                        <td class="px-4 py-3 text-xs">
                                            <span
                                                class="px-2 py-1 font-bold leading-tight text-[#222] bg-[#e0e7ff] rounded-full">
                                                Expirado
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">6/10/2020</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="grid px-4 py-3 text-xs font-bold tracking-wide text-[#284494] uppercase border-t bg-[#ede8f6] sm:grid-cols-9">
                            <span class="flex items-center col-span-3">
                                Mostrando 21-30 de 100
                            </span>
                            <span class="col-span-2"></span>
                            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                                <nav aria-label="Table navigation">
                                    <ul class="inline-flex items-center">
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple bg-[#ede8f6] text-[#284494]">‹</button>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple bg-white text-[#284494]">1</button>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple bg-white text-[#284494]">2</button>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 text-white transition-colors duration-150 bg-[#2563eb] border border-r-0 border-[#2563eb] rounded-md focus:outline-none focus:shadow-outline-purple">3</button>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple bg-white text-[#284494]">4</button>
                                        </li>
                                        <li>
                                            <span class="px-3 py-1">...</span>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple bg-white text-[#284494]">8</button>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple bg-white text-[#284494]">9</button>
                                        </li>
                                        <li>
                                            <button
                                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple bg-[#ede8f6] text-[#284494]">›</button>
                                        </li>
                                    </ul>
                                </nav>
                            </span>
                        </div>
                    </div>

                    <!-- Charts -->
                    <h2 class="my-6 text-2xl font-extrabold text-[#284494] tracking-tight">Gráficos</h2>
                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div
                            class="min-w-0 p-4 bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                            <h4 class="mb-4 font-bold text-[#284494]">Ingresos</h4>
                            <canvas id="pie"></canvas>
                            <div class="flex justify-center mt-4 space-x-3 text-sm text-[#284494]">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                                    <span>Envio</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                                    <span>Solicitud</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                    <span>Retiros</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="min-w-0 p-4 bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                            <h4 class="mb-4 font-bold text-[#284494]">Tráfico</h4>
                            <canvas id="line"></canvas>
                            <div class="flex justify-center mt-4 space-x-3 text-sm text-[#284494]">
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                                    <span>x</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                    <span>x</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
