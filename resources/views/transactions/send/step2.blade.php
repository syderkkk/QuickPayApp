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
        
        <!-- Card principal centrada -->
        <div class="flex justify-center items-center w-full min-h-[70vh]">
            <div
                class="bg-[#ede8f6] border border-gray-400 rounded-2xl max-w-md w-full mx-2 p-4 sm:p-8 shadow flex flex-col items-center">
                <!-- Usuario receptor -->
                <div class="flex items-center gap-4 mb-6 w-full">
                    <div
                        class="bg-[#2563eb] rounded-full w-12 h-12 flex items-center justify-center text-white text-2xl font-bold shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="overflow-x-auto">
                        <div
                            class="font-mono font-extrabold text-lg sm:text-xl text-black leading-tight whitespace-nowrap">
                            {{ $receiver->name }} {{ $receiver->lastname }}
                        </div>
                        <div class="font-mono text-xs text-gray-500 break-all">{{ $receiver->email }}</div>
                    </div>
                </div>
                <!-- Formulario de envío -->
                <form class="w-full" method="POST" action="{{ route('transactions.send.confirm') }}">
                    @csrf
                    <input type="hidden" name="type" value="send">
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <div class="mb-4 flex flex-col sm:flex-row sm:items-center gap-2">
                        <label class="font-mono text-sm text-black min-w-max">Enviar desde:</label>
                        <select name="from_account"
                            class="flex-1 px-2 py-1 rounded border border-gray-300 font-mono text-xs bg-white focus:ring-2 focus:ring-[#2563eb]">
                            <option value="wallet">Saldo QuickPay({{ $wallet_currency }} {{ number_format($wallet_balance, 2) }})</option>
                            <!-- Otras opciones de cuentas si las hay -->
                        </select>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-2 mb-4 w-full">
                        <label class="font-mono text-xl font-extrabold text-black min-w-max">S/.</label>
                        <input type="number" step="0.01" min="0" value="10.00" name="amount"
                            class="w-full sm:w-32 px-3 py-1 border-2 border-[#bcb7c2] rounded-lg bg-white font-mono text-lg font-bold focus:outline-none focus:ring-2 focus:ring-[#2563eb] text-black"
                            required>
                        <div class="w-full sm:w-auto flex-shrink-0">
                            <select name="currency"
                                class="w-full sm:w-24 px-2 py-1 rounded border border-gray-300 font-mono text-base bg-white focus:ring-2 focus:ring-[#2563eb]">
                                <option value="PEN">PEN</option>
                                <!-- Otras monedas si las hay -->
                            </select>
                        </div>
                    </div>
                    <div class="mb-6">
                        <textarea name="reason" rows="2"
                            class="w-full border-2 border-[#bcb7c2] rounded-xl bg-[#f4f5f7] font-mono text-xs p-3 focus:outline-none focus:ring-2 focus:ring-[#2563eb] resize-none"
                            placeholder="¿Para qué es esto?"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-[#2563eb] hover:bg-[#284494] text-white font-mono font-extrabold text-lg py-2 rounded-xl transition shadow mb-2">
                        Enviar
                    </button>
                    <a href="{{ route('transactions.send.step1') }}"
                        class="block text-center text-[#2563eb] font-mono underline text-base">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
