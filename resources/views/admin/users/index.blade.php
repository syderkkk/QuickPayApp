<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-4xl mx-auto px-2 sm:px-4 pt-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494]">Usuarios</h2>
                    </div>

                    <x-alert-errors />

                    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4">
                        <form method="GET" class="flex-1 flex items-center gap-2 w-full">
                            <div class="relative w-full sm:w-72">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#2563eb]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                    </svg>
                                </span>
                                <input type="text" name="search"
                                    placeholder="Buscar por nombre, apellido o correo..."
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 w-full rounded-lg border border-[#c7d2fe] text-xs bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" />
                            </div>
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition text-xs flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                                Buscar
                            </button>
                        </form>
                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white px-3 py-1.5 rounded-lg font-bold shadow hover:bg-blue-700 transition text-xs whitespace-nowrap ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Crear usuario
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] overflow-x-auto">
                        <table class="w-full min-w-[500px] divide-y divide-[#e0e7ff] text-xs">
                            <thead>
                                <tr class="font-bold text-[#284494] uppercase bg-[#ede8f6]">
                                    {{-- <th class="px-3 py-2 text-left">ID</th> --}}
                                    <th class="px-3 py-2 text-left">Nombre</th>
                                    <th class="px-3 py-2 text-left">Apellido</th>
                                    <th class="px-3 py-2 text-left">Correo</th>
                                    <th class="px-3 py-2 text-left">Rol</th>
                                    <th class="px-3 py-2 text-left">Estado</th>
                                    <th class="px-3 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e0e7ff]">
                                @forelse($users as $user)
                                    <tr class="hover:bg-[#f5f7fa] transition">
                                        {{-- <td class="px-3 py-2 font-mono text-gray-700">{{ $user->id }}</td> --}}
                                        <td class="px-3 py-2 font-semibold text-gray-800">{{ $user->name }}</td>
                                        <td class="px-3 py-2 font-semibold text-gray-800">{{ $user->lastname }}</td>
                                        <td class="px-3 py-2 text-gray-700">{{ $user->email }}</td>
                                        <td class="px-3 py-2">
                                            <span
                                                class="inline-block px-2 py-0.5 rounded bg-blue-100 text-blue-700 font-medium text-[10px]">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2">
                                            <span
                                                class="inline-block px-2 py-0.5 rounded font-bold text-[10px]
                                                {{ $user->is_blocked ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                                {{ $user->is_blocked ? 'Bloqueado' : 'Activo' }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 text-center">
                                            <div class="flex items-center justify-center gap-1">
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                    class="inline-flex items-center px-2 py-1 rounded bg-blue-100 text-blue-700 font-bold text-[10px] hover:bg-blue-200 transition"
                                                    title="Ver perfil">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Ver
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                    class="inline-flex items-center px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-bold text-[10px] hover:bg-yellow-200 transition"
                                                    title="Editar usuario">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536M9 13l6-6M3 21h18" />
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    class="inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 rounded bg-red-100 text-red-700 font-bold text-[10px] hover:bg-red-200 transition"
                                                        title="Eliminar usuario">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-6 text-gray-400 font-mono text-xs">No
                                            hay usuarios.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación personalizada -->
                    <x-admin-pagination :paginator="$users" />

                </div>
            </main>
        </div>
    </div>
</x-app-layout>