<x-app-layout>
    @include('layouts.navigation')

    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-6xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
            <!-- Saludo -->
            <div class="mb-3">
                <h1
                    class="font-mono font-extrabold text-base sm:text-lg md:text-xl text-[#284494] drop-shadow-[0_6px_6px_rgba(37,99,235,0.25)]">
                    ¡Hola, {{ Auth::user()->name }}!
                </h1>
            </div>
            <!-- Grilla principal -->
            <div class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Saldo -->
                    <div
                        class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 sm:p-6 md:p-8 flex flex-col justify-between min-h-[220px] border border-[#e0e7ff] w-full">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="text-xs sm:text-sm md:text-base text-[#2563eb] font-mono mb-1 tracking-wide">
                                    Saldo de QuickPay</div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span
                                        class="text-xl sm:text-2xl md:text-4xl font-extrabold font-mono text-black tracking-widest break-all">PEN</span>
                                    <span
                                        class="text-lg sm:text-xl md:text-3xl font-extrabold font-mono text-black tracking-widest break-all">100.00</span>
                                </div>
                                <div class="text-xs sm:text-sm text-black font-mono">Disponible</div>
                            </div>
                            <div class="flex-shrink-0 flex items-center justify-center mt-2 sm:mt-0">
                                <span
                                    class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-[#284494] font-mono select-none whitespace-nowrap">
                                    Q<span class="ml-1">⚡</span>
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-3 md:gap-4 mt-6 w-full">
                            <button
                                class="flex items-center justify-center gap-2 bg-[#2563eb] text-white font-bold rounded-lg px-5 py-2 font-mono text-base shadow hover:bg-[#1d4ed8] transition w-full md:w-auto border border-[#2563eb]">
                                <span class="font-extrabold">Q</span><span class="text-lg">⚡</span> Enviar Dinero
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 bg-[#f7fafc] text-black font-bold rounded-lg px-5 py-2 font-mono text-base shadow border border-[#2563eb] hover:bg-[#e0e7ff] transition w-full md:w-auto">
                                <span class="font-extrabold text-[#2563eb]">Q</span><span
                                    class="text-lg text-[#2563eb]">⚡</span> Solicitar Dinero
                            </button>
                        </div>
                    </div>
                    <!-- Asociar tarjeta -->
                    <div
                        class="bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 sm:p-6 md:p-8 flex flex-col items-center justify-center min-h-[140px] border border-[#e0e7ff] w-full">
                        <div class="flex items-center justify-center mb-3">
                            <div class="rounded-full bg-[#dde2ea] w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center shadow-xl"
                                style="box-shadow: 0 8px 32px 0 #0C5CADB3;">
                                <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta"
                                    class="w-10 sm:w-12 sm:h-12 max-w-full h-auto select-none pointer-events-none"
                                    draggable="false">
                            </div>
                        </div>
                        <div
                            class="font-extrabold text-sm sm:text-base md:text-lg font-mono text-black mb-1 text-center">
                            Asociar una tarjeta</div>
                        <div class="text-xs sm:text-sm text-black font-mono text-center">Envíe pagos en cuestión de
                            minutos.</div>
                    </div>
                    <!-- Actividad reciente -->
                    <div
                        class="bg-white rounded-2xl shadow-[0_6px_24px_0_#2563eb50] p-4 sm:p-6 md:p-8 min-h-[170px] flex flex-col justify-between border border-[#e0e7ff] w-full">
                        <div>
                            <div class="font-extrabold text-lg sm:text-xl md:text-2xl font-mono text-black mb-2">
                                Actividad reciente</div>
                            <div class="text-xs sm:text-sm text-black font-mono mb-4 leading-tight">
                                Consulte el dinero enviado y recibido. Aquí encontrará sus movimientos recientes con
                                QuickPay
                            </div>
                        </div>
                        <a href="#" class="text-[#2563eb] font-mono text-xs sm:text-sm hover:underline">Mostrar
                            todos</a>
                    </div>
                    <!-- Contactos frecuentes -->
                    <div
                        class="bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 sm:p-6 md:p-8 min-h-[170px] flex flex-col justify-between border border-[#e0e7ff] w-full">
                        <div class="flex items-center justify-between mb-2">
                            <div class="font-extrabold text-lg sm:text-xl md:text-2xl font-mono text-black">Contactos
                                frecuentes</div>
                            <span class="text-[#2563eb] ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-6 w-6 sm:h-8 sm:w-8"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle cx="11" cy="11" r="7" stroke-width="2" stroke="currentColor"
                                        fill="none" />
                                    <line x1="18" y1="18" x2="15.5" y2="15.5" stroke-width="2"
                                        stroke="currentColor" stroke-linecap="round" />
                                </svg>
                            </span>
                        </div>
                        <div class="text-xs sm:text-sm text-black font-mono mb-4">Buscar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-[#f7fafc] border-t border-[#e0e7ff] mt-8 py-6 text-center">
        <div
            class="flex flex-col sm:flex-row justify-center items-center gap-0 sm:gap-6 mb-2 font-mono text-xs sm:text-sm space-y-2 sm:space-y-0 sm:space-x-6">
            <a href="{{ route('terminos') }}" class="text-[#2563eb] hover:underline">Términos y Condiciones</a>
            <a href="{{ route('privacidad') }}" class="text-[#2563eb] hover:underline">Política de Privacidad</a>
            <a href="mailto:soporte@quickpay.com" class="text-[#2563eb] hover:underline">Correo de contacto</a>
        </div>
        <div class="text-[#222] font-mono text-xs mt-2">&copy; 2025 QuickPay. Todos los derechos reservados.</div>
    </footer>
</x-app-layout>
