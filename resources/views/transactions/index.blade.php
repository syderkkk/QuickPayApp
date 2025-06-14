<x-app-layout>
    @include('layouts.navigation')
    <div class="max-w-2xl mx-auto py-8 px-2 sm:px-4">
        <!-- Buscador -->
        <form method="GET" class="mb-2">
            <input type="text" name="search" placeholder="Buscar por nombre o correo electrónico"
                value="{{ request('search') }}"
                class="w-full rounded-full border border-gray-300 px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-mono text-gray-500 bg-[#f5f7fa] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#2563eb] shadow"
                style="font-family: 'JetBrains Mono', monospace;">
            <!-- Conserva los filtros al buscar -->
            <input type="hidden" name="type" value="{{ request('type') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="currency" value="{{ request('currency') }}">
        </form>

        <!-- Filtros -->
        <div class="mb-8">
            <div class="text-xs sm:text-sm font-mono text-[#222] mb-2">Filtrar por</div>
            <div class="flex flex-wrap gap-2 items-center text-xs sm:text-sm font-mono text-[#222]">
                <span class="bg-[#2563eb] text-white px-3 sm:px-4 py-1 rounded-full font-bold font-mono">Fecha: Últimos
                    90 días</span>

                <!-- Filtro Tipo -->
                <form method="GET" class="inline">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="currency" value="{{ request('currency') }}">
                    <div x-data="{ open: false }" class="relative inline-block">
                        <button type="button" @click="open = !open"
                            class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                            {{ request('type') ? (request('type') == 'send' ? 'Enviados' : (request('type') == 'receive' ? 'Recibidos' : 'Tipo')) : 'Tipo' }}
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                            <button type="submit" name="type" value=""
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todos</button>
                            <button type="submit" name="type" value="send"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Enviados</button>
                            <button type="submit" name="type" value="receive"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Recibidos</button>
                        </div>
                    </div>
                </form>
                <!-- Filtro Estado -->
                <!-- Filtro Estado -->
                <form method="GET" class="inline">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    <input type="hidden" name="currency" value="{{ request('currency') }}">
                    <div x-data="{ open: false }" class="relative inline-block">
                        <button type="button" @click="open = !open"
                            class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                            {{ request('status') ? (request('status') == 'completed' ? 'Completado' : (request('status') == 'pending' ? 'Pendiente' : 'Estado')) : 'Estado' }}
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                            <button type="submit" name="status" value=""
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todos</button>
                            <button type="submit" name="status" value="completed"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Completado</button>
                            <button type="submit" name="status" value="pending"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Pendiente</button>
                        </div>
                    </div>
                </form>
                <!-- Filtro Divisa -->
                <form method="GET" class="inline">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <div x-data="{ open: false }" class="relative inline-block">
                        <button type="button" @click="open = !open"
                            class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                            {{ request('currency') ? request('currency') : 'Divisa' }}
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                            <button type="submit" name="currency" value=""
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todas</button>
                            <button type="submit" name="currency" value="PEN"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">PEN</button>
                            <button type="submit" name="currency" value="USD"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">USD</button>
                            <button type="submit" name="currency" value="MXN"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">MXN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Título de sección -->
        <h2 class="text-2xl sm:text-3xl font-bold mb-2 font-mono text-black">Completado</h2>
        <div class="text-gray-500 mb-6 font-mono text-sm sm:text-base">Esta semana</div>
        <!-- Lista de transacciones -->
        @forelse($transactions as $transaction)
            <div
                class="flex flex-col sm:flex-row items-center bg-[#ede8f6] border border-gray-300 rounded-xl px-4 sm:px-6 py-3 sm:py-4 mb-4 shadow-sm">
                <div class="flex-shrink-0">
                    <div
                        class="bg-[#2563eb] rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white text-xl sm:text-2xl font-bold shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-0 sm:ml-4 mt-2 sm:mt-0 flex-1 w-full">
                    <div class="font-bold text-base sm:text-lg uppercase tracking-wide font-mono text-[#222]">
                        {{ $transaction->receiver ? $transaction->receiver->name . ' ' . $transaction->receiver->lastname : 'Usuario desconocido' }}
                    </div>
                    <div class="text-gray-500 text-xs sm:text-sm font-mono">
                        {{ $transaction->created_at->format('d M.') }} Pago
                        {{ $transaction->type == 'send' ? 'enviado' : $transaction->type }}
                    </div>
                </div>
                @php
                    $userId= Auth::id();
                    $isSender = $transaction->sender_id === $userId;
                    $isReceiver = $transaction->receiver_id === $userId;

                    $showAmount = true;
                    $sign = '';
                    $textColor = 'text-gray-700';

                    if ($transaction->type === 'send') {
                        $sign = $isSender ? '-' : '+';
                        $textColor = $isSender ? 'text-red-500' : 'text-green-600';
                    } elseif ($transaction->type === 'request') {
                        if ($transaction->status === 'pending') {
                            $showAmount = false;
                        } else {
                            if ($isReceiver) {
                                $sign = '+';
                                $textColor = 'text-green-600';
                            } elseif ($isSender) {
                                $sign = '';
                                $textColor = 'text-gray-500';
                            }
                        }
                    } elseif (in_array($transaction->type, ['withdraw', 'card_payment'])) {
                        $sign = '-';
                        $textColor = 'text-red-500';
                    } else {
                        $sign = '+';
                        $textColor = 'text-green-600';
                    }
                @endphp
                <div class="text-right w-full sm:w-auto mt-2 sm:mt-0 font-mono text-base sm:text-lg font-bold {{ $textColor }}">
                    @if ($showAmount)
                        {{ $sign }}{{ $transaction->currency }}.{{ number_format($transaction->amount, 2) }}
                    @else
                        <span class="text-gray-500 text-sm">(Solicitud pendiente)</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 py-8 font-mono">No hay transacciones.</div>
        @endforelse
        <div class="mt-6 flex justify-center">
            {{-- Paginación personalizada --}}
            @if ($transactions->hasPages())
                <nav class="inline-flex rounded-full shadow-sm" aria-label="Pagination">
                    {{-- Botón anterior --}}
                    @if ($transactions->onFirstPage())
                        <span
                            class="px-4 py-2 bg-gray-200 text-gray-400 rounded-l-full font-mono cursor-not-allowed">Anterior</span>
                    @else
                        <a href="{{ $transactions->previousPageUrl() }}"
                            class="px-4 py-2 bg-[#2563eb] text-white rounded-l-full font-mono hover:bg-[#1e40af] transition">Anterior</a>
                    @endif

                    {{-- Números de página --}}
                    @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                        @if ($page == $transactions->currentPage())
                            <span
                                class="px-4 py-2 bg-[#ede8f6] text-[#2563eb] font-bold font-mono">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-4 py-2 bg-white text-[#2563eb] font-mono hover:bg-[#f5f7fa] transition">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Botón siguiente --}}
                    @if ($transactions->hasMorePages())
                        <a href="{{ $transactions->nextPageUrl() }}"
                            class="px-4 py-2 bg-[#2563eb] text-white rounded-r-full font-mono hover:bg-[#1e40af] transition">Siguiente</a>
                    @else
                        <span
                            class="px-4 py-2 bg-gray-200 text-gray-400 rounded-r-full font-mono cursor-not-allowed">Siguiente</span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</x-app-layout>
