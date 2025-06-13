<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <!-- Sidebar personalizado -->
        <x-admin-sidebar />

        <div class="flex flex-col flex-1 w-full">

            <!-- Header -->
            <x-admin-header />

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
                                <p class="mb-2 text-sm font-bold text-[#284494]">Usuarios registrados</p>
                                <p class="text-lg font-extrabold text-[#222]">{{ $totalUsers }}</p>
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
                                <p class="text-lg font-extrabold text-[#222]">$ {{ number_format($totalBalance, 2) }}</p>
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
                                <p class="mb-2 text-sm font-bold text-[#284494]">Transacciones totales</p>
                                <p class="text-lg font-extrabold text-[#222]">{{ $totalTransactions }}</p>
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
                    <x-admin-charts />
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
