<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">


            <main class="h-full overflow-y-auto">


                <div class="max-w-4xl mx-auto px-4 py-8">
                    <x-admin-back-button title="Métodos de pago de {{ $user->name }} {{ $user->lastname }}" href="{{ route('admin.users.show', $user) }} " />

                    @if (($methods ?? collect())->isEmpty())
                        <div class="text-center text-gray-400 py-8 font-mono">No tiene métodos de pago registrados.
                        </div>
                    @else
                        <div class="grid gap-6 sm:grid-cols-2">
                            @foreach ($methods as $method)
                                <div
                                    class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff] p-6 flex flex-col gap-2 transition hover:scale-[1.02]">
                                    <div class="flex items-center gap-3 mb-2">
                                        @if ($method->type == 'card')
                                            <span
                                                class="bg-[#2563eb] rounded-full w-12 h-12 flex items-center justify-center text-white text-2xl font-bold shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <rect x="2" y="7" width="20" height="10" rx="2"
                                                        fill="#2563eb" />
                                                    <rect x="2" y="10" width="20" height="2" fill="#fff" />
                                                </svg>
                                            </span>
                                        @else
                                            <span
                                                class="bg-[#ede8f6] rounded-full w-12 h-12 flex items-center justify-center text-[#2563eb] text-2xl font-bold shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                                </svg>
                                            </span>
                                        @endif
                                        <div>
                                            <div class="font-bold text-[#2563eb] text-lg">
                                                {{ $method->type == 'card' ? 'Tarjeta' : 'Banco' }}
                                            </div>
                                            <div class="text-xs text-gray-500 font-mono">
                                                {{ $method->type == 'card' ? 'Débito/Crédito' : 'Cuenta bancaria' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-1 mt-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-500 font-semibold">Titular:</span>
                                            <span class="font-mono text-base text-gray-800">
                                                {{ $method->type == 'card' ? $method->card_holder ?? '-' : $method->bank_name ?? '-' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-gray-500 font-semibold">Número:</span>
                                            <span class="font-mono text-base text-gray-800">
                                                {{ $method->type == 'card' ? '**** **** **** ' . ($method->last_four ?? '') : $method->account_number ?? '-' }}
                                            </span>
                                        </div>
                                        @if ($method->type == 'card' && !empty($method->brand))
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-gray-500 font-semibold">Marca:</span>
                                                <span
                                                    class="font-mono text-base text-gray-800 uppercase">{{ $method->brand }}</span>
                                            </div>
                                        @endif
                                        @if ($method->type == 'bank')
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-gray-500 font-semibold">Tipo de cuenta:</span>
                                                <span
                                                    class="font-mono text-base text-gray-800">{{ $method->account_type ?? '-' }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs text-gray-500 font-semibold">Divisa:</span>
                                                <span
                                                    class="font-mono text-base text-gray-800">{{ $method->currency ?? '-' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
