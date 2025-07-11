<x-app-layout>
    @include('layouts.navigation')
    <div class="max-w-2xl mx-auto py-8 px-2 sm:px-4">
        <!-- Pestañas Transacciones/Solicitudes/Reembolsos -->
        <div class="mb-6">
            <div class="flex border-b border-gray-200">
                <button onclick="showTab('transacciones')" id="tab-transacciones"
                    class="tab-button active px-6 py-3 font-mono font-bold text-sm border-b-2 border-[#2563eb] text-[#2563eb]">
                    Transacciones
                </button>
                <button onclick="showTab('solicitudes')" id="tab-solicitudes"
                    class="tab-button px-6 py-3 font-mono font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700">
                    Solicitudes
                </button>
                <button onclick="showTab('reembolsos')" id="tab-reembolsos"
                    class="tab-button active px-6 py-3 font-mono font-bold text-sm border-b-2 border-[#2563eb] text-[#2563eb]">
                    Reembolsos
                </button>
            </div>
        </div>

        <!-- Contenido de Transacciones -->
        <div id="content-transacciones" class="tab-content">
            <!-- Buscador -->
            <form method="GET" class="mb-2">
                <input type="text" name="search" placeholder="Buscar por nombre o correo electrónico"
                    value="{{ request('search') }}"
                    class="w-full rounded-full border border-gray-300 px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-mono text-gray-500 bg-[#f5f7fa] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#2563eb] shadow"
                    style="font-family: 'JetBrains Mono', monospace;">
                <!-- Conserva los filtros al buscar -->
                <input type="hidden" name="type" value="{{ request('type') }}">
                <input type="hidden" name="status" value="{{ request('status') }}">
            </form>

            <!-- Filtros -->
            <div class="mb-8">
                <div class="text-xs sm:text-sm font-mono text-[#222] mb-2">Filtrar por</div>
                <div class="flex flex-wrap gap-2 items-center text-xs sm:text-sm font-mono text-[#222]">
                    <form method="GET" class="inline relative">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="type" value="{{ request('type') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <span
                            class="bg-[#2563eb] text-white px-3 sm:px-4 py-1 rounded-full font-bold font-mono inline-flex items-center cursor-pointer select-none"
                            onclick="document.getElementById('quick_range').focus();">
                            Fecha:
                            @if (request('quick_range', '90') == 'all')
                                Desde siempre
                            @elseif(request('quick_range', '90') == '7')
                                Últimos 7 días
                            @elseif(request('quick_range', '90') == '30')
                                Últimos 30 días
                            @elseif(request('quick_range', '90') == '10s')
                                Últimos 10 segundos
                            @else
                                Últimos 90 días
                            @endif
                            <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                        <select name="quick_range" id="quick_range" onchange="this.form.submit()"
                            class="absolute left-0 top-0 w-full h-full opacity-0 cursor-pointer" style="z-index:2;">
                            <option value="10s" {{ request('quick_range') == '10s' ? 'selected' : '' }}>Últimos 10
                                segundos</option>
                            <option value="7" {{ request('quick_range', '90') == '7' ? 'selected' : '' }}>Últimos 7
                                días</option>
                            <option value="30" {{ request('quick_range', '90') == '30' ? 'selected' : '' }}>Últimos
                                30 días</option>
                            <option value="90" {{ request('quick_range', '90') == '90' ? 'selected' : '' }}>Últimos
                                90 días</option>
                            <option value="all" {{ request('quick_range') == 'all' ? 'selected' : '' }}>Desde
                                siempre</option>
                        </select>
                    </form>

                    <!-- Filtros existentes... -->
                    <form method="GET" class="inline">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
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
                </div>
            </div>

            <!-- Título de sección -->
            <h2 class="text-2xl sm:text-3xl font-bold mb-2 font-mono text-black">Transacciones Completadas</h2>
            <div class="text-gray-500 mb-6 font-mono text-sm sm:text-base">
                @if (request('quick_range', '90') == 'all')
                    Desde siempre
                @elseif(request('quick_range', '90') == '7')
                    Últimos 7 días
                @elseif(request('quick_range', '90') == '30')
                    Últimos 30 días
                @elseif(request('quick_range', '90') == '90')
                    Últimos 90 días
                @elseif(request('quick_range', '10s') == '10s')
                    Últimos 10 segundos
                @else
                    Esta semana
                @endif
            </div>

            <!-- Lista de transacciones -->
            @forelse($transactions as $transaction)
                <div
                    class="transaction-card mb-4 bg-[#ede8f6] border border-gray-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <!-- Cabecera clickeable de la transacción -->
                    <div onclick="toggleTransactionDetails({{ $transaction->id }})"
                        class="cursor-pointer flex flex-col sm:flex-row items-center px-4 sm:px-6 py-3 sm:py-4 hover:bg-[#e0d9f1] transition-all duration-200">
                        <div class="flex-shrink-0">
                            <div
                                class="bg-[#2563eb] rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white text-xl sm:text-2xl font-bold shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-0 sm:ml-4 mt-2 sm:mt-0 flex-1 w-full">
                            <div class="font-bold text-base sm:text-lg uppercase tracking-wide font-mono text-[#222]">
                                @if ($transaction->sender_id === auth()->id())
                                    {{-- Yo envié, muestro a quién envié --}}
                                    {{ $transaction->receiver ? $transaction->receiver->name . ' ' . $transaction->receiver->lastname : 'Usuario #' . $transaction->receiver_id }}
                                @else
                                    {{-- Yo recibí, muestro quién me envió --}}
                                    {{ $transaction->sender ? $transaction->sender->name . ' ' . $transaction->sender->lastname : 'Usuario #' . $transaction->sender_id }}
                                @endif
                            </div>
                            <div class="text-gray-500 text-xs sm:text-sm font-mono">
                                {{ $transaction->created_at->format('d M.') }}
                                @if ($transaction->sender_id === auth()->id())
                                    Pago enviado
                                @else
                                    Pago recibido
                                @endif
                            </div>
                        </div>
                        <div
                            class="text-right font-bold text-base sm:text-lg font-mono {{ $transaction->sender_id === auth()->id() ? 'text-red-500' : 'text-green-600' }} w-full sm:w-auto mt-2 sm:mt-0">
                            @if ($transaction->sender_id === auth()->id())
                                -{{ $transaction->currency }}.{{ number_format($transaction->amount, 2) }}
                            @else
                                +{{ $transaction->receiver_currency ?? $transaction->currency }}.{{ number_format($transaction->converted_amount ?? $transaction->amount, 2) }}
                            @endif
                        </div>
                        <div class="ml-3">
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 ease-in-out"
                                id="arrow-{{ $transaction->id }}" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Detalles expandibles dentro de la misma card -->
                    <div id="details-{{ $transaction->id }}"
                        class="transaction-details max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-[#e0d9f1]border-t border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold font-mono text-[#2563eb]">Detalles de Transacción</h3>
                                <span
                                    class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-mono font-bold">Completado</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Información del pagador -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Pagado con</h4>
                                    <div class="flex items-center gap-3 mb-2">
                                        <div
                                            class="w-8 h-8 bg-[#2563eb] rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-mono font-bold text-base">
                                                @if ($transaction->card)
                                                    {{ $transaction->card->brand }} terminada en
                                                    {{ $transaction->card->last_four }}
                                                @else
                                                    Saldo QuickPay
                                                @endif
                                            </div>
                                            <div class="font-mono text-sm text-gray-600">
                                                @if ($transaction->card)
                                                    {{ strtoupper($transaction->card->brand) }}
                                                @else
                                                    Billetera
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-10">
                                    {{-- <div class="text-sm text-gray-600 font-mono mt-2">
                                        Verá "QuickPay {{ $transaction->sender->name ?? 'USUARIO' }}" En el estado de
                                        cuenta de su tarjeta.
                                    </div> --}}
                                    <div class="text-sm text-gray-600 font-mono mt-1">
                                        Fecha:
                                        {{ \App\Helpers\TimezoneHelper::formatForUser($transaction->created_at, 'd \d\e F \d\e Y') }}
                                    </div>
                                    <div class="text-sm text-gray-600 font-mono mt-1">
                                        Hora:
                                        {{ \App\Helpers\TimezoneHelper::formatForUser($transaction->created_at, 'H:i:s') }}
                                    </div>
                                </div>

                                <!-- Información del receptor -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-mono text-sm text-gray-600 mb-2">
                                        @if ($transaction->sender_id === auth()->id())
                                            Información del receptor
                                        @else
                                            Información del remitente
                                        @endif
                                    </h4>
                                    <div class="font-mono font-bold text-base text-black mb-1">
                                        @if ($transaction->sender_id === auth()->id())
                                            {{ $transaction->receiver->name ?? 'Usuario' }}
                                            {{ $transaction->receiver->lastname ?? '' }}
                                        @else
                                            {{ $transaction->sender->name ?? 'Usuario' }}
                                            {{ $transaction->sender->lastname ?? '' }}
                                        @endif
                                    </div>
                                    <div class="font-mono text-sm text-blue-600 mb-4">
                                        @if ($transaction->sender_id === auth()->id())
                                            {{ $transaction->receiver->email ?? 'email@ejemplo.com' }}
                                        @else
                                            {{ $transaction->sender->email ?? 'email@ejemplo.com' }}
                                        @endif
                                    </div>

                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Teléfono</h4>
                                    <div class="font-mono text-sm text-black mb-4">
                                        @if ($transaction->sender_id === auth()->id())
                                            {{ $transaction->receiver->phone ?? 'No registrado' }}
                                        @else
                                            {{ $transaction->sender->phone ?? 'No registrado' }}
                                        @endif
                                    </div>

                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Detalles del pago</h4>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-mono text-sm">Importe del pago</span>
                                        <span class="font-mono text-sm font-bold">{{ $transaction->currency }}.
                                            {{ number_format($transaction->amount, 2) }}</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="flex justify-between items-center">
                                        <span class="font-mono text-base font-bold">Total</span>
                                        <span class="font-mono text-base font-bold">{{ $transaction->currency }}.
                                            {{ number_format($transaction->amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- ID de transacción -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="font-mono text-sm text-gray-600 mb-2">Id. de transacción</h4>
                                <div class="font-mono text-sm font-bold">
                                    {{ $transaction->custom_id ?? 'No disponible' }}
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex flex-col sm:flex-row gap-6 justify-between">
                                <button onclick="downloadReceipt({{ $transaction->id }})"
                                    class="flex items-center gap-2 text-blue-600 hover:text-blue-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1">
                                            <path d="M5.25 19.5H1.5l-1-8h23l-1 8h-3.75m-1.25-12h3l3 4H.5l3-4h3" />
                                            <path
                                                d="M17.5 9.5h-11v-8H15L17.5 4zm-13 0h15m.5 14H4l2.5-8h11zm-13-3h10m-9-2h8m3.5-5h1m-1 2h1" />
                                        </g>
                                    </svg>
                                    <span class="font-semibold text-sm">Descargar comprobante</span>
                                </button>

                                @if (
                                    $transaction->sender_id === auth()->id() &&
                                        $transaction->status === 'completed' &&
                                        !$transaction->hasPendingRefund() &&
                                        !$transaction->hasApprovedRefund() &&
                                        !$transaction->hasCompletedRefund())
                                    <a href="{{ route('refunds.create', $transaction->id) }}"
                                        class="flex items-center gap-2 text-red-600 hover:text-red-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="-2 -3 24 24">
                                            <path fill="currentColor"
                                                d="m12.8 1.613l6.701 11.161c.963 1.603.49 3.712-1.057 4.71a3.2 3.2 0 0 1-1.743.516H3.298C1.477 18 0 16.47 0 14.581c0-.639.173-1.264.498-1.807L7.2 1.613C8.162.01 10.196-.481 11.743.517c.428.276.79.651 1.057 1.096M10 14a1 1 0 1 0 0-2a1 1 0 0 0 0 2m0-9a1 1 0 0 0-1 1v4a1 1 0 0 0 2 0V6a1 1 0 0 0-1-1" />
                                        </svg>
                                        <span class="font-semibold text-sm">Solicitar un reembolso</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-400 py-8 font-mono">No hay transacciones.</div>
            @endforelse

            <!-- Paginación -->
            <div class="mt-6 flex justify-center">
                @if ($transactions->hasPages())
                    <nav class="inline-flex rounded-full shadow-sm" aria-label="Pagination">
                        @if ($transactions->onFirstPage())
                            <span
                                class="px-4 py-2 bg-gray-200 text-gray-400 rounded-l-full font-mono cursor-not-allowed">Anterior</span>
                        @else
                            <a href="{{ $transactions->previousPageUrl() }}"
                                class="px-4 py-2 bg-[#2563eb] text-white rounded-l-full font-mono hover:bg-[#1e40af] transition">Anterior</a>
                        @endif

                        @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                            @if ($page == $transactions->currentPage())
                                <span
                                    class="px-4 py-2 bg-[#ede8f6] text-[#2563eb] font-bold font-mono">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-2 bg-white text-[#2563eb] font-mono hover:bg-[#f5f7fa] transition">{{ $page }}</a>
                            @endif
                        @endforeach

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

        <!-- Contenido de Solicitudes -->
        <div id="content-solicitudes" class="tab-content hidden">
            <form method="GET" class="mb-2">
                <input type="text" name="request_search" placeholder="Buscar por nombre o correo electrónico"
                    value="{{ request('request_search') }}"
                    class="w-full rounded-full border border-gray-300 px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-mono text-gray-500 bg-[#f5f7fa] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#2563eb] shadow"
                    style="font-family: 'JetBrains Mono', monospace;">
                <!-- Conserva los filtros al buscar -->
                <input type="hidden" name="request_type" value="{{ request('request_type') }}">
                <input type="hidden" name="request_status" value="{{ request('request_status') }}">
                <input type="hidden" name="request_quick_range" value="{{ request('request_quick_range') }}">
                <input type="hidden" name="tab" value="solicitudes">
            </form>
            <div class="mb-8">
                <div class="text-xs sm:text-sm font-mono text-[#222] mb-2">Filtrar por</div>
                <div class="flex flex-wrap gap-2 items-center text-xs sm:text-sm font-mono text-[#222]">
                    <!-- Filtro de fecha -->
                    <form method="GET" class="inline relative">
                        <input type="hidden" name="request_search" value="{{ request('request_search') }}">
                        <input type="hidden" name="request_type" value="{{ request('request_type') }}">
                        <input type="hidden" name="request_status" value="{{ request('request_status') }}">
                        <input type="hidden" name="tab" value="solicitudes">
                        <span
                            class="bg-[#2563eb] text-white px-3 sm:px-4 py-1 rounded-full font-bold font-mono inline-flex items-center cursor-pointer select-none"
                            onclick="document.getElementById('request_quick_range').focus();">
                            Fecha:
                            @if (request('quick_range', '90') == 'all')
                                Desde siempre
                            @elseif(request('quick_range', '90') == '7')
                                Últimos 7 días
                            @elseif(request('quick_range', '90') == '30')
                                Últimos 30 días
                            @elseif(request('quick_range', '90') == '10s')
                                Últimos 10 segundos
                            @else
                                Últimos 90 días
                            @endif
                            <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </span>
                        <select name="request_quick_range" id="request_quick_range" onchange="this.form.submit()"
                            class="absolute left-0 top-0 w-full h-full opacity-0 cursor-pointer" style="z-index:2;">
                            <option value="10s" {{ request('request_quick_range') == '10s' ? 'selected' : '' }}>
                                Últimos
                                10 segundos</option>
                            <option value="7"
                                {{ request('request_quick_range', '90') == '7' ? 'selected' : '' }}>
                                Últimos 7 días</option>
                            <option value="30"
                                {{ request('request_quick_range', '90') == '30' ? 'selected' : '' }}>
                                Últimos 30 días</option>
                            <option value="90"
                                {{ request('request_quick_range', '90') == '90' ? 'selected' : '' }}>
                                Últimos 90 días</option>
                            <option value="all" {{ request('request_quick_range') == 'all' ? 'selected' : '' }}>
                                Desde
                                siempre</option>
                        </select>
                    </form>

                    <!-- Filtro tipo (Enviadas/Recibidas) -->
                    <form method="GET" class="inline">
                        <input type="hidden" name="request_search" value="{{ request('request_search') }}">
                        <input type="hidden" name="request_quick_range"
                            value="{{ request('request_quick_range') }}">
                        <input type="hidden" name="request_status" value="{{ request('request_status') }}">
                        <input type="hidden" name="tab" value="solicitudes">
                        <div x-data="{ open: false }" class="relative inline-block">
                            <button type="button" @click="open = !open"
                                class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                                {{ request('request_type') ? (request('request_type') == 'send' ? 'Enviadas' : (request('request_type') == 'receive' ? 'Recibidas' : 'Tipo')) : 'Tipo' }}
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                                <button type="submit" name="request_type" value=""
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todas</button>
                                <button type="submit" name="request_type" value="send"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Enviadas</button>
                                <button type="submit" name="request_type" value="receive"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Recibidas</button>
                            </div>
                        </div>
                    </form>

                    <!-- Filtro Estado -->
                    <form method="GET" class="inline">
                        <input type="hidden" name="request_search" value="{{ request('request_search') }}">
                        <input type="hidden" name="request_quick_range"
                            value="{{ request('request_quick_range') }}">
                        <input type="hidden" name="request_type" value="{{ request('request_type') }}">
                        <input type="hidden" name="tab" value="solicitudes">
                        <div x-data="{ open: false }" class="relative inline-block">
                            <button type="button" @click="open = !open"
                                class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                                {{ request('request_status')
                                    ? (request('request_status') == 'completed'
                                        ? 'Completado'
                                        : (request('request_status') == 'pending'
                                            ? 'Pendiente'
                                            : (request('request_status') == 'cancelled'
                                                ? 'Rechazada'
                                                : 'Estado')))
                                    : 'Estado' }}
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                                <button type="submit" name="request_status" value=""
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todos</button>
                                <button type="submit" name="request_status" value="completed"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Completado</button>
                                <button type="submit" name="request_status" value="pending"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Pendiente</button>
                                <button type="submit" name="request_status" value="cancelled"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Rechazada</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold mb-6 font-mono text-black">Solicitudes de Pago</h2>

            <!-- Lista de solicitudes -->
            @forelse($requests as $request)
                <a href="{{ url('/transactions/request/' . $request->id) }}"
                    class="block mb-4 bg-[#ede8f6] border border-gray-300 rounded-xl px-4 sm:px-6 py-3 sm:py-4 shadow-sm hover:shadow-md transition-all duration-200 hover:scale-[1.01]">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="bg-green-600 rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="font-bold text-base font-mono text-[#222]">
                                @if ($request->receiver_id === auth()->id())
                                    {{-- Yo soy el que solicita --}}
                                    Solicitaste a <span
                                        class="font-bold text-[#2563eb]">{{ $request->sender->name ?? 'Usuario' }}
                                        {{ $request->sender->lastname ?? '' }}</span>
                                @else
                                    {{-- Yo soy el que recibe la solicitud --}}
                                    <span class="font-bold text-[#2563eb]">{{ $request->receiver->name ?? 'Usuario' }}
                                        {{ $request->receiver->lastname ?? '' }}</span> te solicitó dinero
                                @endif
                            </div>
                            <div class="text-gray-500 text-sm font-mono">
                                {{ $request->created_at->format('d M. Y') }} •
                                @if ($request->status === 'pending')
                                    <span class="text-orange-600">Pendiente</span>
                                @elseif($request->status === 'completed')
                                    <span class="text-green-600">Completada</span>
                                @elseif($request->status === 'cancelled')
                                    <span class="text-red-600">Rechazada</span>
                                @else
                                    <span class="text-red-600">{{ ucfirst($request->status) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right font-bold text-lg font-mono text-green-600">
                            {{ $request->currency }}.{{ number_format($request->amount, 2) }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center text-gray-400 py-8 font-mono">No hay solicitudes de pago.</div>
            @endforelse
        </div>

        <!-- Contenido de Reembolsos -->
        <div id="content-reembolsos" class="tab-content hidden">
            <form method="GET" class="mb-2">
                <input type="text" name="refund_search" placeholder="Buscar por nombre o correo electrónico"
                    value="{{ request('refund_search') }}"
                    class="w-full rounded-full border border-gray-300 px-6 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-mono text-gray-500 bg-[#f5f7fa] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#2563eb] shadow"
                    style="font-family: 'JetBrains Mono', monospace;">
                <input type="hidden" name="refund_type" value="{{ request('refund_type') }}">
                <input type="hidden" name="refund_status" value="{{ request('refund_status') }}">
                <input type="hidden" name="tab" value="reembolsos">
            </form>
            <div class="mb-8">
                <div class="text-xs sm:text-sm font-mono text-[#222] mb-2">Filtrar por</div>
                <div class="flex flex-wrap gap-2 items-center text-xs sm:text-sm font-mono text-[#222]">
                    <!-- Botón de fecha solo con "Todos" -->
                    <span
                        class="bg-[#2563eb] text-white px-3 sm:px-4 py-1 rounded-full font-bold font-mono inline-flex items-center select-none cursor-default">
                        Fecha: Todos
                        <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                    <!-- Filtro tipo (Solicitados/Recibidos) -->
                    <form method="GET" class="inline">
                        <input type="hidden" name="refund_search" value="{{ request('refund_search') }}">
                        <input type="hidden" name="refund_status" value="{{ request('refund_status') }}">
                        <input type="hidden" name="tab" value="reembolsos">
                        <div x-data="{ open: false }" class="relative inline-block">
                            <button type="button" @click="open = !open"
                                class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                                {{ request('refund_type') ? (request('refund_type') == 'sent' ? 'Solicitados' : (request('refund_type') == 'received' ? 'Recibidos' : 'Tipo')) : 'Tipo' }}
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                                <button type="submit" name="refund_type" value=""
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todos</button>
                                <button type="submit" name="refund_type" value="sent"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Solicitados</button>
                                <button type="submit" name="refund_type" value="received"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Recibidos</button>
                            </div>
                        </div>
                    </form>
                    <!-- Filtro Estado -->
                    <form method="GET" class="inline">
                        <input type="hidden" name="refund_search" value="{{ request('refund_search') }}">
                        <input type="hidden" name="refund_type" value="{{ request('refund_type') }}">
                        <input type="hidden" name="tab" value="reembolsos">
                        <div x-data="{ open: false }" class="relative inline-block">
                            <button type="button" @click="open = !open"
                                class="bg-gray-100 px-3 sm:px-4 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition min-w-[70px]">
                                {{ request('refund_status')
                                    ? (request('refund_status') == 'completed'
                                        ? 'Completado'
                                        : (request('refund_status') == 'pending'
                                            ? 'Pendiente'
                                            : (request('refund_status') == 'rejected'
                                                ? 'Rechazado'
                                                : 'Estado')))
                                    : 'Estado' }}
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute z-10 mt-2 bg-white border rounded shadow text-xs sm:text-sm w-32">
                                <button type="submit" name="refund_status" value=""
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Todos</button>
                                <button type="submit" name="refund_status" value="pending"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Pendiente</button>
                                <button type="submit" name="refund_status" value="completed"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Completado</button>
                                <button type="submit" name="refund_status" value="rejected"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">Rechazado</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <h2 class="text-2xl sm:text-3xl font-bold mb-4 font-mono text-black">Solicitudes de Reembolso</h2>

            @forelse($refunds as $refund)
                <div
                    class="mb-4 bg-[#ede8f6] border border-gray-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <div class="flex items-center gap-4 p-4">
                        <div class="flex-shrink-0">
                            <div
                                class="bg-green-500 rounded-full w-10 h-10 flex items-center justify-center text-white text-xl font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                                    viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4v5h5M20 20v-5h-5M5.07 19A9 9 0 1 1 12 21a9 9 0 0 1-6.93-2" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-mono text-base text-black font-bold">
                                @if ($refund->transaction->sender_id === auth()->id())
                                    Solicitaste a <span
                                        class="text-blue-700 font-bold">{{ $refund->transaction->receiver->name ?? 'Usuario' }}
                                        {{ $refund->transaction->receiver->lastname ?? '' }}</span>
                                @else
                                    Te solicitaron de <span
                                        class="text-blue-700 font-bold">{{ $refund->transaction->sender->name ?? 'Usuario' }}
                                        {{ $refund->transaction->sender->lastname ?? '' }}</span>
                                @endif
                            </div>
                            <div class="font-mono text-xs text-gray-600 mt-1">
                                {{ $refund->created_at->format('d M. Y') }} •
                                @if ($refund->status === 'completed')
                                    <span class="text-green-600 font-bold">Completada</span>
                                @elseif($refund->status === 'pending')
                                    <span class="text-yellow-600 font-bold">Pendiente</span>
                                @elseif($refund->status === 'rejected')
                                    <span class="text-red-600 font-bold">Rechazada</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <div class="font-mono text-lg font-bold text-green-700">
                                {{ $refund->currency }} {{ number_format($refund->amount, 2) }}
                            </div>
                            @if ($refund->status === 'pending' && $refund->transaction->receiver_id === auth()->id())
                                <div class="flex gap-2">
                                    <form method="POST" action="{{ route('refunds.accept', $refund->id) }}"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg px-3 py-1.5 font-mono font-bold text-xs transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.02] active:scale-[0.98]">
                                            <div class="flex items-center justify-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Aceptar
                                            </div>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('refunds.reject', $refund->id) }}"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg px-3 py-1.5 font-mono font-bold text-xs transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-[1.02] active:scale-[0.98]">
                                            <div class="flex items-center justify-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Rechazar
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-400 py-8 font-mono">No hay reembolsos.</div>
            @endforelse

            <!-- Paginación -->
            <div class="mt-6 flex justify-center">
                @if ($refunds->hasPages())
                    <nav class="inline-flex rounded-full shadow-sm" aria-label="Pagination">
                        @if ($refunds->onFirstPage())
                            <span
                                class="px-4 py-2 bg-gray-200 text-gray-400 rounded-l-full font-mono cursor-not-allowed">Anterior</span>
                        @else
                            <a href="{{ $refunds->previousPageUrl() }}"
                                class="px-4 py-2 bg-[#2563eb] text-white rounded-l-full font-mono hover:bg-[#1e40af] transition">Anterior</a>
                        @endif

                        @foreach ($refunds->getUrlRange(1, $refunds->lastPage()) as $page => $url)
                            @if ($page == $refunds->currentPage())
                                <span
                                    class="px-4 py-2 bg-[#ede8f6] text-[#2563eb] font-bold font-mono">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-2 bg-white text-[#2563eb] font-mono hover:bg-[#f5f7fa] transition">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($refunds->hasMorePages())
                            <a href="{{ $refunds->nextPageUrl() }}"
                                class="px-4 py-2 bg-[#2563eb] text-white rounded-r-full font-mono hover:bg-[#1e40af] transition">Siguiente</a>
                        @else
                            <span
                                class="px-4 py-2 bg-gray-200 text-gray-400 rounded-r-full font-mono cursor-not-allowed">Siguiente</span>
                        @endif
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript mejorado para transiciones suaves -->
    <script>
        function showTab(tabName) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remover clase activa de todos los botones
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-[#2563eb]', 'text-[#2563eb]');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Mostrar contenido seleccionado
            document.getElementById('content-' + tabName).classList.remove('hidden');

            // Activar botón seleccionado
            const activeButton = document.getElementById('tab-' + tabName);
            activeButton.classList.add('active', 'border-[#2563eb]', 'text-[#2563eb]');
            activeButton.classList.remove('border-transparent', 'text-gray-500');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab === 'reembolsos') {
                showTab('reembolsos');
            } else if (tab === 'solicitudes') {
                showTab('solicitudes');
            } else {
                showTab('transacciones');
            }
        });

        function toggleTransactionDetails(transactionId) {
            const details = document.getElementById('details-' + transactionId);
            const arrow = document.getElementById('arrow-' + transactionId);

            // Cerrar todos los otros detalles primero
            document.querySelectorAll('.transaction-details').forEach((detail, index) => {
                if (detail.id !== 'details-' + transactionId) {
                    detail.style.maxHeight = '0px';
                    detail.classList.add('max-h-0');
                    // Rotar flecha hacia abajo
                    const otherArrow = detail.parentElement.querySelector('[id^="arrow-"]');
                    if (otherArrow) {
                        otherArrow.style.transform = 'rotate(0deg)';
                    }
                }
            });

            // Toggle del detalle actual
            if (details.style.maxHeight === '0px' || !details.style.maxHeight) {
                // Abrir
                details.classList.remove('max-h-0');
                details.style.maxHeight = details.scrollHeight + 'px';
                arrow.style.transform = 'rotate(180deg)';

                // Scroll suave hacia la transacción después de la animación
                setTimeout(() => {
                    details.closest('.transaction-card').scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }, 300);
            } else {
                // Cerrar
                details.style.maxHeight = '0px';
                details.classList.add('max-h-0');
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        function downloadReceipt(transactionId) {
            window.open(`/transactions/${transactionId}/receipt/download`, '_blank');
        }

        function requestRefund(transactionId) {
            if (confirm('¿Estás seguro de que deseas solicitar un reembolso para esta transacción?')) {
                fetch(`/transactions/${transactionId}/refund`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Solicitud de reembolso enviada correctamente');
                        } else {
                            alert('Error al solicitar el reembolso');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            }
        }

        // Cerrar detalles al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.transaction-card')) {
                document.querySelectorAll('.transaction-details').forEach(detail => {
                    detail.style.maxHeight = '0px';
                    detail.classList.add('max-h-0');
                });
                document.querySelectorAll('[id^="arrow-"]').forEach(arrow => {
                    arrow.style.transform = 'rotate(0deg)';
                });
            }
        });
    </script>

    <style>
        .tab-button.active {
            border-bottom-color: #2563eb !important;
            color: #2563eb !important;
        }

        .transaction-details {
            transition: max-height 0.5s ease-in-out;
        }

        .transaction-card:hover {
            transform: translateY(-2px);
        }
    </style>
</x-app-layout>
