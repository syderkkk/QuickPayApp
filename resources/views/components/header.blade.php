<header
    class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-8 py-2 sm:py-3 bg-white shadow gap-2 sm:gap-0">
    <div class="flex items-center gap-2">
        <span class="ml-1 text-yellow-400 text-3xl -mt-1">⚡</span><a href="{{ url('/') }}" class="font-bold text-lg sm:text-xl text-[#1a2a3a] hover:underline">QuickPay</a>
    </div>
    <nav class="flex flex-col sm:flex-row items-center gap-2 sm:gap-8 w-full sm:w-auto">
        @if (Request::is('/'))
            <a href="#beneficios" class="text-[#1a2a3a] font-medium hover:underline text-sm sm:text-base">Cómo funciona</a>
        @endif
        <a href="{{ route('login') }}" class="text-[#1a2a3a] font-medium hover:underline text-sm sm:text-base">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="bg-[#2563eb] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1d4ed8] transition text-sm sm:text-base w-full sm:w-auto text-center">Registrarse</a>
    </nav>
</header>