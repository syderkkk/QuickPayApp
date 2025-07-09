<x-app-layout>
    @include('layouts.navigation')

    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-6xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
            <!-- Saludo -->
            <div class="mb-3">
                <h1
                    class="font-mono font-extrabold text-base sm:text-lg md:text-xl text-[#284494] drop-shadow-[0_6px_6px_rgba(37,99,235,0.25)]">
                    ¡Hola, {{ Auth::user()->name }} {{ Auth::user()->lastname }}!
                </h1>
            </div>
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
                                        class="text-xl sm:text-2xl md:text-4xl font-extrabold font-mono text-black tracking-widest break-all">{{ auth()->user()->wallet->currency }}</span>
                                    <span
                                        class="text-lg sm:text-xl md:text-3xl font-extrabold font-mono text-black tracking-widest break-all">{{ number_format(auth()->user()->wallet->balance, 2) }}</span>
                                </div>
                                <div class="text-xs sm:text-sm text-black font-mono">Disponible</div>
                            </div>
                            <div class="flex-shrink-0 flex items-center justify-center mt-2 sm:mt-0">
                                <span
                                    class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-[#284494] font-mono select-none whitespace-nowrap">
                                    <span class="ml-1">⚡</span>
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-3 md:gap-4 mt-6 w-full">
                            <button
                                class="flex items-center justify-center gap-2 bg-[#2563eb] text-white font-bold rounded-lg px-5 py-2 font-mono text-base shadow hover:bg-[#1d4ed8] transition w-full md:w-auto border border-[#2563eb]">
                                <a href="{{ route('transactions.send.step1') }}" <span
                                    class="font-extrabold">Q</span><span class="text-lg">⚡</span> Enviar Dinero
                                </a>
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 bg-white text-[#2563eb] font-bold rounded-lg px-5 py-2 font-mono text-base shadow hover:bg-[#f0f4ff] transition w-full md:w-auto border border-[#2563eb]">
                                <span class="font-extrabold text-[#2563eb]">Q</span>
                                <a href="{{ route('transactions.request.step1') }}" <span
                                    class="text-lg text-[#2563eb]">⚡</span>
                                    Solicitar Dinero
                                </a>
                            </button>
                        </div>
                    </div>
                    <!-- Asociar tarjeta -->
                    @if (auth()->user()->cards && auth()->user()->cards->count())
                        @php
                            $card = auth()->user()->cards->first();
                        @endphp
                        <a href="{{ route('payment-methods.index') }}" class="block focus:outline-none">
                            <div
                                class="bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 sm:p-6 md:p-8 flex flex-col items-center justify-center min-h-[140px] border border-[#e0e7ff] w-full transition hover:scale-105 cursor-pointer">
                                <div class="flex items-center justify-center mb-3">

                                    <div class="rounded-full bg-[#dde2ea] w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center shadow-xl"
                                        style="box-shadow: 0 8px 32px 0 #0C5CADB3;">
                                        @if (strtolower($card->brand) === 'visa')
                                            <img src="{{ asset('visa.png') }}" alt="Visa"
                                                class="w-7 sm:w-8 sm:h-8 max-w-full h-auto select-none pointer-events-none"
                                                draggable="false">
                                        @elseif (strtolower($card->brand) === 'mastercard')
                                            <img src="{{ asset('mastercard.png') }}" alt="Mastercard"
                                                class="w-7 sm:w-8 sm:h-8 max-w-full h-auto select-none pointer-events-none"
                                                draggable="false">
                                        @else
                                            <img src="{{ asset('credit-card.png') }}" alt="Tarjeta"
                                                class="w-7 sm:w-8 sm:h-8 max-w-full h-auto select-none pointer-events-none"
                                                draggable="false">
                                        @endif
                                    </div>

                                </div>
                                <div
                                    class="font-extrabold text-base sm:text-lg md:text-xl font-mono text-[#2563eb] mb-2 text-center">
                                    {{ $card->brand ?? 'Visa de débito' }}-{{ $card->last_four }}
                                </div>
                                <span class="inline-block px-4 py-1 text-xs rounded-full font-mono font-bold mb-2"
                                    style="background:{{ $card->status === 'enabled' || $card->status === 'habilitada' ? '#16a34a' : '#d32f2f' }}; color:#fff;">
                                    {{ $card->status === 'enabled' || $card->status === 'habilitada' ? 'Disponible' : 'Inhabilitada' }}
                                </span>
                                <div class="text-xs sm:text-sm text-black font-mono text-center mt-2">Envíe pagos en
                                    cuestión de minutos.</div>
                            </div>
                        </a>
                    @else
                        <div class="bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 sm:p-6 md:p-8 flex flex-col items-center justify-center min-h-[140px] border border-[#e0e7ff] w-full transition hover:scale-105 cursor-pointer"
                            onclick="window.location='{{ route('cards.create') }}'">
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
                    @endif
                    <!-- Actividad reciente -->
                    <div
                        class="bg-white rounded-2xl shadow-[0_6px_24px_0_#2563eb50] p-4 sm:p-6 md:p-8 min-h-[170px] flex flex-col border border-[#e0e7ff] w-full">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="font-extrabold text-lg sm:text-xl md:text-2xl font-mono text-black">
                                    Actividad reciente
                                </div>
                                <a href="{{ route('transactions.index') }}"
                                    class="text-[#2563eb] font-mono text-xs sm:text-sm hover:underline">
                                    Mostrar todos
                                </a>
                            </div>
                            @if ($transactions->count())
                                <ul>
                                    @foreach ($transactions as $transaction)
                                        <li class="mb-4">
                                            <div
                                                class="flex items-center gap-3 bg-[#ede8f6] border border-[#d1d5db] rounded-2xl px-6 py-4 shadow-[0_4px_24px_0_rgba(37,99,235,0.15)] hover:shadow-[0_8px_32px_0_rgba(37,99,235,0.18)] transition-shadow duration-200">
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#2563eb] shadow-lg">
                                                        <svg class="w-6 h-6 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <div
                                                            class="font-extrabold font-mono uppercase text-sm sm:text-base text-black tracking-wide">
                                                            @if ($transaction->sender_id === auth()->id())
                                                                {{ $transaction->receiver ? $transaction->receiver->name . ' ' . $transaction->receiver->lastname : 'Usuario #' . $transaction->receiver_id }}
                                                            @else
                                                                {{ $transaction->sender ? $transaction->sender->name . ' ' . $transaction->sender->lastname : 'Usuario #' . $transaction->sender_id }}
                                                            @endif
                                                        </div>
                                                        <div
                                                            class="font-mono font-bold text-base sm:text-lg {{ $transaction->sender_id === auth()->id() ? 'text-red-500' : 'text-green-600' }}">
                                                            @if ($transaction->sender_id === auth()->id())
                                                                -{{ $transaction->currency }}.{{ number_format($transaction->amount, 2) }}
                                                            @else
                                                                +{{ $transaction->receiver_currency }}.{{ number_format($transaction->converted_amount, 2) }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-xs text-gray-600 font-mono mt-1">
                                                        {{ $transaction->created_at->format('d M') }}.
                                                        @if ($transaction->sender_id === auth()->id())
                                                            Pago enviado
                                                        @else
                                                            Pago recibido
                                                        @endif
                                                        <br>
                                                        @if (!empty($transaction->reason))
                                                            <span
                                                                class="text-gray-500">"{{ $transaction->reason }}"</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-xs sm:text-sm text-black font-mono mb-4 leading-tight">
                                    Consulte el dinero enviado y recibido. Aquí encontrará sus movimientos recientes con
                                    QuickPay
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Contactos frecuentes -->
                    <div
                        class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 sm:p-6 md:p-8 min-h-[170px] flex flex-col border border-[#e0e7ff] w-full">
                        <div class="flex items-center justify-between mb-4">
                            <div class="font-extrabold text-lg sm:text-xl md:text-2xl font-mono text-black">
                                Contactos frecuentes
                            </div>
                            <a href="{{ route('transactions.contacts.select') }}"
                                class="text-[#2563eb] font-mono text-xs sm:text-sm hover:underline">
                                Ver todos
                            </a>
                        </div>

                        @if ($frequentContacts->count())
                            <div class="space-y-3">
                                @foreach ($frequentContacts as $contact)
                                    <div class="bg-[#ede8f6] rounded-lg p-3 hover:bg-[#e0e6ff] transition">
                                        <div class="flex items-center justify-between">
                                            <!-- Información del contacto a la izquierda -->
                                            <div class="flex items-center gap-3 flex-1">
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#2563eb] text-white text-sm font-bold">
                                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="font-mono font-bold text-sm text-black">
                                                        {{ $contact->name }} {{ $contact->lastname }}
                                                    </div>
                                                    <div class="font-mono text-xs text-gray-500">
                                                        {{ $contact->transaction_count }}
                                                        {{ $contact->transaction_count == 1 ? 'transacción' : 'transacciones' }}
                                                        •
                                                        {{ \Carbon\Carbon::parse($contact->last_transaction)->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Botones a la derecha -->
                                            <div class="flex gap-1 ml-3">
                                                <button onclick="sendToContact('{{ $contact->email }}')"
                                                    class="flex items-center justify-center gap-1 bg-[#2563eb] text-white font-bold rounded-md px-2 py-1.5 font-mono text-xs hover:bg-[#1d4ed8] transition"
                                                    title="Enviar dinero">
                                                    <span class="font-extrabold text-xs">Enviar</span>
                                                </button>
                                                <button onclick="requestFromContact('{{ $contact->email }}')"
                                                    class="flex items-center justify-center gap-1 bg-white text-[#2563eb] font-bold rounded-md px-2 py-1.5 font-mono text-xs border border-[#2563eb] hover:bg-[#f0f4ff] transition"
                                                    title="Solicitar dinero">
                                                    <span class="font-extrabold text-xs">Solicitar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Formulario oculto para enviar dinero -->
                            <form id="sendToContactForm" method="POST"
                                action="{{ route('transactions.send.step2') }}" style="display: none;">
                                @csrf
                                <input type="hidden" name="type" value="send">
                                <input type="hidden" name="receiver" id="contactEmailSend">
                            </form>

                            <!-- Formulario oculto para solicitar dinero -->
                            <form id="requestFromContactForm" method="POST"
                                action="{{ route('transactions.request.step2') }}" style="display: none;">
                                @csrf
                                <input type="hidden" name="type" value="request">
                                <input type="hidden" name="receiver" id="contactEmailRequest">
                            </form>
                        @else
                            <div class="text-center py-6">
                                <div class="text-gray-400 font-mono text-sm mb-2">No tienes contactos frecuentes aún
                                </div>
                                <a href="{{ route('transactions.send.step1') }}"
                                    class="text-[#2563eb] font-mono text-xs hover:underline">
                                    Envia tu primer pago
                                </a>
                            </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        function sendToContact(email) {
            document.getElementById('contactEmailSend').value = email;
            document.getElementById('sendToContactForm').submit();
        }

        function requestFromContact(email) {
            document.getElementById('contactEmailRequest').value = email;
            document.getElementById('requestFromContactForm').submit();
        }
    </script>
</x-app-layout>
