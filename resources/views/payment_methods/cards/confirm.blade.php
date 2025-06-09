<x-app-layout>
    @include('layouts.navigation')
    <div class="flex flex-col items-center justify-center min-h-[60vh] pt-8">
        <div class="text-center mb-8">
            <span class="font-mono font-extrabold text-lg sm:text-xl text-black leading-tight block">
                Ha asociado su tarjeta<br>
                Banco de Crédito del Perú de<br>
                ahorros terminada en <span class="tracking-widest">**2869</span>
            </span>
        </div>
        <div class="mb-8">
            <div class="rounded-full bg-green-500 w-32 h-32 flex items-center justify-center mx-auto shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <a href="{{ route('payment-methods.index') }}"
            class="block w-48 mx-auto bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3 rounded-xl font-mono text-lg text-center transition">
            Listo
        </a>
    </div>
</x-app-layout>