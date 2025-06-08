<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <!-- Tabs Enviar/Solicitar arriba y separadas -->
        <div class="w-full bg-[#D9D9D9] border-b-2 border-gray-300">
            <div class="max-w-2xl mx-auto flex flex-col sm:flex-row">
                <a href="#"
                    class="font-mono text-lg font-extrabold text-black px-4 py-2 border-b-4 border-black focus:outline-none text-center">Enviar</a>
                <a href="#" class="font-mono text-base text-gray-600 px-4 py-2 sm:ml-2 text-center">Solicitar</a>
            </div>
        </div>
        <!-- Formulario centrado más abajo -->
        <div class="w-full flex justify-center">
            <div class="w-full max-w-2xl px-2 sm:px-4 pt-16 sm:pt-20">
                <form method="POST" action="{{ route('transactions.send.step2') }}">
                    @csrf
                    <input type="hidden" name="type"
                        value="send"><!-- Campo oculto para el tipo de transacción -->
                    <h2 class="text-2xl sm:text-3xl font-mono font-extrabold text-black mb-6 ">Enviar dinero</h2>
                    <div class="mb-8">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                            </span>
                            <input type="text" id="receiver" name="receiver"
                                class="w-full pl-12 pr-4 py-4 border-2 border-[#bcb7c2] rounded-2xl bg-[#ece9f1] font-mono text-base focus:outline-none focus:ring-2 focus:ring-[#2563eb] placeholder:font-mono placeholder:text-gray-400"
                                placeholder="Nombre, usuario, correo electrónico" required>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <button type="submit"
                            class="w-full sm:w-auto bg-[#2563eb] hover:bg-[#284494] text-white font-mono font-extrabold text-lg py-2 px-8 rounded-xl transition shadow text-center">
                            Siguiente
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="text-[#2563eb] font-mono underline text-base text-center w-full sm:w-auto">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
