<x-app-layout>
    <div class="flex min-h-screen bg-[#f4f8fb] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-2xl mx-auto px-2 sm:px-4 pt-8">
                    <!-- Título y volver -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] tracking-tight text-center font-mono drop-shadow-[0_6px_6px_rgba(37,99,235,0.10)]">
                            Detalle de Reembolso
                        </h2>
                        <x-admin-back-button href="{{ route('admin.refunds.index') }} " />
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Solicitado por</div>
                                <div class="font-bold text-gray-800">{{ $refund->transaction->sender->name ?? '-' }} {{ $refund->transaction->sender->lastname ?? '' }}</div>
                                <div class="text-xs text-gray-500">{{ $refund->transaction->sender->email ?? '' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Recibido por</div>
                                <div class="font-bold text-gray-800">{{ $refund->transaction->receiver->name ?? '-' }} {{ $refund->transaction->receiver->lastname ?? '' }}</div>
                                <div class="text-xs text-gray-500">{{ $refund->transaction->receiver->email ?? '' }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Estado</div>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                    ];
                                    $statusTranslations = [
                                        'pending' => 'Pendiente',
                                        'rejected' => 'Rechazado',
                                        'completed' => 'Completado',
                                    ];
                                    $status = strtolower($refund->status);
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusTranslations[$status] ?? ucfirst($status) }}
                                </span>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Monto</div>
                                <div class="text-blue-900 font-extrabold text-xl font-mono">{{ $refund->currency ?? 'PEN' }} {{ number_format($refund->amount, 2) }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Fecha y hora</div>
                                <div class="font-mono text-gray-700">{{ $refund->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Motivo</div>
                                <div class="text-gray-800">{{ $refund->reason ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout> 