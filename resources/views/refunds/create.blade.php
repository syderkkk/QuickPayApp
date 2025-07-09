<x-app-layout>
    @include('layouts.navigation')
    
    <div class="bg-[#F0F4F4] min-h-screen py-1">
        <div class="flex justify-center items-start w-full py-4 mt-1">
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                <div class="p-6">
                    <x-alert />

                    <!-- Header -->
                    <div class="text-center mb-6">
                        <div class="bg-gradient-to-br from-[#d32f2f] to-[#b91c1c] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="font-mono font-extrabold text-xl text-[#284494] mb-2">
                            Solicitar Reembolso
                        </h2>
                        <p class="font-mono text-sm text-gray-600">
                            Completa los detalles para procesar tu solicitud
                        </p>
                    </div>

                    <!-- Información de la transacción -->
                    <div class="bg-gradient-to-r from-[#ede8f6] to-[#f8f9ff] rounded-xl p-4 mb-6 border border-[#e0e7ff]">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-semibold text-[#284494]">ID de Transacción</span>
                                <span class="font-mono text-xs font-bold text-gray-700 bg-white px-2 py-1 rounded-md">{{ $transaction->custom_id }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-semibold text-[#284494]">Monto</span>
                                <span class="font-mono text-lg font-bold text-[#d32f2f]">
                                    @if ($transaction->currency === 'PEN')
                                        S/.
                                    @elseif($transaction->currency === 'USD')
                                        $
                                    @elseif($transaction->currency === 'ARS')
                                        $
                                    @elseif($transaction->currency === 'COP')
                                        $
                                    @elseif($transaction->currency === 'CLP')
                                        $
                                    @elseif($transaction->currency === 'MXN')
                                        $
                                    @elseif($transaction->currency === 'BRL')
                                        R$
                                    @else
                                        {{ $transaction->currency }}
                                    @endif
                                    {{ number_format($transaction->amount, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('refunds.store', $transaction->id) }}" class="space-y-4">
                        @csrf

                        <!-- Motivo de reembolso -->
                        <div class="space-y-2">
                            <label class="font-mono text-sm font-semibold text-[#284494] flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Motivo del reembolso
                            </label>
                            <select id="reason_type" name="reason_type" required 
                                class="w-full px-3 py-3 bg-gray-50 border border-[#e0e7ff] rounded-lg font-mono text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent transition-all duration-200">
                                <option value="" disabled selected>Selecciona un motivo</option>
                                <option value="no_recibido">🚫 Producto/servicio no recibido</option>
                                <option value="error_monto">💰 Error en el monto</option>
                                <option value="no_reconozco">❓ No reconozco esta transacción</option>
                                <option value="otro">📝 Otro motivo</option>
                            </select>
                            @error('reason_type')
                                <div class="text-red-500 text-xs font-mono">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="space-y-2">
                            <label class="font-mono text-sm font-semibold text-[#284494] flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                Descripción detallada
                            </label>
                            <textarea id="description" name="description" rows="4" 
                                placeholder="Explica detalladamente el motivo de tu solicitud de reembolso..."
                                class="w-full px-3 py-3 bg-gray-50 border border-[#e0e7ff] rounded-lg font-mono text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent resize-none transition-all duration-200"></textarea>
                            @error('description')
                                <div class="text-red-500 text-xs font-mono">{{ $message }}</div>
                            @enderror
                            <div class="font-mono text-xs text-gray-500 px-1">
                                Proporciona la mayor cantidad de detalles posible para acelerar el proceso
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="space-y-3 pt-4">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-[#d32f2f] to-[#b91c1c] hover:from-[#b91c1c] hover:to-[#991b1b] text-white font-mono font-bold text-sm py-3.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Solicitar Reembolso
                                </div>
                            </button>
                            
                            <a href="{{ route('transactions.index') }}"
                                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-semibold py-3.5 rounded-xl transition-all duration-200 text-sm">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>