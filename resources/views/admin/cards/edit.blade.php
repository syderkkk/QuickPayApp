<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-md mx-auto px-2 sm:px-4 pt-8">
                    <!-- Título -->
                    <div class="flex items-center mb-6 gap-2">
                        <h1 class="text-xl font-extrabold text-[#284494] font-mono ml-2">Editar tarjeta</h1>
                    </div>

                    <!-- Mensajes de éxito/error -->
                    <x-alert-succes />
                    <x-alert-errors />

                    <!-- Formulario de edición -->
                    <div class="bg-white rounded-2xl shadow-[0_4px_8px_0_#2563eb20] border border-[#e0e7ff] p-4">
                        <form method="POST" action="{{ route('admin.cards.update', $card->id) }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <label class="block font-bold mb-1 text-[#284494] text-xs">Usuario</label>
                                    <input type="text" value="{{ $card->user->name ?? '-' }}" disabled
                                        class="w-full rounded border border-gray-200 bg-gray-100 py-1.5 px-2 font-mono text-xs text-gray-500 cursor-not-allowed" />
                                </div>
                                <div>
                                    <label class="block font-bold mb-1 text-[#284494] text-xs">Número de tarjeta</label>
                                    <input type="text" value="**** **** **** {{ $card->last_four }}" disabled
                                        class="w-full rounded border border-gray-200 bg-gray-100 py-1.5 px-2 font-mono text-xs text-gray-500 cursor-not-allowed" />
                                </div>
                                <div>
                                    <label class="block font-bold mb-1 text-[#284494] text-xs">CVV</label>
                                    <input type="text" value="***" disabled
                                        class="w-full rounded border border-gray-200 bg-gray-100 py-1.5 px-2 font-mono text-xs text-gray-500 cursor-not-allowed" />
                                </div>
                                <div>
                                    <label class="block font-bold mb-1 text-[#284494] text-xs">Titular</label>
                                    <input type="text" name="card_holder" value="{{ old('card_holder', $card->card_holder) }}"
                                        class="w-full rounded border border-gray-200 bg-gray-100 py-1.5 px-2 font-mono text-xs text-gray-500 cursor-not-allowed"
                                        disabled />
                                </div>
                                <div>
                                    <label class="block font-bold mb-1 text-[#284494] text-xs">Sobrenombre</label>
                                    <input type="text" name="nickname" value="{{ old('nickname', $card->nickname) }}"
                                        class="w-full rounded border border-gray-200 bg-gray-100 py-1.5 px-2 font-mono text-xs text-gray-500 cursor-not-allowed"
                                        disabled />
                                </div>
                                <div>
                                    <label class="block font-bold mb-1 text-[#284494] text-xs">Estado de la tarjeta</label>
                                    <select name="status" class="w-full rounded border border-gray-300 bg-white py-1.5 px-2 font-mono text-xs focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition" required>
                                        <option value="enabled" {{ $card->status === 'enabled' || $card->status === 'habilitada' ? 'selected' : '' }}>Habilitada</option>
                                        <option value="disabled" {{ $card->status === 'disabled' || $card->status === 'inhabilitada' ? 'selected' : '' }}>Inhabilitada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2 justify-center pt-3 border-t border-[#e0e7ff] mt-4">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-1.5 px-6 font-mono text-sm transition shadow justify-center w-full sm:w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Guardar cambios
                                </button>
                                <a href="{{ route('admin.cards.index') }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-gray-200 hover:bg-gray-300 text-[#2563eb] font-bold py-1.5 px-6 font-mono text-sm transition shadow justify-center w-full sm:w-auto">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>