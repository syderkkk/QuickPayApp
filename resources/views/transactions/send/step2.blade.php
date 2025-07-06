<x-app-layout>
    @include('layouts.navigation')
    <x-tabs-transacciones activo="enviar" />
    <div class="bg-[#F0F4F4] min-h-screen py-1">

        <div class="flex justify-center items-start w-full px-2 mt-1">
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-lg border border-gray-200">
                <div class="p-3">
                    <x-step-error />

                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 rounded-xl p-2 mb-2 border border-slate-200">
                        <div class="flex items-center gap-2">
                            <div
                                class="bg-gradient-to-br from-[#2563eb] to-[#1d4ed8] rounded-full w-8 h-8 flex items-center justify-center text-white shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-mono font-bold text-xs text-gray-900">
                                    {{ $receiver->name }} {{ $receiver->lastname }}
                                </div>
                                <div class="font-mono text-xs text-gray-600">{{ $receiver->email }}</div>
                                <div class="flex items-center gap-1 mt-0.5">
                                    <div class="w-1 h-1 bg-green-500 rounded-full"></div>
                                    <span class="font-mono text-xs text-green-600">Verificado</span>
                                </div>
                            </div>
                            <div class="bg-[#2563eb] text-white px-2 py-0.5 rounded-md">
                                <span class="font-mono text-xs font-semibold">Destinatario</span>
                            </div>
                        </div>
                    </div>

                    @if (isset($currencies_different) && $currencies_different)
                        <div
                            class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-1.5 mb-2">
                            <div class="flex items-center gap-2">
                                <div class="bg-blue-100 rounded-full p-1">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-mono text-xs font-bold text-blue-800">Conversión automática</div>
                                    <div class="font-mono text-xs text-blue-600">
                                        {{ $wallet_currency }} → {{ $receiver_currency }} (1:{{ $exchange_rate ?? 1 }})
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="space-y-2" method="POST" action="{{ route('transactions.send.confirm') }}">
                        @csrf
                        <input type="hidden" name="type" value="send">
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                        <div class="space-y-0.5">
                            <label class="font-mono text-xs font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                Desde
                            </label>
                            <select name="from_account"
                                class="w-full px-2 py-1.5 bg-gray-50 border border-gray-200 rounded-lg font-mono text-xs focus:ring-2 focus:ring-[#2563eb] focus:border-transparent">
                                <option value="wallet">💳 Saldo QuickPay - {{ $wallet_currency }}
                                    {{ number_format($wallet_balance, 2) }}</option>
                            </select>
                        </div>

                        <div class="space-y-0.5">
                            <label class="font-mono text-xs font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                    </path>
                                </svg>
                                Monto
                            </label>
                            <div
                                class="bg-gradient-to-r from-gray-50 to-slate-50 border border-gray-200 rounded-lg p-1.5 focus-within:ring-2 focus-within:ring-[#2563eb] focus-within:border-transparent">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-base font-bold text-gray-700">
                                        @if ($wallet_currency === 'PEN')
                                            S/.
                                        @elseif($wallet_currency === 'USD')
                                            $
                                        @elseif($wallet_currency === 'ARS')
                                            $
                                        @elseif($wallet_currency === 'EUR')
                                            €
                                        @else
                                            {{ $wallet_currency }}
                                        @endif
                                    </span>
                                    <input type="number" step="0.01" min="0" value="10.00" name="amount"
                                        id="amount"
                                        class="flex-1 bg-transparent text-base font-bold font-mono text-gray-900 placeholder-gray-400 border-none outline-none focus:ring-0"
                                        placeholder="0.00" required>
                                    <div
                                        class="bg-[#2563eb] text-white px-2 py-0.5 rounded-md font-mono text-xs font-semibold">
                                        {{ $wallet_currency }}
                                    </div>
                                </div>
                            </div>
                            <div class="font-mono text-xs text-gray-500 px-1">
                                Disponible: {{ $wallet_currency }} {{ number_format($wallet_balance, 2) }}
                            </div>
                        </div>

                        <input type="hidden" name="currency" value="{{ $wallet_currency }}">

                        @error('amount')
                            <div class="bg-red-50 border border-red-200 rounded-lg p-1.5">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-mono text-xs text-red-600">{{ $message }}</span>
                                </div>
                            </div>
                        @enderror

                        @if (isset($currencies_different) && $currencies_different)
                            <div
                                class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-lg p-1.5">
                                <div class="flex items-center justify-between">
                                    <div class="text-center">
                                        <div class="font-mono text-xs text-emerald-600 mb-0.5">Envías</div>
                                        <div class="font-mono text-sm font-bold text-emerald-700" id="sendAmount">
                                            @if ($wallet_currency === 'PEN')
                                                S/.
                                            @elseif($wallet_currency === 'USD')
                                                $
                                            @elseif($wallet_currency === 'ARS')
                                                $
                                            @elseif($wallet_currency === 'EUR')
                                                €
                                            @else
                                                {{ $wallet_currency }}
                                            @endif
                                            10.00
                                        </div>
                                    </div>
                                    <div class="flex items-center px-1">
                                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-mono text-xs text-emerald-600 mb-0.5">Recibe</div>
                                        <div class="font-mono text-sm font-bold text-emerald-700">
                                            @if ($receiver_currency === 'PEN')
                                                S/.
                                            @elseif($receiver_currency === 'USD')
                                                $
                                            @elseif($receiver_currency === 'ARS')
                                                $
                                            @elseif($receiver_currency === 'EUR')
                                                €
                                            @else
                                                {{ $receiver_currency }}
                                            @endif
                                            <span id="convertedAmount">10.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="space-y-0.5">
                            <label class="font-mono text-xs font-semibold text-gray-700 flex items-center gap-1">
                                <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                                Nota (opcional)
                            </label>
                            <textarea name="reason" rows="2"
                                class="w-full px-2 py-1.5 bg-gray-50 border border-gray-200 rounded-lg font-mono text-xs focus:ring-2 focus:ring-[#2563eb] focus:border-transparent resize-none"
                                placeholder="Añade una descripción..."></textarea>
                        </div>

                        <div class="space-y-1.5 pt-1.5">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] hover:from-[#1d4ed8] hover:to-[#1e40af] text-white font-mono font-bold text-sm py-2 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.01] active:scale-[0.99]">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Enviar Ahora
                                </div>
                            </button>
                            <a href="{{ route('transactions.send.step1') }}"
                                class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-semibold py-1.5 rounded-lg transition-all duration-200 text-sm">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const convertedAmountDisplay = document.getElementById('convertedAmount');
            const sendAmountDisplay = document.getElementById('sendAmount');
            const exchangeRate = {{ $exchange_rate ?? 1 }};
            const currenciesDifferent =
                {{ isset($currencies_different) && $currencies_different ? 'true' : 'false' }};
            const maxAmount = {{ $wallet_balance }};
            const walletCurrency = '{{ $wallet_currency }}';
            const receiverCurrency = '{{ $receiver_currency }}';

            function getCurrencySymbol(currency) {
                switch (currency) {
                    case 'PEN':
                        return 'S/.';
                    case 'USD':
                        return '$';
                    case 'ARS':
                        return '$';
                    case 'EUR':
                        return '€';
                    default:
                        return currency + ' ';
                }
            }

            if (currenciesDifferent && convertedAmountDisplay) {
                function updateConversion() {
                    const amount = parseFloat(amountInput.value) || 0;
                    const convertedAmount = amount * exchangeRate;
                    convertedAmountDisplay.textContent = convertedAmount.toFixed(2);
                    if (sendAmountDisplay) {
                        sendAmountDisplay.innerHTML = getCurrencySymbol(walletCurrency) + amount.toFixed(2);
                    }
                }
                amountInput.addEventListener('input', updateConversion);
                if (amountInput.value) {
                    updateConversion();
                }
            }

            amountInput.addEventListener('input', function() {
                const amount = parseFloat(this.value) || 0;
                const inputContainer = this.closest('.bg-gradient-to-r');
                inputContainer.classList.remove('border-red-500', 'from-red-50', 'to-red-50',
                    'ring-red-500');
                inputContainer.classList.add('border-gray-200', 'from-gray-50', 'to-slate-50');
                if (amount > maxAmount) {
                    this.setCustomValidity('El monto no puede ser mayor a tu saldo disponible');
                    inputContainer.classList.remove('border-gray-200', 'from-gray-50', 'to-slate-50');
                    inputContainer.classList.add('border-red-500', 'from-red-50', 'to-red-50');
                } else if (amount <= 0) {
                    this.setCustomValidity('El monto debe ser mayor a 0');
                    inputContainer.classList.remove('border-gray-200', 'from-gray-50', 'to-slate-50');
                    inputContainer.classList.add('border-red-500', 'from-red-50', 'to-red-50');
                } else {
                    this.setCustomValidity('');
                }
            });

            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const amount = parseFloat(amountInput.value) || 0;
                    if (amount <= 0) {
                        e.preventDefault();
                        alert('El monto debe ser mayor a 0');
                        return;
                    }
                    if (amount > maxAmount) {
                        e.preventDefault();
                        alert('El monto no puede ser mayor a tu saldo disponible');
                        return;
                    }
                });
            }
        });
    </script>
</x-app-layout>
