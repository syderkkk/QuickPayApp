<aside
    class="z-20 hidden md:block flex-shrink-0 w-64 h-screen sticky top-0 left-0 overflow-y-auto bg-[#284494] border-r border-[#e0e7ff]">
    <div class="py-6 text-[#e0e7ff]">
        <a class="ml-6 text-2xl font-extrabold font-secondary tracking-widest text-white"
            href="{{ route('admin.dashboard') }}">
            QuickPay⚡
        </a>
        <ul class="mt-10" x-data="{ open: false }">
            <li class="relative px-6 py-3">
                <span class="absolute inset-y-0 left-0 w-1 bg-[#2563eb] rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-base font-bold text-white transition-colors duration-150 hover:text-[#2563eb]"
                    href="{{ route('admin.dashboard') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Inicio</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                    href="{{ route('admin.users.index') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="ml-4">Usuarios</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                    href="{{ route('admin.transactions.index') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2z" />
                    </svg>
                    <span class="ml-4">Transacciones</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                    href="{{ route('admin.refunds.index') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 8v4l3 3" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    <span class="ml-4">Reembolsos</span>
                </a>
            </li>
            <!-- Nueva sección desplegable -->
            <li class="relative px-6 py-3" x-data="{ open: false }">
                <button type="button"
                    class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb] focus:outline-none"
                    @click="open = !open">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M21 10H7a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2z" />
                        <path d="M3 6h18" />
                    </svg>
                    <span class="ml-4 flex-1 text-left">Métodos de pago y retiro</span>
                    <svg :class="{ 'rotate-90': open }" class="w-4 h-4 ml-auto transition-transform duration-200"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition class="mt-2 ml-8 space-y-1">
                    <li>
                        <a href="{{ route('admin.cards.index') }}"
                            class="flex items-center text-sm font-semibold text-[#e0e7ff] hover:text-[#2563eb] transition-colors duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Tarjetas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banks.index') }}"
                            class="flex items-center text-sm font-semibold text-[#e0e7ff] hover:text-[#2563eb] transition-colors duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10v6a2 2 0 002 2h14a2 2 0 002-2v-6" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 10V6a4 4 0 00-8 0v4" />
                            </svg>
                            Cuentas bancarias
                        </a>
                    </li>
                </ul>
            <li class="relative px-6 py-3">
                <a class="inline-flex items-center w-full text-base font-bold text-[#e0e7ff] transition-colors duration-150 hover:text-[#2563eb]"
                    href="{{ route('admin.wallets.index') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 7V6a2 2 0 012-2h12a2 2 0 012 2v1" />
                        <rect width="20" height="12" x="2" y="7" rx="2" />
                        <path d="M16 11a2 2 0 110 4 2 2 0 010-4z" />
                    </svg>
                    <span class="ml-4">Wallets</span>
                </a>
            </li>
            </li>
            <!-- Fin sección desplegable -->
        </ul>
        <form method="POST" action="{{ route('logout') }}" class="absolute bottom-0 left-0 w-full px-6 pb-6">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2 justify-center bg-[#d32f2f] hover:bg-[#b91c1c] text-white font-bold py-2 rounded-full font-mono text-base transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m4-8V5a2 2 0 10-4 0v1" />
                </svg>
                Cerrar sesión
            </button>
        </form>
    </div>
</aside>
