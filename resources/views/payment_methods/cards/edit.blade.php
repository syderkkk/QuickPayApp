<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-[#f0f4f8]">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md relative shadow-none border-0" style="box-shadow:none;">
            <!-- Botón cerrar -->
            <a href="{{ route('payment-methods.index') }}"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</a>
            <!-- Icono -->
            <div class="rounded-full bg-[#dde2ea] flex items-center justify-center mx-auto mb-4"
                style="width:60px; height:60px; box-shadow: 0 8px 32px 0 #083B7080;">
                <img src="{{ asset('tarjeta.png') }}" alt="Tarjeta" class="w-14 h-14 select-none pointer-events-none"
                    draggable="false">
            </div>
            <h2 class="text-2xl font-extrabold text-center mb-8 font-mono">Editar tarjeta</h2>
            <form method="POST" action="{{ route('cards.update', $card->id) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <!-- Número de tarjeta (solo lectura) -->
                <input type="text" name="card_number" placeholder="Número de tarjeta"
                    class="w-full rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base bg-gray-100 text-gray-500 cursor-not-allowed"
                    value="{{ old('card_number', $card->card_number) }}" readonly>
                <!-- Fecha de vencimiento (solo lectura) -->
                <div class="flex gap-2">
                    <input type="text" name="expiry_month" placeholder="MM/AA"
                        class="w-1/2 rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base bg-gray-100 text-gray-500 cursor-not-allowed"
                        value="{{ old('expiry_month', $card->expiry_month . '/' . substr($card->expiry_year, 2)) }}" readonly>
                    <input type="text" name="cvv" placeholder="CVV"
                        class="w-1/2 rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base bg-gray-100 text-gray-500 cursor-not-allowed"
                        value="***" readonly>
                </div>
                <!-- Nombre del titular -->
                <input type="text" name="card_holder" placeholder="Nombre del titular"
                    class="w-full rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required value="{{ old('card_holder', $card->card_holder) }}">
                @error('card_holder')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror
                <!-- Sobrenombre -->
                <input type="text" name="nickname" placeholder="Sobrenombre (opcional)"
                    class="w-full rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    value="{{ old('nickname', $card->nickname ?? '') }}">
                @error('nickname')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror
                <!-- Botón -->
                <button type="submit"
                    class="w-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3 rounded-full font-mono text-lg transition">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
</x-app-layout>