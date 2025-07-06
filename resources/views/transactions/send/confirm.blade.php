<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <!-- Tabs Enviar/Solicitar -->
        <x-tabs-transacciones activo="enviar" />
        
        <!-- Mensaje de confirmación -->
        <div class="flex flex-col items-center justify-center w-full min-h-[60vh] px-2 pt-12">
            <div class="text-center mb-6 max-w-lg">
                <span class="font-mono font-extrabold text-lg sm:text-xl text-black">
                    Has enviado 
                    @if($sender_currency === 'PEN')
                        S/.
                    @elseif($sender_currency === 'USD')
                        $
                    @elseif($sender_currency === 'EUR')
                        €
                    @else
                        {{ $sender_currency }}
                    @endif
                    {{ number_format($sender_amount, 2) }} 
                    ({{ $sender_currency }}) a 
                    <span class="font-mono font-extrabold">{{ $receiver->name }} {{ $receiver->lastname }}</span>
                </span>
            </div>

            <!-- Mostrar conversión si las monedas son diferentes -->
            @if($sender_currency !== $receiver_currency)
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg max-w-md w-full mx-2">
                    <div class="text-center">
                        <div class="font-mono text-sm text-blue-800 mb-2">
                            <span class="font-bold">Conversión realizada:</span>
                        </div>
                        <div class="font-mono text-lg font-bold text-blue-900">
                            {{ $receiver->name }} recibió:
                        </div>
                        <div class="font-mono text-2xl font-extrabold text-green-600 mt-1">
                            @if($receiver_currency === 'PEN')
                                S/.
                            @elseif($receiver_currency === 'USD')
                                $
                            @elseif($receiver_currency === 'EUR')
                                €
                            @else
                                {{ $receiver_currency }}
                            @endif
                            {{ number_format($receiver_amount, 2) }} 
                            ({{ $receiver_currency }})
                        </div>
                        <div class="font-mono text-xs text-gray-600 mt-2">
                            Tasa de cambio: 1 {{ $sender_currency }} = {{ $exchange_rate }} {{ $receiver_currency }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="mb-8">
                <!-- Imagen de confirmación -->
                <img src="{{ asset('confirm_send.png') }}" alt="Confirmación de envío" class="mx-auto w-32 sm:w-40 h-auto">
            </div>


            <div class="flex flex-col items-center gap-2 w-full">
                <a href="{{ route('transactions.send.step1') }}"
                   class="bg-[#2563eb] hover:bg-[#284494] text-white font-mono font-extrabold text-lg py-2 px-8 rounded-xl transition shadow text-center mb-2">
                    Enviar más dinero
                </a>
                <a href="{{ route('transactions.index') }}" class="text-[#2563eb] font-mono underline text-base text-center">
                    Ir a movimientos
                </a>
            </div>
        </div>
    </div>
</x-app-layout>