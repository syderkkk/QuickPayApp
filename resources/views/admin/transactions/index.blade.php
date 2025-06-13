<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <!-- Sidebar personalizado -->
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            <x-admin-header />

            <main class="h-full overflow-y-auto">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <h2
                        class="mb-6 text-2xl font-extrabold text-[#284494] tracking-tight text-center drop-shadow-[0_6px_6px_rgba(37,99,235,0.10)]">
                        Transacciones
                    </h2>
                    <form method="GET" class="mb-4 flex gap-2">
                        <input type="text" name="search" placeholder="Buscar motivo..." value="{{ request('search') }}"
                            class="border rounded px-2 py-1">
                        <select name="status" class="border rounded px-2 py-1">
                            <option value="">Estado</option>
                            <option value="pending" @selected(request('status') == 'pending')>Pendiente</option>
                            <option value="completed" @selected(request('status') == 'completed')>Aprobada</option>
                            <option value="failed" @selected(request('status') == 'failed')>Rechazada</option>
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Filtrar</button>
                    </form>
                    <div
                        class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-4 border border-[#e0e7ff] overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr
                                    class="text-xs font-bold tracking-wide text-left text-[#284494] uppercase border-b bg-[#ede8f6]">
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Enviado por</th>
                                    <th class="px-4 py-2">Recibido por</th>
                                    <th class="px-4 py-2">Monto</th>
                                    <th class="px-4 py-2">Motivo</th>
                                    <th class="px-4 py-2">Estado</th>
                                    <th class="px-4 py-2">Fecha</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $transaction->id }}</td>
                                        <td class="border px-4 py-2">{{ $transaction->sender->name ?? '-' }}</td>
                                        <td class="border px-4 py-2">{{ $transaction->receiver->name ?? '-' }}</td>
                                        <td class="border px-4 py-2">S/. {{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $transaction->reason }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst(__($transaction->status)) }}</td>
                                        <td class="border px-4 py-2">{{ $transaction->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('admin.transactions.show', $transaction) }}"
                                                class="text-blue-600 underline">Ver</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">No hay transacciones.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
