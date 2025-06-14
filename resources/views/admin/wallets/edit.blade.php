<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-md mx-auto px-2 sm:px-4 pt-8">
                    <!-- Título y volver -->
                    <div class="flex items-center mb-6 gap-2">
                        <h1 class="text-xl font-extrabold text-[#284494] font-mono ml-2">Editar saldo de Wallet</h1>
                    </div>

                    <!-- Mensajes de error -->
                    <x-alert-errors />

                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] p-6">
                        <form method="POST" action="{{ route('admin.wallets.update', $wallet) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Usuario</label>
                                <input type="text" value="{{ $wallet->user->name }} {{ $wallet->user->lastname }}" disabled
                                    class="w-full rounded-lg border border-gray-200 bg-gray-100 py-2 px-3 font-mono text-xs" />
                            </div>
                            <div class="mb-4">
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Saldo</label>
                                <input type="number" name="balance" value="{{ old('balance', $wallet->balance) }}" step="0.01" min="0"
                                    class="w-full rounded-lg border border-[#c7d2fe] py-2 px-3 font-mono text-xs focus:ring-2 focus:ring-blue-300 transition" required />
                                @error('balance')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Divisa</label>
                                <select name="currency" class="w-full rounded-lg border border-[#c7d2fe] py-2 px-3 font-mono text-xs focus:ring-2 focus:ring-blue-300 transition" required>
                                    <option value="PEN" {{ old('currency', $wallet->currency) == 'PEN' ? 'selected' : '' }}>PEN (Soles)</option>
                                    <option value="USD" {{ old('currency', $wallet->currency) == 'USD' ? 'selected' : '' }}>USD (Dólares)</option>
                                    <option value="MXN" {{ old('currency', $wallet->currency) == 'MXN' ? 'selected' : '' }}>MXN (Pesos)</option>
                                    <!-- Agrega más monedas si tu app lo permite -->
                                </select>
                                @error('currency')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex justify-end gap-2 pt-2">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-full bg-[#2563eb] hover:bg-[#284494] text-white font-bold py-2 px-6 font-mono text-sm transition shadow">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Actualizar saldo
                                </button>
                                <a href="{{ route('admin.wallets.index') }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-gray-200 hover:bg-gray-300 text-[#2563eb] font-bold py-2 px-6 font-mono text-sm transition shadow justify-center w-full sm:w-auto">
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