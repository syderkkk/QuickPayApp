<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <!-- Sidebar personalizado -->
        <x-admin-sidebar />

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            <x-admin-header />

            <main class="h-full overflow-y-auto">
                <div class="max-w-2xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <h2
                        class="mb-6 text-2xl font-extrabold text-[#284494] tracking-tight text-center drop-shadow-[0_6px_6px_rgba(37,99,235,0.10)]">
                        Detalle de Transacción
                    </h2>
                    <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-6 border border-[#e0e7ff]">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="font-semibold">ID</dt>
                                <dd>{{ $transaction->id }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Enviado por</dt>
                                <dd>{{ $transaction->sender->name ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Recibido por</dt>
                                <dd>{{ $transaction->receiver->name ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Monto</dt>
                                <dd>S/. {{ number_format($transaction->amount, 2) }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Estado</dt>
                                <dd>{{ ucfirst(__($transaction->status)) }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Motivo</dt>
                                <dd>{{ $transaction->reason }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Fecha</dt>
                                <dd>{{ $transaction->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                        <div class="mt-6 text-center">
                            <a href="{{ route('admin.transactions.index') }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded">Volver</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
