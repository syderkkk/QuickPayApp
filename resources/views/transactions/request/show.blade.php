<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen py-1">
        <div class="flex justify-center items-start w-full px-2 mt-4">
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                <div class="p-4 sm:p-6">
                    <x-alert-succes />

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <h1 class="font-mono font-extrabold text-lg sm:text-xl text-[#284494] mb-2">
                            Detalle de Solicitud
                        </h1>
                        @if ($errors->any())
                            <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-red-600 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="font-mono text-xs text-red-800 font-semibold">Error al procesar la
                                            solicitud</p>
                                        @foreach ($errors->all() as $error)
                                            <p class="font-mono text-xs text-red-700 mt-1">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="flex items-center justify-center gap-2">
                            <div
                                class="w-2 h-2 rounded-full {{ $transaction->status === 'pending' ? 'bg-yellow-500' : ($transaction->status === 'completed' ? 'bg-green-500' : 'bg-red-500') }}">
                            </div>
                            <span
                                class="font-mono text-sm font-semibold {{ $transaction->status === 'pending' ? 'text-yellow-600' : ($transaction->status === 'completed' ? 'text-green-600' : 'text-red-600') }}">
                                {{ $transaction->status === 'pending' ? 'Pendiente' : ($transaction->status === 'completed' ? 'Completada' : 'Rechazada') }}
                            </span>
                        </div>
                    </div>

                    @if ($isRequester)
                        <!-- Vista del SOLICITANTE: Muestra a quién le solicité -->
                        <div
                            class="bg-gradient-to-r from-[#ede8f6] to-[#f8f9ff] rounded-xl p-4 mb-4 border border-[#e0e7ff]">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-gradient-to-br from-[#2563eb] to-[#1d4ed8] rounded-full w-12 h-12 flex items-center justify-center text-white shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-mono font-bold text-sm text-[#284494]">
                                        {{ $payer->name }} {{ $payer->lastname }}
                                    </div>
                                    <div class="font-mono text-xs text-gray-600">{{ $payer->email }}</div>
                                    <div class="flex items-center gap-1 mt-1">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="font-mono text-xs text-blue-600 font-semibold">Destinatario de
                                            solicitud</span>
                                    </div>
                                </div>
                                <div class="bg-[#2563eb] text-white px-3 py-1 rounded-full shadow-sm">
                                    <span class="font-mono text-xs font-semibold">Destinatario</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Vista del PAGADOR: Muestra quién me solicita -->
                        <div
                            class="bg-gradient-to-r from-[#ede8f6] to-[#f8f9ff] rounded-xl p-4 mb-4 border border-[#e0e7ff]">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-gradient-to-br from-green-500 to-green-700 rounded-full w-12 h-12 flex items-center justify-center text-white shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-mono font-bold text-sm text-[#284494]">
                                        {{ $requester->name }} {{ $requester->lastname }}
                                    </div>
                                    <div class="font-mono text-xs text-gray-600">{{ $requester->email }}</div>
                                    <div class="flex items-center gap-1 mt-1">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="font-mono text-xs text-green-600 font-semibold">Solicitante</span>
                                    </div>
                                </div>
                                <div class="bg-green-600 text-white px-3 py-1 rounded-full shadow-sm">
                                    <span class="font-mono text-xs font-semibold">Solicitante</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Monto solicitado -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 mb-4">
                        <div class="text-center">
                            <div class="font-mono text-xs font-bold text-blue-800 mb-2">Monto solicitado</div>
                            <div class="font-mono text-2xl font-extrabold text-blue-900">
                                @php
                                    $symbols = [
                                        'PEN' => 'S/.',
                                        'USD' => '$',
                                        'ARS' => '$',
                                        'COP' => '$',
                                        'CLP' => '$',
                                        'MXN' => '$',
                                        'BRL' => 'R$',
                                    ];
                                    $symbol = $symbols[$requesterCurrency] ?? $requesterCurrency;
                                @endphp
                                {{ $symbol }} {{ number_format($transaction->amount, 2) }}
                            </div>
                            <div class="font-mono text-xs text-gray-600 mt-1">{{ $requesterCurrency }}</div>
                        </div>
                    </div>

                    {{-- Solo el PAGADOR ve la conversión si las monedas son diferentes --}}
                    @if ($isPayer && $showConversion && $convertedAmount && $exchangeRate)
                        <div
                            class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="text-center">
                                    <div class="font-mono text-xs text-emerald-600 mb-1">Te solicitan</div>
                                    <div class="font-mono text-sm font-bold text-emerald-700">
                                        {{ $symbol }} {{ number_format($transaction->amount, 2) }}
                                        <div class="text-xs text-gray-500 font-mono">{{ $requesterCurrency }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center px-2">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <div class="font-mono text-xs text-emerald-600 mb-1">Tú pagarías</div>
                                    <div class="font-mono text-sm font-bold text-emerald-700">
                                        @php
                                            $payerSymbol = $symbols[$payerCurrency] ?? $payerCurrency;
                                        @endphp
                                        {{ $payerSymbol }} {{ number_format($convertedAmount, 2) }}
                                        <div class="text-xs text-gray-500 font-mono">{{ $payerCurrency }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3 pt-3 border-t border-emerald-200">
                                <div class="font-mono text-xs text-gray-600">
                                    Tasa: 1 {{ $requesterCurrency }} = {{ $exchangeRate }} {{ $payerCurrency }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Detalles de la transacción -->
                    <div class="bg-gray-50 rounded-xl p-4 mb-6 space-y-3">
                        <h3 class="font-mono font-bold text-sm text-[#284494] mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Información de la solicitud
                        </h3>

                        <!-- Motivo -->
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gray-500 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                            <div class="flex-1">
                                <div class="font-mono text-xs font-semibold text-gray-700">Motivo</div>
                                <div class="font-mono text-sm text-gray-900">
                                    {{ $transaction->reason ?? 'Sin motivo especificado' }}
                                </div>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gray-500 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <div class="font-mono text-xs font-semibold text-gray-700">Estado</div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="font-mono text-sm font-semibold {{ $transaction->status === 'pending' ? 'text-yellow-600' : ($transaction->status === 'completed' ? 'text-green-600' : 'text-red-600') }}">
                                        {{ $transaction->status === 'pending' ? 'Pendiente' : ($transaction->status === 'completed' ? 'Completada' : 'Rechazada') }}
                                    </span>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-mono font-semibold {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ($transaction->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                        {{ strtoupper($transaction->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Fecha -->
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gray-500 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div class="flex-1">
                                <div class="font-mono text-xs font-semibold text-gray-700">Fecha de solicitud</div>
                                <div class="font-mono text-sm text-gray-900">
                                    {{ \App\Helpers\TimezoneHelper::formatForUser($transaction->created_at, 'd/m/Y H:i') }}
                                </div>
                                <div class="font-mono text-xs text-gray-500">
                                    {{ $transaction->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botones solo para el PAGADOR y si está pendiente --}}
                    @if ($isPayer && $transaction->status === 'pending')
                        <div class="space-y-4">
                            <!-- Formulario para aceptar solicitud -->
                            <form method="POST"
                                action="{{ route('transactions.request.accept', $transaction->id) }}">
                                @csrf

                                <!-- Selección de método de pago -->
                                <div class="mb-4">
                                    <label
                                        class="font-mono text-sm font-bold text-[#284494] flex items-center gap-2 mb-3">
                                        <svg class="w-4 h-4 text-[#2563eb]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                        Pagar desde
                                    </label>
                                    <select name="from_account" required
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-[#e0e7ff] rounded-xl font-mono text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-all duration-200">
                                        <option value="wallet">💳 Saldo QuickPay - {{ $wallet_currency }}
                                            {{ number_format($wallet_balance, 2) }}</option>
                                        @foreach ($cards as $card)
                                            <option value="card_{{ $card->id }}">
                                                {{ $card->brand }} terminada en {{ $card->last_four }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Botón de aceptar -->
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-mono font-bold text-sm py-3.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Aceptar y Pagar Solicitud
                                    </div>
                                </button>
                            </form>

                            <!-- Formulario separado para rechazar -->
                            <form method="POST"
                                action="{{ route('transactions.request.reject', $transaction->id) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-mono font-bold text-sm py-3.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                                    <div class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Rechazar Solicitud
                                    </div>
                                </button>
                            </form>
                        </div>

                        <!-- Información adicional -->
                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-xl">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-mono text-xs text-blue-800 font-semibold">¿Qué sucede después?</p>
                                    <p class="font-mono text-xs text-blue-700 mt-1">
                                        Al aceptar, el dinero se transferirá inmediatamente desde tu método de pago
                                        seleccionado.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif



                    <!-- Botón volver -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('transactions.index') }}"
                            class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-bold py-3 rounded-xl transition-all duration-300 text-sm transform hover:scale-105 active:scale-95">
                            Volver a movimientos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
