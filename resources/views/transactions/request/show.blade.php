<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen py-1">
        <div class="flex justify-center items-start w-full px-2 mt-4">
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-lg border border-gray-200">
                <div class="p-5">
                    <h1 class="text-2xl font-extrabold font-mono text-[#2563eb] mb-4 text-center">
                        Detalle de Solicitud de Pago
                    </h1>

                    @if($isRequester)
                        <!-- Vista del SOLICITANTE: Muestra a quién le solicité -->
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 rounded-xl p-3 mb-4 border border-slate-200">
                            <div class="flex items-center gap-2">
                                <div class="bg-gradient-to-br from-[#2563eb] to-[#1d4ed8] rounded-full w-10 h-10 flex items-center justify-center text-white shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-mono font-bold text-base text-gray-900">
                                        {{ $payer->name }} {{ $payer->lastname }}
                                    </div>
                                    <div class="font-mono text-xs text-gray-600">{{ $payer->email }}</div>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="w-1 h-1 bg-blue-500 rounded-full"></div>
                                        <span class="font-mono text-xs text-blue-600">Destinatario de solicitud</span>
                                    </div>
                                </div>
                                <div class="bg-[#2563eb] text-white px-2 py-0.5 rounded-md">
                                    <span class="font-mono text-xs font-semibold">Destinatario</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Vista del PAGADOR: Muestra quién me solicita -->
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 rounded-xl p-3 mb-4 border border-slate-200">
                            <div class="flex items-center gap-2">
                                <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-full w-10 h-10 flex items-center justify-center text-white shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-mono font-bold text-base text-gray-900">
                                        {{ $requester->name }} {{ $requester->lastname }}
                                    </div>
                                    <div class="font-mono text-xs text-gray-600">{{ $requester->email }}</div>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="w-1 h-1 bg-green-500 rounded-full"></div>
                                        <span class="font-mono text-xs text-green-600">Solicitante</span>
                                    </div>
                                </div>
                                <div class="bg-green-600 text-white px-2 py-0.5 rounded-md">
                                    <span class="font-mono text-xs font-semibold">Solicitante</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Monto solicitado (siempre en moneda del solicitante) -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-3 mb-4">
                        <div class="flex items-center gap-2">
                            <div class="bg-blue-100 rounded-full p-1">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-mono text-xs font-bold text-blue-800">Monto solicitado</div>
                                <div class="font-mono text-lg font-extrabold text-blue-900">
                                    @php
                                        $symbols = ['PEN' => 'S/.', 'USD' => '$', 'ARS' => '$', 'EUR' => '€'];
                                        $symbol = $symbols[$requesterCurrency] ?? $requesterCurrency;
                                    @endphp
                                    {{ $symbol }} {{ number_format($transaction->amount, 2) }}
                                    <span class="text-xs text-gray-500 font-mono ml-1">({{ $requesterCurrency }})</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Solo el PAGADOR ve la conversión si las monedas son diferentes --}}
                    @if ($isPayer && $showConversion && $convertedAmount && $exchangeRate)
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-lg p-3 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="text-center">
                                    <div class="font-mono text-xs text-emerald-600 mb-0.5">Te solicitan</div>
                                    <div class="font-mono text-sm font-bold text-emerald-700">
                                        {{ $symbol }} {{ number_format($transaction->amount, 2) }}
                                        <span class="text-xs text-gray-500 font-mono ml-1">({{ $requesterCurrency }})</span>
                                    </div>
                                </div>
                                <div class="flex items-center px-1">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <div class="font-mono text-xs text-emerald-600 mb-0.5">Tú pagarías</div>
                                    <div class="font-mono text-sm font-bold text-emerald-700">
                                        @php
                                            $payerSymbol = $symbols[$payerCurrency] ?? $payerCurrency;
                                        @endphp
                                        {{ $payerSymbol }} {{ number_format($convertedAmount, 2) }}
                                        <span class="text-xs text-gray-500 font-mono ml-1">({{ $payerCurrency }})</span>
                                    </div>
                                    <div class="font-mono text-xs text-gray-500 mt-1">
                                        Tasa de cambio: 1 {{ $requesterCurrency }} = {{ $exchangeRate }} {{ $payerCurrency }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-2 mb-4">
                        <div>
                            <span class="font-semibold">Motivo:</span>
                            <span class="font-mono">{{ $transaction->reason ?? 'Sin motivo' }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Estado:</span>
                            <span class="font-mono">{{ ucfirst($transaction->status) }}</span>
                        </div>
                        <div>
                            <span class="font-semibold">Fecha:</span>
                            <span class="font-mono">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>

                    {{-- Botones solo para el PAGADOR y si está pendiente --}}
                    @if ($isPayer && $transaction->status === 'pending')
                        <div class="flex flex-col sm:flex-row gap-3 mt-6">
                            <form method="POST" {{-- action="{{ route('transactions.requests.accept', $transaction->id) }}" --}} class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-mono font-bold text-base py-2 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.01] active:scale-[0.99]">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Aceptar solicitud
                                    </div>
                                </button>
                            </form>
                            <form method="POST" {{-- action="{{ route('transactions.requests.reject', $transaction->id) }}" --}} class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-500 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-mono font-bold text-base py-2 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.01] active:scale-[0.99]">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Rechazar
                                    </div>
                                </button>
                            </form>
                        </div>
                    @endif

                    <a href="{{ route('transactions.index') }}"
                        class="mt-8 inline-block text-[#2563eb] font-mono underline text-base text-center w-full">
                        Volver a movimientos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>