
<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <!-- Sidebar personalizado -->
        <x-admin-sidebar />

        <div class="flex flex-col flex-1 w-full">

            <main class="h-full overflow-y-auto">
                <div class="max-w-2xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <!-- Título y volver -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] tracking-tight text-center font-mono drop-shadow-[0_6px_6px_rgba(37,99,235,0.10)]">
                            Detalle de Transacción
                        </h2>
                        <a href="{{ route('admin.transactions.index') }}"
                            class="inline-flex items-center gap-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white px-4 py-2 rounded-lg font-bold shadow transition text-xs">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Volver
                        </a>
                    </div>

                    <!-- Card principal -->
                    <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-6 border border-[#e0e7ff]">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">ID de Transacción</dt>
                                <dd class="font-mono font-bold text-lg text-[#2563eb]">{{ $transaction->id }}</dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Estado</dt>
                                <dd>
                                    @if($transaction->status === 'completed' || $transaction->status === 'completada')
                                        <span class="px-2 py-1 font-bold leading-tight text-green-700 bg-green-100 rounded-full text-xs font-mono">Completada</span>
                                    @elseif($transaction->status === 'pending' || $transaction->status === 'pendiente')
                                        <span class="px-2 py-1 font-bold leading-tight text-orange-700 bg-orange-100 rounded-full text-xs font-mono">Pendiente</span>
                                    @else
                                        <span class="px-2 py-1 font-bold leading-tight text-[#222] bg-[#e0e7ff] rounded-full text-xs font-mono">{{ ucfirst($transaction->status) }}</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Enviado por</dt>
                                <dd class="font-mono font-bold text-base text-black">
                                    {{ $transaction->sender->name ?? '-' }} (ID: {{ $transaction->sender->id ?? '-' }})
                                </dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Recibido por</dt>
                                <dd class="font-mono font-bold text-base text-black">
                                    {{ $transaction->receiver->name ?? '-' }} (ID: {{ $transaction->receiver->id ?? '-' }})
                                </dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Monto</dt>
                                <dd class="font-mono font-extrabold text-xl text-[#284494]">
                                    {{ $transaction->currency }} {{ number_format($transaction->amount, 2) }}
                                </dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Fecha y hora</dt>
                                <dd class="font-mono text-base text-black">
                                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Tipo de transacción</dt>
                                <dd class="font-mono text-base text-black">
                                    @if($transaction->type === 'send')
                                        Envío
                                    @elseif($transaction->type === 'receive')
                                        Recibo
                                    @else
                                        {{ ucfirst($transaction->type) }}
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="font-mono text-xs text-gray-500 mb-1">Método de pago</dt>
                                <dd class="font-mono text-base text-black">
                                    @if($transaction->payment_method)
                                        {{ $transaction->payment_method->type === 'card' ? 'Tarjeta' : 'Banco' }}
                                        @if($transaction->payment_method->type === 'card')
                                            (**** {{ $transaction->payment_method->last_four }})
                                        @elseif($transaction->payment_method->type === 'bank')
                                            ({{ $transaction->payment_method->bank_name }})
                                        @endif
                                    @else
                                        Saldo QuickPay
                                    @endif
                                </dd>
                            </div>
                            <div class="md:col-span-2">
                                <dt class="font-mono text-xs text-gray-500 mb-1">Motivo</dt>
                                <dd class="font-mono text-base text-black">
                                    @if($transaction->reason)
                                        "{{ $transaction->reason }}"
                                    @else
                                        <span class="italic text-gray-400">Sin motivo especificado</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>