<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <!-- Tabs Enviar/Solicitar -->
        <x-tabs-transacciones activo="enviar" />
        <!-- Mensaje de confirmación -->
        <div class="flex flex-col items-center justify-center w-full min-h-[60vh] px-2 pt-12">
            <div class="text-center mb-6">
                <span class="font-mono font-extrabold text-lg sm:text-xl text-black">
                    Has enviado {{ $amount }} {{ $currency }} a <span class="font-mono font-extrabold">{{ $receiver->name }} {{ $receiver->lastname }}</span>
                </span>
            </div>
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