<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-white min-h-screen pb-0">
        <div class="flex flex-col md:flex-row gap-8 items-start w-full pt-8 px-4 sm:px-8">
            <!-- Columna izquierda -->
            <div class="flex flex-col gap-8 w-full md:w-1/2">
                <div class="flex flex-row gap-6 justify-center flex-wrap">
                    <!-- Asociar cuenta bancaria -->
                    <a href="#" class="flex flex-col items-center group">
                        <div class="rounded-full bg-[#dde2ea] flex items-center justify-center group-hover:scale-105 transition-all duration-200"
                            style="width:60px; height:60px; box-shadow: 0 8px 32px 0 #083B7080;">
                            <img src="{{ asset('bank.png') }}" alt="Banco"
                                class="w-10 h-10 select-none pointer-events-none" draggable="false">
                        </div>
                        <span class="mt-2 font-mono text-xs text-black text-center">Asociar una cuenta bancaria</span>
                    </a>
                    <!-- Asociar tarjeta -->
                    <a href="#" class="flex flex-col items-center group">
                        <div class="rounded-full bg-[#dde2ea] flex items-center justify-center group-hover:scale-105 transition-all duration-200"
                            style="width:60px; height:60px; box-shadow: 0 8px 32px 0 #083B7080;">
                            <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta"
                                class="w-14 h-14 select-none pointer-events-none" draggable="false">
                        </div>
                        <span class="mt-2 font-mono text-xs text-black text-center">Asociar tarjeta</span>
                    </a>
                </div>
                <!-- Saldo QuickPay y tarjetas asociadas -->
                <div class="w-full mt-8">
                    <div class="flex flex-col gap-6 items-center w-full">
                        <!-- Tarjeta de saldo principal -->
                        <div class="bg-white border border-[#bcb7c2] rounded-xl px-3 sm:px-5 md:px-8 py-4 flex items-center gap-3 sm:gap-4 w-full max-w-xs sm:max-w-md md:max-w-lg"
                            style="box-shadow: 0 8px 32px 0 #083B7080;">
                            <span
                                class="font-extrabold text-xl sm:text-2xl md:text-3xl font-mono text-[#2563eb] flex items-center gap-1">
                                Q<span class="text-yellow-400 text-2xl sm:text-3xl md:text-4xl">⚡</span>
                            </span>
                            <div class="flex flex-col items-start">
                                <span class="font-mono text-sm sm:text-base md:text-lg text-[#2563eb]">Saldo de
                                    QuickPay</span>
                                <span class="font-mono text-base sm:text-lg md:text-xl text-black font-bold">S/. 90.00
                                    Disponible</span>
                                <div class="w-auto">
                                    <span class="inline-block mt-1 px-4 py-1 text-xs rounded-full font-mono font-bold"
                                        style="background:#16a34a; color:#fff;">
                                        PRINCIPAL
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta asociada simulada -->
                        <div class="bg-white border border-[#bcb7c2] rounded-xl px-3 sm:px-5 md:px-8 py-4 flex items-center gap-3 sm:gap-4 w-full max-w-xs sm:max-w-md md:max-w-lg"
                            style="box-shadow: 0 8px 32px 0 #083B7080;">
                            <span
                                class="font-extrabold text-xl sm:text-2xl md:text-3xl font-mono text-[#2563eb] flex items-center gap-1">
                                <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta"
                                    class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12" draggable="false">
                            </span>
                            <div class="flex flex-col items-start">
                                <span class="font-mono text-sm sm:text-base md:text-lg text-[#2563eb]">Tarjeta
                                    asociada</span>
                                <span
                                    class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full bg-blue-200 text-blue-700 font-mono font-bold">VISA</span>
                                <div class="flex gap-2 mt-1">
                                    <span class="inline-block px-4 py-1 text-xs rounded-full font-mono font-bold"
                                        style="background:#16a34a; color:#fff;">Disponible</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Columna derecha -->
            <div class="flex flex-col items-center justify-start w-full md:w-1/2 mt-8 md:mt-0">
                <img src="{{ asset('card.png') }}" alt="Sin cuentas bancarias"
                    class="w-32 sm:w-36 md:w-40 max-w-full h-auto select-none pointer-events-none mb-2"
                    draggable="false">
                <span
                    class="font-mono text-sm sm:text-base md:text-lg text-black font-bold text-center mt-2 block w-full"
                    style="max-width: 350px;">Sin cuentas bancarias disponibles</span>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
