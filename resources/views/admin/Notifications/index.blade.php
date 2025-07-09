<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-6xl mx-auto px-2 sm:px-4 pt-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Notificaciones del Sistema</h2>
                        <button onclick="openCreateModal()"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-blue-700 transition text-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Nueva Notificación
                        </button>
                    </div>

                    <x-alert />

                    <!-- Filtros -->
                    <div class="mb-6 rounded-xl p-4 border-[#e0e7ff]">
                        <form method="GET" class="flex flex-wrap items-center gap-4">
                            <!-- Búsqueda -->
                            <div class="relative flex-1 min-w-[200px]">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#2563eb]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                    </svg>
                                </span>
                                <input type="text" name="search"
                                    placeholder="Buscar por título, mensaje o usuario..."
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 w-full rounded-lg border border-[#c7d2fe] text-sm bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" />
                            </div>

                            <!-- Tipo -->
                            {{-- <select name="type" class="rounded-lg border border-[#c7d2fe] text-sm py-2 px-3 bg-white min-w-[120px]">
                                <option value="">Todos los tipos</option>
                                <option value="system" {{ request('type') == 'system' ? 'selected' : '' }}>Sistema</option>
                                <option value="payment" {{ request('type') == 'payment' ? 'selected' : '' }}>Pago</option>
                                <option value="request" {{ request('type') == 'request' ? 'selected' : '' }}>Solicitud</option>
                                <option value="refund" {{ request('type') == 'refund' ? 'selected' : '' }}>Reembolso</option>
                            </select> --}}

                            <!-- Estado -->
                            <select name="status"
                                class="rounded-lg border border-[#c7d2fe] text-sm py-2 px-3 bg-white min-w-[120px]">
                                <option value="">Estado</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Activa
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                    Inactiva</option>
                            </select>

                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition text-sm flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                                Buscar
                            </button>
                        </form>
                    </div>

                    <!-- Tabla de notificaciones -->
                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] overflow-x-auto">
                        <table class="w-full min-w-[800px] divide-y divide-[#e0e7ff] text-sm">
                            <thead>
                                <tr class="font-bold text-[#284494] uppercase bg-[#ede8f6]">
                                    <th class="px-4 py-3 text-left">Título</th>
                                    {{-- <th class="px-4 py-3 text-left">Usuario</th> --}}
                                    <th class="px-4 py-3 text-left">Tipo</th>
                                    <th class="px-4 py-3 text-left">Estado</th>
                                    <th class="px-4 py-3 text-left">Fecha</th>
                                    <th class="px-4 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e0e7ff]">
                                @forelse($notifications as $notification)
                                    <tr class="hover:bg-[#f5f7fa] transition">
                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-gray-800 mb-1">{{ $notification->title }}
                                            </div>
                                            <div class="text-xs text-gray-600 line-clamp-2">
                                                {{ Str::limit($notification->message, 80) }}</div>
                                        </td>
                                        {{-- <td class="px-4 py-3">
                                            @if ($notification->user)
                                                <div class="font-medium text-gray-800">{{ $notification->user->name }}
                                                </div>
                                                <div class="text-xs text-gray-600">{{ $notification->user->email }}
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Usuario eliminado</span>
                                            @endif
                                        </td> --}}
                                        <td class="px-4 py-3">
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
                                                class="inline-block px-2 py-1 rounded-full text-xs font-medium {{ $typeColors[$notification->type] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $typeLabels[$notification->type] ?? ucfirst($notification->type) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-block px-2 py-1 rounded-full text-xs font-bold {{ $notification->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $notification->is_active ? 'Activa' : 'Inactiva' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $notification->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-center gap-1">
                                                <!-- Ver -->
                                                {{-- <a href="{{ route('admin.notifications.show', $notification) }}" 
                                                   class="inline-flex items-center px-2 py-1 rounded bg-blue-100 text-blue-700 font-bold text-xs hover:bg-blue-200 transition" 
                                                   title="Ver detalles">
                                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    Ver
                                                </a> --}}

                                                <!-- Toggle Estado -->
                                                <form
                                                    action="{{ route('admin.notifications.updateStatus', $notification) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 rounded {{ $notification->is_active ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} font-bold text-xs transition"
                                                        title="{{ $notification->is_active ? 'Desactivar' : 'Activar' }}">
                                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor"
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
                                                <form
                                                    action="{{ route('admin.notifications.destroy', $notification) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('¿Eliminar esta notificación?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 rounded bg-red-100 text-red-700 font-bold text-xs hover:bg-red-200 transition"
                                                        title="Eliminar">
                                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-8 text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1"
                                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                                <p class="font-medium">No hay notificaciones</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <x-admin-pagination :paginator="$notifications" />
                </div>
            </main>
        </div>
    </div>

    <!-- Modal para crear notificación -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Nueva Notificación</h3>
                    <button onclick="closeCreateModal()" class="text-white hover:text-gray-200 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form action="{{ route('admin.notifications.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="type" value="system">
                <!-- Título -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Título *</label>
                    <input type="text" name="title" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Título de la notificación">
                </div>

                <!-- Mensaje -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Mensaje *</label>
                    <textarea name="message" required rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                        placeholder="Contenido del mensaje..."></textarea>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeCreateModal()"
                        class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition font-medium">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] text-white rounded-lg hover:from-[#1d4ed8] hover:to-[#1e40af] transition font-bold">
                        Crear Notificación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createModal').classList.add('flex');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.getElementById('createModal').classList.remove('flex');
            // Reset form
            document.querySelector('#createModal form').reset();
            document.getElementById('sendToAll').checked = false;
            toggleUserSelect();
        }

        function toggleUserSelect() {
            const checkbox = document.getElementById('sendToAll');
            const userSelectDiv = document.getElementById('userSelectDiv');
            const userSelect = document.getElementById('userSelect');

            if (checkbox.checked) {
                userSelectDiv.style.display = 'none';
                userSelect.removeAttribute('required');
            } else {
                userSelectDiv.style.display = 'block';
                userSelect.setAttribute('required', 'required');
            }
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('createModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateModal();
            }
        });
    </script>
</x-app-layout>
