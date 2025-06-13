@props(['transactions'])
<div class="w-full overflow-hidden rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff] bg-white mb-8">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap font-secondary">
            <thead>
                <tr class="text-xs font-bold tracking-wide text-left text-[#284494] uppercase border-b bg-[#ede8f6]">
                    <th class="px-4 py-3">Cliente</th>
                    <th class="px-4 py-3">Monto</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3">Fecha</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($transactions as $transaction)
                    <tr class="text-[#222]">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="object-cover w-full h-full rounded-full"
                                         src="{{ asset('avatar-2.jpg') }}"
                                         alt="" loading="lazy" />
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-bold">
                                        {{ $transaction->sender->name ?? 'N/A' }}
                                    </p>
                                    <p class="text-xs text-[#284494]">
                                        {{ $transaction->sender->email ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $transaction->currency ?? '' }} {{ number_format($transaction->amount, 2) }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if($transaction->status === 'completed' || $transaction->status === 'completada')
                                <span class="px-2 py-1 font-bold leading-tight text-green-700 bg-green-100 rounded-full">
                                    Completada
                                </span>
                            @elseif($transaction->status === 'pending' || $transaction->status === 'pendiente')
                                <span class="px-2 py-1 font-bold leading-tight text-orange-700 bg-orange-100 rounded-full">
                                    Pendiente
                                </span>
                            @else
                                <span class="px-2 py-1 font-bold leading-tight text-[#222] bg-[#e0e7ff] rounded-full">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @if($transaction->type === 'send')
                                Envío
                            @else
                                {{ ucfirst($transaction->type) }}
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $transaction->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">No hay transacciones recientes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($transactions->hasPages())
    <div class="w-full flex justify-center mt-6">
        <nav class="flex gap-1 font-mono" aria-label="Paginación">
            {{-- Botón anterior --}}
            @if ($transactions->onFirstPage())
                <span class="px-3 py-2 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed select-none">Anterior</span>
            @else
                <a href="{{ $transactions->previousPageUrl() }}"
                   class="px-3 py-2 rounded-full bg-[#2563eb] text-white hover:bg-[#284494] transition">Anterior</a>
            @endif

            {{-- Números de página --}}
            @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                @if ($page == $transactions->currentPage())
                    <span class="px-3 py-2 rounded-full bg-[#ede8f6] text-[#2563eb] font-bold">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       class="px-3 py-2 rounded-full bg-white text-[#2563eb] hover:bg-[#ede8f6] transition">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Botón siguiente --}}
            @if ($transactions->hasMorePages())
                <a href="{{ $transactions->nextPageUrl() }}"
                   class="px-3 py-2 rounded-full bg-[#2563eb] text-white hover:bg-[#284494] transition">Siguiente</a>
            @else
                <span class="px-3 py-2 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed select-none">Siguiente</span>
            @endif
        </nav>
    </div>
@endif