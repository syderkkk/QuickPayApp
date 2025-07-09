<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-4xl mx-auto px-2 sm:px-4 pt-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Detalle de Notificación</h2>
                        <x-admin-back-button href="{{ route('admin.notifications.index') }}" />
                    </div>

                    <!-- Card principal -->
                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] overflow-hidden">
                        <!-- Header de la card -->
                        <div class="bg-gradient-to-r from-[#284494] to-[#2563eb] px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold text-white">{{ $notification->title }}</h3>
                                <div class="flex items-center gap-3">
                                    @php
                                        $typeColors = [
                                            'system' => 'bg-purple-100 text-purple-700',
                                            'payment' => 'bg-green-100 text-green-700',
                                            'request' => 'bg-blue-100 text-blue-700',
                                            'refund' => 'bg-orange-100 text-orange-700',
                                        ];
                                        $typeLabels = [
                                            'system' => 'Sistema',
                                            'payment' => 'Pago',
                                            'request' => 'Solicitud',
                                            'refund' => 'Reembolso',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-bold {{ $typeColors[$notification->type] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $typeLabels[$notification->type] ?? ucfirst($notification->type) }}
                                    </span>
                                    <span
                                        class="px-3 py-1 rounded-full text-sm font-bold {{ $notification->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $notification->is_active ? 'Activa' : 'Inactiva' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-6 space-y-6">
                            <!-- Información del destinatario -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-blue-100 rounded-full p-2">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <h4 class="font-bold text-blue-800">Destinatario</h4>
                                    </div>
                                    @if ($notification->user)
                                        <div class="font-mono text-sm text-blue-700">
                                            <div class="font-bold">{{ $notification->user->name }}
                                                {{ $notification->user->lastname }}</div>
                                            <div class="text-blue-600">{{ $notification->user->email }}</div>
                                            <div class="text-blue-500 capitalize">Rol: {{ $notification->user->role }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-gray-500 italic font-mono text-sm">Usuario eliminado</div>
                                    @endif
                                </div>

                                <!-- Información de fecha -->
                                <div
                                    class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-200">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="bg-green-100 rounded-full p-2">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <h4 class="font-bold text-green-800">Información Temporal</h4>
                                    </div>
                                    <div class="font-mono text-sm text-green-700 space-y-1">
                                        <div><span class="font-bold">Creada:</span>
                                            {{ $notification->created_at->format('d/m/Y H:i:s') }}</div>
                                        <div><span class="font-bold">Actualizada:</span>
                                            {{ $notification->updated_at->format('d/m/Y H:i:s') }}</div>
                                        <div><span class="font-bold">Hace:</span>
                                            {{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mensaje -->
                            <div
                                class="bg-gradient-to-br from-gray-50 to-slate-50 rounded-xl p-6 border border-gray-200">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-gray-100 rounded-full p-2">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-gray-800">Mensaje</h4>
                                </div>
                                <div
                                    class="bg-white rounded-lg p-4 border border-gray-200 font-mono text-sm text-gray-700 leading-relaxed">
                                    {{ $notification->message }}
                                </div>
                            </div>

                            <!-- Datos adicionales (si existen) -->
                            @if ($notification->data)
                                <div
                                    class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-6 border border-yellow-200">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="bg-yellow-100 rounded-full p-2">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h4 class="font-bold text-yellow-800">Datos Adicionales</h4>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-yellow-200">
                                        <pre class="font-mono text-sm text-yellow-700 whitespace-pre-wrap">{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Acciones -->
                        <div class="bg-gray-50 px-6 py-4 border-t">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600 font-mono">
                                    ID: {{ $notification->id }}
                                </div>
                                <div class="flex items-center gap-3">
                                    <!-- Toggle Estado -->
                                    <form action="{{ route('admin.notifications.updateStatus', $notification) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg {{ $notification->is_active ? 'bg-yellow-500 hover:bg-yellow-600 text-white' : 'bg-green-500 hover:bg-green-600 text-white' }} font-bold text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                @if ($notification->is_active)
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                @endif
                                            </svg>
                                            {{ $notification->is_active ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>

                                    <!-- Eliminar -->
                                    <form action="{{ route('admin.notifications.destroy', $notification) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta notificación?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-bold text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
