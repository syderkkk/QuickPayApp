<x-app-layout>
    @include('layouts.navigation')
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <form method="POST" action="{{ route('refunds.store', $transaction->id) }}" class="bg-[#f6fafd] border border-gray-300 rounded-2xl shadow-md p-8 w-full max-w-md flex flex-col gap-4">
            @csrf
            <h1 class="text-2xl font-black font-mono text-center mb-1">Solicitar reembolso</h1>
            <p class="text-center font-mono text-gray-500 text-sm mb-4">Completa los datos para solicitar el reembolso de tu transacción.</p>

            <!-- ID de transacción -->
            <label class="font-bold font-mono text-gray-700 text-sm" for="transaction_id">ID de transacción</label>
            <input id="transaction_id" type="text" value="{{ $transaction->custom_id }}" readonly class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 font-mono text-lg text-gray-700 mb-2" />

            <!-- Monto -->
            <label class="font-bold font-mono text-gray-700 text-sm" for="amount">Monto</label>
            <input id="amount" type="text" value="{{ $transaction->currency }} {{ number_format($transaction->amount, 2) }}" readonly class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 font-mono text-2xl text-gray-700 mb-2" />

            <!-- Motivo de reembolso -->
            <label class="font-bold font-mono text-gray-700 text-sm" for="reason_type">Motivo de reembolso</label>
            <select id="reason_type" name="reason_type" required class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 font-mono text-base text-gray-700 mb-2">
                <option value="" disabled selected>Selecciona un motivo</option>
                <option value="no_recibido">Producto/servicio no recibido</option>
                <option value="error_monto">Error en el monto</option>
                <option value="no_reconozco">No reconozco esta transacción</option>
                <option value="otro">Otro</option>
            </select>

            <!-- Descripción -->
            <label class="font-bold font-mono text-gray-700 text-sm" for="description">Descripción</label>
            <textarea id="description" name="description" rows="4" placeholder="Agrega detalles" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 font-mono text-base text-gray-700 mb-2 resize-none"></textarea>

            <!-- Botón Solicitar reembolso -->
            <button type="submit" class="w-full bg-[#1976ed] hover:bg-[#125bb5] text-white font-mono font-black text-lg rounded-full py-2 mt-2 transition">Solicitar reembolso</button>

            <!-- Botón Cancelar -->
            <a href="{{ route('transactions.index') }}" class="w-full block text-center font-mono border border-gray-400 rounded-full py-2 mt-1 font-black text-lg text-gray-700 bg-white hover:bg-gray-100 transition">Cancelar</a>

            <div class="text-center mt-2 text-xs font-mono text-gray-400">
                ¿Tienes dudas? <a href="#" class="text-[#1976ed] underline">Contacta soporte</a>
            </div>
        </form>
    </div>
</x-app-layout> 