<x-app-layout>
    @include('layouts.navigation')
    <x-tabs-transacciones activo="solicitar" />
    
    <div class="bg-[#F0F4F4] min-h-screen py-1">
        <div class="flex justify-center items-start w-full py-4 mt-1">
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                <div class="p-3">
                    <x-step-error />

                    <!-- Header -->
                    <div class="text-center mb-3">
                        <h2 class="font-mono font-extrabold text-base text-[#284494] mb-1">
                            Solicitar Dinero
                        </h2>
                        <p class="font-mono text-xs text-gray-600">
                            Completa los detalles de tu solicitud
                        </p>
                    </div>

                    <!-- Información del destinatario -->
                    <div class="bg-gradient-to-r from-[#ede8f6] to-[#f8f9ff] rounded-xl p-2 mb-2 border border-[#e0e7ff]">
                        <div class="flex items-center gap-2">
                            <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-full w-8 h-8 flex items-center justify-center text-white shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-mono font-bold text-xs text-[#284494]">
                                    {{ $receiver->name }} {{ $receiver->lastname }}
                                </div>
                                <div class="font-mono text-xs text-gray-600">{{ $receiver->email }}</div>
                                {{-- <div class="flex items-center gap-1 mt-0.5">
                                    <div class="w-1 h-1 bg-green-500 rounded-full"></div>
                                    <span class="font-mono text-xs text-green-600">Verificado</span>
                                </div> --}}
                            </div>
                            <div class="bg-green-600 text-white px-2 py-0.5 rounded-md">
                                <span class="font-mono text-xs font-semibold">Destinatario</span>
                            </div>
                        </div>
                    </div>

                    <form class="space-y-2" method="POST" action="{{ route('transactions.request.confirm') }}">
                        @csrf
                        <input type="hidden" name="type" value="request">
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                        <!-- Campo de monto -->
                        <div class="space-y-0.5">
                            <label class="font-mono text-xs font-semibold text-[#284494] flex items-center gap-1">
                                <svg class="w-3 h-3 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                                Monto a solicitar
                            </label>
                            <div class="bg-gradient-to-r from-gray-50 to-slate-50 border border-[#e0e7ff] rounded-lg p-1.5 focus-within:ring-2 focus-within:ring-[#2563eb] focus-within:border-transparent">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-base font-bold text-[#284494]">
                                        @if ($wallet_currency === 'PEN')
                                            S/.
                                        @elseif($wallet_currency === 'USD')
                                            $
                                        @elseif($wallet_currency === 'ARS')
                                            $
                                        @elseif($wallet_currency === 'COP')
                                            $
                                        @elseif($wallet_currency === 'CLP')
                                            $
                                        @elseif($wallet_currency === 'MXN')
                                            $
                                        @elseif($wallet_currency === 'BRL')
                                            R$
                                        @else
                                            {{ $wallet_currency }}
                                        @endif
                                    </span>
                                    <input type="number" step="0.01" min="0" value="10.00" name="amount" id="amount"
                                        class="flex-1 bg-transparent text-base font-bold font-mono text-[#284494] placeholder-gray-400 border-none outline-none focus:ring-0"
                                        placeholder="0.00" required>
                                    <div class="bg-[#2563eb] text-white px-2 py-0.5 rounded-md font-mono text-xs font-semibold">
                                        {{ $wallet_currency }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="currency" value="{{ $wallet_currency }}">

                        @error('amount')
                            <div class="bg-red-50 border border-red-200 rounded-lg p-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-mono text-xs text-red-600 font-semibold">{{ $message }}</span>
                                </div>
                            </div>
                        @enderror

                        <!-- Campo de descripción -->
                        <div class="space-y-0.5">
                            <label class="font-mono text-xs font-semibold text-[#284494] flex items-center gap-1">
                                <svg class="w-3 h-3 text-[#2563eb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                Descripción (opcional)
                            </label>
                            <textarea name="reason" rows="2"
                                class="w-full px-2 py-1.5 bg-gray-50 border border-[#e0e7ff] rounded-lg font-mono text-xs focus:ring-2 focus:ring-[#2563eb] focus:border-transparent resize-none"
                                placeholder="Añade una descripción de tu solicitud..."></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="space-y-1.5 pt-1.5">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-mono font-bold text-sm py-2 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.01] active:scale-[0.99]">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Solicitar Dinero
                                </div>
                            </button>
                            <a href="{{ route('transactions.request.step1') }}"
                                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-semibold py-1.5 rounded-lg transition-all duration-200 text-sm">
                                Cancelar
                            </a>
                        </div>
                    </form>

                    <!-- Información adicional -->
                    <div class="mt-3 p-2 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start gap-2">
                            <svg class="w-3 h-3 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-mono text-xs text-blue-800 font-semibold">Información importante</p>
                                <p class="font-mono text-xs text-blue-700 mt-1">
                                    El destinatario recibirá una notificación con tu solicitud. Podrá aceptar o rechazar el envío del dinero.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>