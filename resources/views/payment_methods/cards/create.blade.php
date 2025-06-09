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
            <h2 class="text-2xl font-extrabold text-center mb-8 font-mono">Asociar una tarjeta</h2>
            <form method="POST" action="{{ route('cards.store') }}" class="space-y-4">
                @csrf
                <!-- Número de tarjeta -->
                <input type="text" name="card_number" placeholder="Número de tarjeta"
                    class="w-full rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required maxlength="19" value="{{ old('card_number') }}" inputmode="numeric" pattern="\d*"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                @error('card_number')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror


                <!-- Fecha de vencimiento y código de seguridad en la misma fila -->
                <div class="flex gap-2">
                    <input type="text" name="expiry_month" placeholder="MM/AA"
                        class="w-1/2 rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        required maxlength="5" value="{{ old('expiry_month') }}" pattern="^(0[1-9]|1[0-2])\/\d{2}$"
                        oninput="this.value = this.value.replace(/[^0-9\/]/g, '').replace(/(\..*)\./g, '$1').slice(0,5);">
                    <input type="text" name="cvv" placeholder="Código de segur..."
                        class="w-1/2 rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        required maxlength="4" value="{{ old('cvv') }}" inputmode="numeric" pattern="\d*"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                @error('cvv')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Nombre del titular -->
                <input type="text" name="card_holder" placeholder="Nombre del titular"
                    class="w-full rounded-md border-2 border-gray-300 px-4 py-3 font-mono text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required value="{{ old('card_holder') }}">
                @error('card_holder')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Botón -->
                <button type="submit"
                    class="w-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3 rounded-full font-mono text-lg transition">
                    Asociar Tarjeta
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
