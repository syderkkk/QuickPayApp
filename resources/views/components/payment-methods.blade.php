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
        <!-- Tarjetas asociadas del usuario -->
        @forelse($cards as $card)
            <form method="POST" action="{{ route('payment-methods.index') }}" class="w-full max-w-xs sm:max-w-md md:max-w-lg">
                @csrf
                <input type="hidden" name="selected_card_id" value="{{ $card->id }}">
                <button type="submit" class="w-full text-left focus:outline-none">
                    <div class="bg-white border border-[#bcb7c2] rounded-xl px-3 sm:px-5 md:px-8 py-4 flex items-center gap-3 sm:gap-4 w-full transition hover:scale-105"
                        style="box-shadow: 0 8px 32px 0 #083B7080;">
                        <span
                            class="font-extrabold text-xl sm:text-2xl md:text-3xl font-mono text-[#2563eb] flex items-center gap-1">
                            <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12"
                                draggable="false">
                        </span>
                        <div class="flex flex-col items-start">
                            <span class="font-mono text-sm sm:text-base md:text-lg text-[#2563eb]">
                                {{ $card->brand ?? 'Tarjeta' }} terminada en {{ $card->last_four }}
                            </span>
                            <span
                                class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full bg-blue-200 text-blue-700 font-mono font-bold">
                                {{ strtoupper($card->brand) }}
                            </span>
                            <div class="flex gap-2 mt-1">
                                <span class="inline-block px-4 py-1 text-xs rounded-full font-mono font-bold"
                                    style="background:#16a34a; color:#fff;">Disponible</span>
                            </div>
                        </div>
                    </div>
                </button>
            </form>
        @empty
            <div class="text-gray-400 font-mono text-sm"></div>
        @endforelse
    </div>
</div>