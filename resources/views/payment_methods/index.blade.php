<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-white min-h-screen pb-0">
        <div class="flex flex-col md:flex-row gap-8 items-start w-full pt-8 px-4 sm:px-8">
            <!-- Columna izquierda -->
            <div class="flex flex-col gap-8 w-full md:w-1/2">
                <div class="flex flex-row gap-6 justify-center flex-wrap">
                    <!-- Asociar cuenta bancaria -->
                    <a href="{{ route('banks.create') }}" class="flex flex-col items-center group">
                        <div class="rounded-full bg-[#dde2ea] flex items-center justify-center group-hover:scale-105 transition-all duration-200"
                            style="width:60px; height:60px; box-shadow: 0 8px 32px 0 #083B7080;">
                            <img src="{{ asset('bank.png') }}" alt="Banco"
                                class="w-10 h-10 select-none pointer-events-none" draggable="false">
                        </div>
                        <span class="mt-2 font-mono text-xs text-black text-center">Asociar una cuenta bancaria</span>
                    </a>
                    <!-- Asociar tarjeta -->
                    <a href="{{ route('cards.create') }}" class="flex flex-col items-center group">
                        <div class="rounded-full bg-[#dde2ea] flex items-center justify-center group-hover:scale-105 transition-all duration-200"
                            style="width:60px; height:60px; box-shadow: 0 8px 32px 0 #083B7080;">
                            <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta"
                                class="w-14 h-14 select-none pointer-events-none" draggable="false">
                        </div>
                        <span class="mt-2 font-mono text-xs text-black text-center">Asociar tarjeta</span>
                    </a>
                </div>
                {{-- <x-payment-methods :cards="$cards" /> --}}

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
                                <span class="font-mono text-base sm:text-lg md:text-xl text-black font-bold">
                                    {{ auth()->user()->wallet->currency ?? 'S/.' }}
                                    {{ number_format(auth()->user()->wallet->balance, 2) }} Disponible
                                </span>
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
                            <form method="POST" action="{{ route('payment-methods.index') }}"
                                class="w-full max-w-xs sm:max-w-md md:max-w-lg">
                                @csrf
                                <input type="hidden" name="selected_card_id" value="{{ $card->id }}">
                                <button type="submit"
                                    class="w-full text-left focus:outline-none
                {{ $card->status === 'disabled' || $card->status === 'inhabilitada' ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                                    {{ $card->status === 'disabled' || $card->status === 'inhabilitada' ? 'disabled' : '' }}>
                                    <div
                                        class="bg-white border border-[#bcb7c2] rounded-xl px-3 sm:px-5 md:px-8 py-4 flex items-center gap-3 sm:gap-4 w-full transition hover:scale-105 {{ session('selected_card_id') == $card->id ? 'ring-2 ring-[#2563eb]' : '' }}">
                                        <span
                                            class="font-extrabold text-xl sm:text-2xl md:text-3xl font-mono text-[#2563eb] flex items-center gap-1">
                                            <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta"
                                                class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12" draggable="false">
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
                                                <span
                                                    class="inline-block px-4 py-1 text-xs rounded-full font-mono font-bold"
                                                    style="background:{{ $card->status === 'enabled' || $card->status === 'habilitada' ? '#16a34a' : '#d32f2f' }}; color:#fff;">
                                                    {{ $card->status === 'enabled' || $card->status === 'habilitada' ? 'Disponible' : 'Inhabilitada' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        @empty
                            <div class="text-gray-400 font-mono text-sm"></div>
                        @endforelse

                        <!-- Cuenta bancaria asociada -->
                        @forelse($banks as $bank)
                            <form action="{{ route('payment-methods.index') }}" method="POST"
                                class="w-full max-w-xs sm:max-w-md md:max-w-lg">
                                @csrf
                                <input type="hidden" name="selected_bank_id" value="{{ $bank->id }}">
                                <button type="submit"
                                    class="w-full text-left focus:outline-none
                {{ !$bank->is_enabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                                    {{ !$bank->is_enabled ? 'disabled' : '' }}>
                                    <div
                                        class="bg-white border border-[#bcb7c2] rounded-xl px-3 sm:px-5 md:px-8 py-4 flex items-center gap-3 sm:gap-4 w-full transition hover:scale-105 {{ session('selected_bank_id') == $bank->id ? 'ring-2 ring-[#2563eb]' : '' }}">
                                        <span
                                            class="font-extrabold text-xl sm:text-2xl md:text-3xl font-mono text-[#2563eb] flex items-center gap-1">
                                            <img src="{{ asset('bank.png') }}" alt="Banco"
                                                class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12" draggable="false">
                                        </span>
                                        <div class="flex flex-col items-start">
                                            <span class="font-mono text-sm sm:text-base md:text-lg text-[#2563eb]">
                                                {{ $bank->bank_name }} - {{ $bank->account_type }}
                                            </span>
                                            <span
                                                class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full bg-blue-200 text-blue-700 font-mono font-bold">
                                                {{ $bank->currency }}
                                            </span>
                                            <div class="flex gap-2 mt-1">
                                                <span
                                                    class="inline-block px-4 py-1 text-xs rounded-full font-mono font-bold"
                                                    style="background:{{ $bank->is_enabled ? '#16a34a' : '#d32f2f' }}; color:#fff;">
                                                    {{ $bank->is_enabled ? 'Disponible' : 'Inhabilitada' }}
                                                </span>
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
            </div>

            <!-- Columna derecha -->
            <div class="flex flex-col items-center justify-start w-full md:w-1/2 mt-8 md:mt-0">
                @php
                    $selectedCard = $cards->where('id', session('selected_card_id'))->first();
                    $selectedBank = $banks->where('id', session('selected_bank_id'))->first();
                @endphp
                @if ($selectedCard)
                    <div class="w-full flex flex-col items-center">
                        <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#bcb7c2] p-4 sm:p-6 md:p-8 flex flex-col items-center mb-2 transition hover:scale-105"
                            style="box-shadow: 0 8px 32px 0 #083B7080;">
                            <img src="{{ asset('bcp_card.png') }}" alt="Tarjeta BCP"
                                class="w-72 max-w-full h-auto select-none pointer-events-none" draggable="false">
                        </div>
                        <div class="font-mono text-base md:text-lg text-black font-bold text-center mt-2">
                            {{ $selectedCard->card_holder ?? 'Sin titular' }}
                        </div>
                        <!-- Botón Editar tarjeta -->
                        <a href="{{ route('cards.edit', $selectedCard->id) }}"
                            class="text-[#2563eb] font-mono text-sm mt-2 hover:underline bg-transparent border-0 p-0">
                            Editar tarjeta
                        </a>
                        <!-- Botón Eliminar cuenta asociada -->
                        <form action="{{ route('cards.destroy', $selectedCard->id) }}" method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar esta tarjeta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-[#d32f2f] font-mono text-sm mt-2 hover:underline bg-transparent border-0 p-0">
                                Eliminar cuenta asociada
                            </button>
                        </form>
                    </div>
                @elseif ($selectedBank)
                    <div class="w-full flex flex-col items-center mt-8">
                        <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#bcb7c2] p-4 sm:p-6 md:p-8 flex flex-col items-center mb-2 transition hover:scale-105"
                            style="box-shadow: 0 8px 32px 0 #083B7080;">
                            <img src="{{ asset('banco.png') }}" alt="Banco"
                                class="w-24 max-w-full h-auto select-none pointer-events-none" draggable="false">
                        </div>
                        <div class="font-mono text-base md:text-lg text-black font-bold text-center mt-2">
                            {{ $selectedBank->bank_name }} - {{ strtoupper($selectedBank->account_type) }}
                        </div>
                        <span class="font-mono text-sm text-gray-600">Cuenta terminada en
                            {{ substr($selectedBank->account_number, -4) }}</span>

                        <!-- Botón Editar tarjeta -->
                        <a href="{{ route('banks.edit', $selectedBank->id) }}"
                            class="text-[#2563eb] font-mono text-sm mt-2 hover:underline bg-transparent border-0 p-0">
                            Editar tarjeta
                        </a>
                        <!-- Botón Eliminar cuenta bancaria -->
                        <form action="{{ route('banks.destroy', $selectedBank->id) }}" method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar esta cuenta bancaria?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-[#d32f2f] font-mono text-sm mt-2 hover:underline bg-transparent border-0 p-0">
                                Eliminar cuenta bancaria
                            </button>
                        </form>
                    </div>
                @else
                    <img src="{{ asset('card.png') }}" alt="Sin cuentas bancarias"
                        class="w-32 sm:w-36 md:w-40 max-w-full h-auto select-none pointer-events-none mb-2"
                        draggable="false">
                    <span
                        class="font-mono text-sm sm:text-base md:text-lg text-black font-bold text-center mt-2 block w-full"
                        style="max-width: 350px;">Sin cuentas bancarias disponibles</span>
                @endif
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
