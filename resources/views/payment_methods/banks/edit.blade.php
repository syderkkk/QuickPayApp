<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-[#f0f4f8]">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md relative shadow-none border-0" style="box-shadow:none;">
            <!-- Boton cerrar -->
            <a href="{{ route('payment-methods.index') }}"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</a>
            <!-- Icono -->
            <div class="rounded-full bg-[#dde2ea] flex items-center justify-center mx-auto mb-4"
                style="width:60px; height:60px; box-shadow: 0 8px 32px 0 #083B7080;">
                <img src="{{ asset('bank.png') }}" alt="Tarjeta" class="w-14 h-14 select-none pointer-events-none"
                    draggable="false">
            </div>
            <h1 class="text-2x1 font-extrabold text-center mb-8 font-mono">
                Asociar una cuenta bancaria
            </h1>
            <!-- Verificar si hay errores -->
            <x-alert-errors />

            <!-- Formulario -->
            <form method="POST" action="{{ route('banks.update', $bank->id) }}"
                class="w-full flex flex-col gap-4 text-[13px] text-[#4a4a4a]">
                @csrf
                @method('PUT')
                <!-- Nombre del banco (solo lectura-->
                <input name="bank_name"
                    class="w-full cursor-not-allowed font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Nombre del banco" type="text" value="{{ old('bank_name', $bank->bank_name) }}"
                    readonly />

                <!-- Codigo swift (solo lectura)-->
                <input name="swift_code"
                    class="w-full cursor-not-allowed font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Código SWIFT" type="text" value="{{ old('swift_code', $bank->swift_code) }} "
                    readonly />

                <!-- Tipo de cuenta (solo lectura) -->
                <div class="w-full">
                    <h1 class="text-2x1 font-extrabold mb-2 font-mono text-black">Tipo de cuenta</h1>
                    <input type="text"
                        class="block w-full cursor-not-allowed rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm text-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                        value="{{ old('account_type', $bank->account_type) }}" readonly>
                </div>

                <!-- Numero de cuenta (solo lectura) -->
                <input name="account_number"
                    class="w-full font-mono cursor-not-allowed rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Número de cuenta" type="text"
                    value="{{ old('account_number', $bank->account_number) }}" readonly />

                <!-- Tipo de divisa (solo lectura) -->
                <div class="w-full">
                    <h1 class="text-2x1 font-extrabold mb-2 font-mono text-black">Divisa</h1>
                    <input type="text" name="currency" id="currency" value="{{ old('currency', $bank->currency) }}"
                        readonly
                        class="block w-full cursor-not-allowed rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm text-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]">
                </div>

                <!-- Documento de identidad (solo lectura) -->
                <input name="document_number"
                    class="w-full font-mono cursor-not-allowed rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Documento de identidad" type="text"
                    value="{{ old('document_number', $bank->document_number) }}" readonly />

                <!-- Numero de celular -->
                <input name="phone"
                    class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Número de teléfono" type="text" value="{{ old('phone', $bank->phone) }}" required />
                @error('phone')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Direccion de facturacion -->
                <input name="billing_address"
                    class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Dirección de facturación" type="text"
                    value="{{ old('billing_address', $bank->billing_address) }}" required />
                @error('billing_address')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Boton -->
                <button
                    class="mt-4 bg-blue-600 text-white font-extrabold text-sm rounded-full py-2 px-6 w-max mx-auto font-mono"
                    type="submit">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
