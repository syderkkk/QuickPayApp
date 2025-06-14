<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-4xl mx-auto px-2 sm:px-4 pt-8">
                    <!-- Título y botón -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Transacciones</h2>
                    </div>

                    <!-- Filtros -->
                    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4">
                        <form method="GET" class="flex-1 flex flex-wrap items-center gap-2 w-full">
                            <!-- Buscar por nombre o nombre completo -->
                            <div class="relative w-full sm:w-60">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#2563eb]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                    </svg>
                                </span>
                                <input type="text" name="search" placeholder="Buscar por nombre o correo"
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 w-full rounded-lg border border-[#c7d2fe] text-xs bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" />
                            </div>
                            <!-- Monto mínimo -->
                            <input type="number" step="0.01" min="0" name="min_amount"
                                value="{{ request('min_amount') }}" placeholder="Monto mínimo"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-28" />
                            <!-- Monto máximo -->
                            <input type="number" step="0.01" min="0" name="max_amount"
                                value="{{ request('max_amount') }}" placeholder="Monto máximo"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-28" />
                            <!-- Fecha desde -->
                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-36" />
                            <!-- Fecha hasta -->
                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-36" />
                            <!-- Tipo -->
                            <select name="type"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white">
                                <option value="">Tipo</option>
                                <option value="send" {{ request('type') == 'send' ? 'selected' : '' }}>Enviados
                                </option>
                                <option value="receive" {{ request('type') == 'receive' ? 'selected' : '' }}>Recibidos
                                </option>
                            </select>
                            <!-- Estado -->
                            <select name="status"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white">
                                <option value="">Estado</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                    Completado</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendiente
                                </option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Rechazado
                                </option>
                            </select>
                            <!-- Moneda -->
                            <select name="currency"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-24">
                                <option value="">Divisa</option>
                                <option value="PEN" {{ request('currency') == 'PEN' ? 'selected' : '' }}>PEN
                                </option>
                                <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD
                                </option>
                                <option value="MXN" {{ request('currency') == 'MXN' ? 'selected' : '' }}>MXN
                                </option>
                            </select>
                            <!-- Botón -->
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition text-xs flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                                Buscar
                            </button>
                        </form>
                    </div>

                    <!-- Tabla de transacciones -->
                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] overflow-x-auto">
                        <table class="w-full min-w-[600px] divide-y divide-[#e0e7ff] text-xs">
                            <thead>
                                <tr class="font-bold text-[#284494] uppercase bg-[#ede8f6]">
                                    {{-- <th class="px-3 py-2 text-left">ID</th> --}}
                                    <th class="px-3 py-2 text-left">Enviado por</th>
                                    <th class="px-3 py-2 text-left">Recibido por</th>
                                    <th class="px-3 py-2 text-left">Monto</th>
                                    <th class="px-3 py-2 text-left">Estado</th>
                                    <th class="px-3 py-2 text-left">Fecha</th>
                                    <th class="px-3 py-2 text-left">Acciones</th> <!-- Nueva columna -->
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e0e7ff]">
                                @forelse($transactions as $transaction)
                                    <tr class="hover:bg-[#f5f7fa] transition">
                                        {{-- <td class="px-3 py-2 font-mono text-gray-700">{{ $transaction->id }}</td> --}}
                                        <td class="px-3 py-2 font-semibold text-gray-800">
                                            {{ $transaction->sender->name }} {{ $transaction->sender->lastname }}
                                        </td>
                                        <td class="px-3 py-2 font-semibold text-gray-800">
                                            {{ $transaction->receiver->name ?? '-' }}
                                            {{ $transaction->receiver->lastname ?? '-' }}
                                        </td>
                                        <td class="px-3 py-2 text-gray-700">
                                            {{ $transaction->currency }} {{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="px-3 py-2">
                                            @if ($transaction->status === 'completed')
                                                <span
                                                    class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold text-xs">Completado</span>
                                            @elseif($transaction->status === 'pending')
                                                <span
                                                    class="inline-block px-3 py-1 rounded-full bg-orange-100 text-orange-700 font-bold text-xs">Pendiente</span>
                                            @else
                                                <span
                                                    class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 font-bold text-xs">Rechazado</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 text-gray-700">
                                            {{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-3 py-2">
                                            <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                                class="inline-flex items-center px-2 py-1 rounded bg-blue-100 text-blue-700 font-bold text-[10px] hover:bg-blue-200 transition"
                                                title="Ver transacción">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-6 text-gray-400">No hay
                                            transacciones.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Paginación personalizada -->
                        @if ($transactions->hasPages())
                            <div class="py-4 flex justify-center">
                                <nav class="inline-flex rounded-md shadow-sm font-mono text-sm"
                                    aria-label="Pagination">
                                    {{-- Botón anterior --}}
                                    @if ($transactions->onFirstPage())
                                        <span
                                            class="px-4 py-2 bg-gray-200 text-gray-400 rounded-l-full cursor-not-allowed">Anterior</span>
                                    @else
                                        <a href="{{ $transactions->previousPageUrl() }}"
                                            class="px-4 py-2 bg-white text-[#2563eb] border border-gray-200 hover:bg-blue-50 rounded-l-full transition">Anterior</a>
                                    @endif

                                    {{-- Números de página --}}
                                    @php
                                        $start = max($transactions->currentPage() - 2, 1);
                                        $end = min($transactions->currentPage() + 2, $transactions->lastPage());
                                    @endphp
                                    @for ($i = $start; $i <= $end; $i++)
                                        @if ($i == $transactions->currentPage())
                                            <span
                                                class="px-4 py-2 bg-[#2563eb] text-white font-bold">{{ $i }}</span>
                                        @else
                                            <a href="{{ $transactions->url($i) }}"
                                                class="px-4 py-2 bg-white text-[#2563eb] border border-gray-200 hover:bg-blue-50 transition">{{ $i }}</a>
                                        @endif
                                    @endfor

                                    {{-- Botón siguiente --}}
                                    @if ($transactions->hasMorePages())
                                        <a href="{{ $transactions->nextPageUrl() }}"
                                            class="px-4 py-2 bg-white text-[#2563eb] border border-gray-200 hover:bg-blue-50 rounded-r-full transition">Siguiente</a>
                                    @else
                                        <span
                                            class="px-4 py-2 bg-gray-200 text-gray-400 rounded-r-full cursor-not-allowed">Siguiente</span>
                                    @endif
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
