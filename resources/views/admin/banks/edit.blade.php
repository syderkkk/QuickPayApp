<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-2xl mx-auto px-2 sm:px-4 pt-8">
                    <h2 class="text-2xl font-extrabold text-[#284494] font-mono mb-6 text-center">Editar cuenta bancaria
                    </h2>
                    <form method="POST" action="{{ route('admin.banks.update', $bank) }}"
                        class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] p-6 sm:p-8">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Usuario</label>
                                <input type="text" value="{{ $bank->user->name }} {{ $bank->user->lastname }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Correo</label>
                                <input type="text" value="{{ $bank->user->email }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Banco</label>
                                <input type="text" value="{{ $bank->bank_name }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Número de cuenta</label>
                                <input type="text" value="{{ $bank->account_number }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Tipo de cuenta</label>
                                <input type="text" value="{{ $bank->account_type }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Divisa</label>
                                <input type="text" value="{{ $bank->currency }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Código SWIFT</label>
                                <input type="text" value="{{ $bank->swift_code }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Documento de
                                    identidad</label>
                                <input type="text" value="{{ $bank->document_number }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Teléfono</label>
                                <input type="text" value="{{ $bank->phone }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Dirección de
                                    facturación</label>
                                <input type="text" value="{{ $bank->billing_address }}"
                                    class="w-full border rounded-lg px-3 py-1.5 bg-gray-100 font-mono text-xs" disabled>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Estado</label>
                                <select name="is_enabled" class="w-full border rounded-lg px-3 py-1.5 font-mono text-xs"
                                    required>
                                    <option value="1" @if ($bank->is_enabled) selected @endif>Habilitada
                                    </option>
                                    <option value="0" @if (!$bank->is_enabled) selected @endif>
                                        Inhabilitada</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3 mt-8 justify-end">
                            <a href="{{ route('admin.banks.index') }}"
                                class="inline-flex items-center gap-2 rounded-full bg-gray-200 hover:bg-gray-300 text-[#2563eb] font-bold py-1.5 px-6 font-mono text-sm transition shadow justify-center w-full sm:w-auto">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 rounded-full bg-[#2563eb] hover:bg-[#284494] text-white font-bold py-1.5 px-6 font-mono text-sm transition shadow justify-center w-full sm:w-auto">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
