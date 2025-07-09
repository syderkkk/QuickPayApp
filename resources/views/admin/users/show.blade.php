<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            
            <x-admin-back-button href="{{ route('admin.users.index') }}" title="Perfil de usuario" text="Volver" />

            <main class="flex flex-1 justify-center items-start">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 w-full max-w-6xl mx-auto px-4 sm:px-8">
                    <!-- Panel lateral: Acciones rápidas -->
                    <aside
                        class="bg-white rounded-3xl shadow-lg border border-[#e0e7ff] p-6 flex flex-col gap-6 lg:col-span-1">
                        <div class="flex flex-col items-center">
                            <div class="bg-blue-100 rounded-full p-4 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-blue-700" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col items-center gap-1">
                                <h3 class="text-xl font-bold text-gray-800 text-center">{{ $user->name }}
                                    {{ $user->lastname }}</h3>
                                <span class="text-gray-500 text-sm text-center mb-2">{{ $user->email }}</span>
                                <div class="flex flex-row items-center gap-2 mt-2">
                                    <span class="text-xs text-gray-500 font-semibold">Rol:</span>
                                    <span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-700 font-medium">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                    <span class="text-xs text-gray-500 font-semibold ml-4">Estado:</span>
                                    <span
                                        class="inline-block px-2 py-1 rounded {{ $user->is_blocked ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }} font-bold">
                                        {{ $user->is_blocked ? 'Bloqueado' : 'Activo' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#284494] mb-3 text-lg">Acciones rápidas</h4>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('admin.users.contacts', $user) }}"
                                    class="flex items-center gap-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white px-4 py-3 rounded-xl font-bold shadow transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    Ver contactos
                                </a>
                                <a href="{{ route('admin.users.payment-methods', $user) }}"
                                    class="flex items-center gap-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white px-4 py-3 rounded-xl font-bold shadow transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4V7c0-2.21 3.582-4 8-4s8 1.79 8 4v7c0 2.21-3.582 4-8 4z" />
                                    </svg>
                                    Métodos de pago
                                </a>
                                <a href="{{ route('admin.users.transactions', $user) }}"
                                    class="flex items-center gap-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white px-4 py-3 rounded-xl font-bold shadow transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2zm-5 4v2m0 0v2m0-2h2m-2 0H9" />
                                    </svg>
                                    Últimos movimientos
                                </a>
                            </div>
                        </div>
                    </aside>

                    <section class="lg:col-span-2 flex flex-col gap-8">
                        <!-- Datos del usuario -->
                        <div class="bg-white rounded-3xl shadow-lg border border-[#e0e7ff] p-8">
                            <h4 class="font-bold text-[#284494] mb-6 text-lg">Datos del usuario</h4>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-5">
                                {{-- <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">ID</dt>
                                    <dd class="text-base font-mono text-[#2563eb] bg-[#f5f7fa] rounded px-3 py-1">
                                        {{ $user->id }}</dd>
                                </div> --}}
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Correo
                                    </dt>
                                    <dd class="text-base font-mono text-gray-800 bg-[#f5f7fa] rounded px-3 py-1">
                                        {{ $user->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                                        Teléfono</dt>
                                    <dd class="text-base font-mono text-gray-800 bg-[#f5f7fa] rounded px-3 py-1">
                                        {{ $user->phone ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                                        Dirección</dt>
                                    <dd class="text-base font-mono text-gray-800 bg-[#f5f7fa] rounded px-3 py-1">
                                        {{ $user->address ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">País
                                    </dt>
                                    <dd class="text-base font-mono text-gray-800 bg-[#f5f7fa] rounded px-3 py-1">
                                        {{ $user->country ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Fecha
                                        de creación</dt>
                                    <dd class="text-base font-mono text-gray-800 bg-[#f5f7fa] rounded px-3 py-1">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : '-' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <!-- Saldo -->
                        <div
                            class="bg-white rounded-3xl shadow-lg border border-[#e0e7ff] p-2 flex flex-col items-center">
                            <h4 class="font-bold text-[#284494] mb-2 text-lg">Saldo total</h4>
                            <div class="text-3xl font-extrabold text-[#2563eb] mb-1">
                                {{ $user->wallet->currency ?? 'S/.' }}
                                {{ number_format($user->wallet->balance ?? 0, 2) }}
                            </div>
                            <div class="text-gray-500 text-sm">Saldo disponible en QuickPay</div>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
