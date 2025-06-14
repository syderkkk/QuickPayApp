<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <!-- Botón volver -->
            <div class="flex items-center justify-between px-6 py-6 bg-[#F0F4F4] sticky top-0 z-10">
                <h2 class="text-2xl font-extrabold text-[#284494]">Últimos movimientos</h2>
                <x-admin-back-button href="{{ route('admin.users.show', $user) }} " />
            </div>

            <main class="h-full overflow-y-auto">
                <div class="max-w-4xl mx-auto px-4 py-8">
                    <h2
                        class="mb-6 text-2xl font-extrabold text-[#284494] text-center drop-shadow-[0_6px_6px_rgba(37,99,235,0.10)]">
                        Últimos movimientos de {{ $user->name }} {{ $user->lastname }}
                    </h2>
                    @if ($transactions->isEmpty())
                        <div class="text-center text-gray-400 py-8 font-mono">No tiene movimientos registrados.</div>
                    @else
                        <div class="flex flex-col gap-4">
                            @foreach ($transactions as $transaction)
                                <div
                                    class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff] p-4 flex flex-col sm:flex-row items-center gap-4 hover:scale-[1.01] transition">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="bg-[#2563eb] rounded-full w-12 h-12 flex items-center justify-center text-white text-2xl font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                            <div class="font-bold text-base sm:text-lg font-mono text-[#222]">
                                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                                            </div>
                                            <div>
                                                @if ($transaction->sender_id == $user->id)
                                                    <span
                                                        class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 font-bold text-xs">Enviado</span>
                                                @else
                                                    <span
                                                        class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold text-xs">Recibido</span>
                                                @endif
                                            </div>
                                            <div class="font-mono text-xs text-gray-500">
                                                {{ $transaction->reason ?? '' }}
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mt-1">
                                            <div class="font-mono text-base text-[#2563eb] font-extrabold">
                                                {{ $transaction->currency ?? 'S/.' }}
                                                {{ number_format($transaction->amount, 2) }}
                                            </div>
                                            <div class="font-mono text-xs text-gray-500">
                                                @if ($transaction->sender_id == $user->id)
                                                    Para: <span
                                                        class="font-bold text-[#284494]">{{ optional($transaction->receiver)->name ?? '-' }}</span>
                                                @else
                                                    De: <span
                                                        class="font-bold text-[#284494]">{{ optional($transaction->sender)->name ?? '-' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Paginación -->
                        <x-admin-pagination :paginator="$transactions" />
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
