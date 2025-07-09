<x-app-layout>
    @include('layouts.navigation')
    <div class="flex flex-col items-center justify-center min-h-screen bg-white">
        <h2 class="text-2xl sm:text-3xl font-black text-center mt-12 mb-8 font-mono">Solicitud de reembolso<br>enviada correctamente</h2>
        <div class="flex items-center justify-center mb-8">
            <div class="rounded-full bg-green-600 w-48 h-48 flex items-center justify-center">
                <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="22" fill="none" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 25l7 7 13-13" />
                </svg>
            </div>
        </div>
        <a href="{{ route('transactions.index', ['tab' => 'reembolsos']) }}"
           class="block w-64 text-center bg-[#1976ed] hover:bg-[#125bb5] text-white font-black text-xl rounded-2xl py-3 transition font-mono">
            Listo
        </a>
    </div>
</x-app-layout>
