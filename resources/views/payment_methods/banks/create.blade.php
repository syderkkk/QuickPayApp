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
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm mb-4">
                    <strong class="font-bold">¡Error!</strong>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario -->
            <form method="POST" action="{{ route('banks.store')}}" class="w-full flex flex-col gap-4 text-[13px] text-[#4a4a4a]">
                @csrf
                <!-- Nombre del banco -->
                <input name="bank_name" class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    placeholder="Nombre del banco" type="text" required/>

                <!-- Codigo swift -->
                <input name="swift_code" class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    placeholder="Código SWIFT" type="text" maxlength="11" minlength="8" required/>
                @error('swift_code')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Tipo de cuenta -->
                <div class="w-full">
                    <h1 class="text-2x1 font-extrabold mb-2 font-mono text-black">Tipo de cuenta</h1>
                    <x-input-label for="account_type" :value="__('Tipo de cuenta')" class="sr-only" />
                    <select id="account_type" name="account_type" required
                        class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm text-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]">
                        <option value="" disabled {{ old('account_type') ? '' : 'selected' }}>Seleccione el tipo</option>
                        <option value="corriente" {{ old('account_type') == 'corriente' ? 'selected' : '' }}>Corriente</option>
                        <option value="ahorros" {{ old('account_type') == 'ahorros' ? 'selected' : '' }}>Ahorros</option>
                    </select>
                    <x-input-error :messages="$errors->get('account_type')" class="mt-1" />
                </div>

                <!-- Numero de cuenta -->
                <input name="account_number" class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    placeholder="Número de cuenta" type="text" maxlength="19" required/>
                @error('account_number')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Tipo de divisa -->
                <div class="w-full">
                    <p class="text-[10px] mb-2 font-mono">
                    Elija la divisa en la que desea recibir pagos al transferir de PayPal a su cuenta bancaria.
                    </p>
                    <h1 class="text-2x1 font-extrabold mb-2 font-mono text-black">Divisa</h1>
                    <x-input-label for="currency" :value="__('Divisa')" class="sr-only" />
                    <select name="currency" id="currency" required
                        class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm text-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]">
                        <option value="" disabled {{ old('currency') ? '' : 'selected' }}>Seleccione la divisa</option>
                        <option value="PEN" {{ old('currency') == 'soles' ? 'selected' : '' }}>Nuevo sol peruano</option>
                        <option value="USD" {{ old('currency') == 'dolares' ? 'selected' : '' }}>Dolar estadounidense</option>
                    </select>
                </div>

                <!-- Documento de identidad -->
                <input name="document_number" class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    placeholder="Documento de identidad" type="text" minlength="8" maxlength="8" required/>
                @error('document_number')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Numero de celular -->
                <input name="phone" class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    placeholder="Número de teléfono" type="text" required/>
                @error('phone')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Direccion de facturacion -->
                <input name="billing_address" class="w-full font-mono rounded border border-gray-400 bg-[#f0f4fa] px-4 py-3 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" 
                    placeholder="Dirección de facturación" type="text" required/>
                @error('billing_address')
                    <div class="text-red-500 text-xs">{{ $message }}</div>
                @enderror

                <!-- Boton -->
                <button class="mt-4 bg-blue-600 text-white font-extrabold text-sm rounded-full py-2 px-6 w-max mx-auto font-mono" type="submit">
                Asociar cuenta
                </button>
            </form>
        </div>
    </div>
</x-app-layout>