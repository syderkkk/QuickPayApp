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
            <form class="w-full flex flex-col gap-4 text-[13px] text-[#4a4a4a]">
                <input class="w-full rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Nombre del banco" type="text"/>
                <input class="w-full rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Código SWIFT" type="text"/>
                <div>
                <p class="font-bold mb-1 text-[13px] text-black">
                Tipo de cuenta
                </p>
                <label class="inline-flex items-center text-[11px] mb-1 cursor-pointer">
                <input checked="" class="form-radio text-blue-600" name="tipoCuenta" type="radio" value="corriente"/>
                <span class="ml-2">
                Cuenta corriente
                </span>
                </label>
                <label class="inline-flex items-center text-[11px] cursor-pointer">
                <input class="form-radio text-blue-600" name="tipoCuenta" type="radio" value="ahorros"/>
                <span class="ml-2">
                de ahorros
                </span>
                </label>
                </div>
                <input class="w-full rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Número de cuenta" type="text"/>
                <p class="text-[9px] mb-2">
                Elija la divisa en la que desea recibir pagos al transferir de PayPal a su cuenta bancaria.
                </p>
                <div>
                <p class="font-bold mb-1 text-[13px] text-black">
                Divisa
                </p>
                <label class="inline-flex items-center text-[11px] mb-1 cursor-pointer">
                <input checked="" class="form-radio text-blue-600" name="divisa" type="radio" value="sol"/>
                <span class="ml-2">
                Nuevo sol peruano
                </span>
                </label>
                <label class="inline-flex items-center text-[11px] cursor-pointer">
                <input checked="" class="form-radio text-blue-600" name="divisa" type="radio" value="dolar"/>
                <span class="ml-2">
                Dólar estadounidense
                </span>
                </label>
                </div>
                <input class="w-full rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Documento de identidad" type="text"/>
                <input class="w-full rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Número de teléfono" type="text"/>
                <input class="w-full rounded border border-gray-400 bg-[#f0f4fa] px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Dirección de facturación" type="text"/>
                <button class="mt-4 bg-blue-600 text-white font-extrabold text-sm rounded-full py-2 px-6 w-max mx-auto" type="submit">
                Asociar cuenta
                </button>
            </form>
        </div>
    </div>
</x-app-layout>