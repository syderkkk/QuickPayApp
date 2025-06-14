<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <!-- Tabs Enviar/Solicitar -->
        <div class="w-full bg-[#D9D9D9] border-b-2 border-gray-300">
            <div class="max-w-2xl mx-auto flex flex-row">
                <a href="#"
                    class="font-mono text-lg font-extrabold text-black px-4 py-2 border-b-4 border-black text-center">Enviar</a>
                <a href="#" class="font-mono text-base text-gray-600 px-4 py-2 ml-2 text-center">Solicitar</a>
            </div>
        </div>
        <!-- Mensaje de confirmación -->
        <div class="flex flex-col items-center justify-center w-full min-h-[60vh] px-2 pt-12">
            <div class="text-center mb-6">
                <span class="font-mono font-extrabold text-lg sm:text-xl text-black">
                    Has solicitado dinero exitosamente <span class="font-mono font-extrabold"></span>
                </span>
            </div>
            <div class="mb-8">
                <!-- Imagen de confirmación -->
                <img src="{{ asset('solicitud_dinero.png') }}" alt="Confirmación de solicitud"
                    class="mx-auto w-32 sm:w-40 h-auto">
            </div>
            <div class="flex flex-col items-center gap-2 w-full">
                <a href="{{ route('transactions.request.step1') }}"
                    class="bg-[#2563eb] hover:bg-[#284494] text-white font-mono font-extrabold text-lg py-2 px-8 rounded-xl transition shadow text-center mb-2">
                    Solicitar más dinero
                </a>
                <a href="#" class="text-[#2563eb] font-mono underline text-base text-center">
                    Ir a movimientos
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
