<x-app-layout>
    @include('layouts.navigation')
    <div class="max-w-2xl mx-auto py-8 px-2 sm:px-4">
        <!-- Pestañas Transacciones/Solicitudes -->
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
                <input type="hidden" name="currency" value="{{ request('currency') }}">
            </form>

            <!-- Filtros -->
            <div class="mb-8">
                <div class="text-xs sm:text-sm font-mono text-[#222] mb-2">Filtrar por</div>
                <div class="flex flex-wrap gap-2 items-center text-xs sm:text-sm font-mono text-[#222]">
                    <span class="bg-[#2563eb] text-white px-3 sm:px-4 py-1 rounded-full font-bold font-mono">Fecha: Últimos 90 días</span>

                    <!-- Filtros existentes... -->
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
            <h2 class="text-2xl sm:text-3xl font-bold mb-2 font-mono text-black">Transacciones Completadas</h2>
            <div class="text-gray-500 mb-6 font-mono text-sm sm:text-base">Esta semana</div>
            
            <!-- Lista de transacciones -->
            @forelse($transactions as $transaction)
                <div class="transaction-card mb-4 bg-[#ede8f6] border border-gray-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <!-- Cabecera clickeable de la transacción -->
                    <div onclick="toggleTransactionDetails({{ $transaction->id }})"
                        class="cursor-pointer flex flex-col sm:flex-row items-center px-4 sm:px-6 py-3 sm:py-4 hover:bg-[#e0d9f1] transition-all duration-200">
                        <div class="flex-shrink-0">
                            <div class="bg-[#2563eb] rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white text-xl sm:text-2xl font-bold shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
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
                        <div class="text-right font-bold text-base sm:text-lg font-mono {{ $transaction->sender_id === auth()->id() ? 'text-red-500' : 'text-green-600' }} w-full sm:w-auto mt-2 sm:mt-0">
                            @if ($transaction->sender_id === auth()->id())
                                -{{ $transaction->currency }}.{{ number_format($transaction->amount, 2) }}
                            @else
                                +{{ $transaction->receiver_currency ?? $transaction->currency }}.{{ number_format($transaction->converted_amount ?? $transaction->amount, 2) }}
                            @endif
                        </div>
                        <div class="ml-3">
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300 ease-in-out" 
                                id="arrow-{{ $transaction->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Detalles expandibles dentro de la misma card -->
                    <div id="details-{{ $transaction->id }}" 
                        class="transaction-details max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-[#e0d9f1]border-t border-gray-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold font-mono text-[#2563eb]">Detalles de Transacción</h3>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-mono font-bold">Completado</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Información del pagador -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Pagado con</h4>
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-8 h-8 bg-[#2563eb] rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="font-mono font-bold text-base">Tarjeta de débito x-2078</div>
                                            <div class="font-mono text-sm text-gray-600">VISA</div>
                                        </div>
                                    </div>
                                    <div class="text-right font-mono font-bold text-lg">{{ $transaction->currency }}. {{ number_format($transaction->amount, 2) }}</div>
                                    <div class="text-sm text-gray-600 font-mono mt-2">
                                        Verá "QuickPay {{ $transaction->sender->name ?? 'USUARIO' }}" En el estado de cuenta de su tarjeta.
                                    </div>
                                    <div class="text-sm text-gray-600 font-mono mt-1">
                                        en {{ $transaction->created_at->format('d \d\e F \d\e Y') }}
                                    </div>
                                </div>

                                <!-- Información del receptor -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Información del receptor</h4>
                                    <div class="font-mono font-bold text-base text-black mb-1">
                                        @if ($transaction->sender_id === auth()->id())
                                            {{ $transaction->receiver->name ?? 'Usuario' }} {{ $transaction->receiver->lastname ?? '' }}
                                        @else
                                            {{ $transaction->sender->name ?? 'Usuario' }} {{ $transaction->sender->lastname ?? '' }}
                                        @endif
                                    </div>
                                    <div class="font-mono text-sm text-blue-600 mb-4">
                                        @if ($transaction->sender_id === auth()->id())
                                            {{ $transaction->receiver->email ?? 'email@ejemplo.com' }}
                                        @else
                                            {{ $transaction->sender->email ?? 'email@ejemplo.com' }}
                                        @endif
                                    </div>

                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Id. del formato de pago</h4>
                                    <div class="font-mono text-sm text-black mb-4">{{ strtoupper(substr(md5($transaction->id), 0, 16)) }}</div>

                                    <h4 class="font-mono text-sm text-gray-600 mb-2">Detalles del pago</h4>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-mono text-sm">Importe del pago</span>
                                        <span class="font-mono text-sm font-bold">{{ $transaction->currency }}. {{ number_format($transaction->amount, 2) }}</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="flex justify-between items-center">
                                        <span class="font-mono text-base font-bold">Total</span>
                                        <span class="font-mono text-base font-bold">{{ $transaction->currency }}. {{ number_format($transaction->amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- ID de transacción -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <h4 class="font-mono text-sm text-gray-600 mb-2">Id. de transacción</h4>
                                <div class="font-mono text-sm font-bold">{{ strtoupper(substr(md5($transaction->id . $transaction->created_at), 0, 12)) }}</div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button onclick="downloadReceipt({{ $transaction->id }})" 
                                    class="flex items-center justify-center gap-2 bg-[#2563eb] text-white px-6 py-3 rounded-lg font-mono font-bold hover:bg-[#1d4ed8] transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Descargar comprobante
                                </button>
                                <button onclick="requestRefund({{ $transaction->id }})" 
                                    class="flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg font-mono font-bold hover:bg-red-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Solicitar un reembolso
                                </button>
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
                            <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-l-full font-mono cursor-not-allowed">Anterior</span>
                        @else
                            <a href="{{ $transactions->previousPageUrl() }}" class="px-4 py-2 bg-[#2563eb] text-white rounded-l-full font-mono hover:bg-[#1e40af] transition">Anterior</a>
                        @endif

                        @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                            @if ($page == $transactions->currentPage())
                                <span class="px-4 py-2 bg-[#ede8f6] text-[#2563eb] font-bold font-mono">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 bg-white text-[#2563eb] font-mono hover:bg-[#f5f7fa] transition">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($transactions->hasMorePages())
                            <a href="{{ $transactions->nextPageUrl() }}" class="px-4 py-2 bg-[#2563eb] text-white rounded-r-full font-mono hover:bg-[#1e40af] transition">Siguiente</a>
                        @else
                            <span class="px-4 py-2 bg-gray-200 text-gray-400 rounded-r-full font-mono cursor-not-allowed">Siguiente</span>
                        @endif
                    </nav>
                @endif
            </div>
        </div>

        <!-- Contenido de Solicitudes -->
        <div id="content-solicitudes" class="tab-content hidden">
            <h2 class="text-2xl sm:text-3xl font-bold mb-6 font-mono text-black">Solicitudes de Pago</h2>
            
            <!-- Lista de solicitudes -->
            @php
                $requests = App\Models\Transaction::where('type', 'request')
                    ->where(function($q) {
                        $q->where('sender_id', auth()->id())
                          ->orWhere('receiver_id', auth()->id());
                    })
                    ->with(['sender', 'receiver'])
                    ->latest()
                    ->take(10)
                    ->get();
            @endphp

            @forelse($requests as $request)
                <a {{-- href="{{ route('transactions.request.show', $request->id) }}" --}} 
                   class="block mb-4 bg-[#ede8f6] border border-gray-300 rounded-xl px-4 sm:px-6 py-3 sm:py-4 shadow-sm hover:shadow-md transition-all duration-200 hover:scale-[1.01]">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-green-600 rounded-full w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="font-bold text-base font-mono text-[#222]">
                                @if ($request->receiver_id === auth()->id())
                                    Solicitud de {{ $request->sender->name ?? 'Usuario' }} {{ $request->sender->lastname ?? '' }}
                                @else
                                    Solicitud a {{ $request->receiver->name ?? 'Usuario' }} {{ $request->receiver->lastname ?? '' }}
                                @endif
                            </div>
                            <div class="text-gray-500 text-sm font-mono">
                                {{ $request->created_at->format('d M. Y') }} •
                                @if($request->status === 'pending')
                                    <span class="text-orange-600">Pendiente</span>
                                @elseif($request->status === 'completed')
                                    <span class="text-green-600">Completada</span>
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