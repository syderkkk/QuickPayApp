<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <h2 class="mb-6 text-2xl font-extrabold text-[#284494] text-center">Usuarios</h2>
                    <x-alert-errors />
                    <a href="{{ route('admin.users.create') }}"
                        class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-700 transition">
                        + Nuevo usuario
                    </a>

                    <form method="GET" class="mb-4 flex gap-2">
                        <input type="text" name="search" placeholder="Buscar nombre o correo..."
                            value="{{ request('search') }}" class="border rounded px-2 py-1">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Buscar</button>
                    </form>
                    <div class="bg-white rounded-2xl shadow p-4 border border-[#e0e7ff] overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-xs font-bold text-[#284494] uppercase border-b bg-[#ede8f6]">
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Nombre</th>
                                    <th class="px-4 py-2">Apellido</th>
                                    <th class="px-4 py-2">Correo</th>
                                    <th class="px-4 py-2">Rol</th>
                                    <th class="px-4 py-2">Bloqueado</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $user->id }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->lastname }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($user->is_blocked)
                                                <span class="text-red-600 font-bold">Sí</span>
                                            @else
                                                <span class="text-green-600 font-bold">No</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                                class="text-blue-600 underline">Ver</a>
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="text-yellow-600 underline ml-2">Editar</a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 underline ml-2"
                                                    onclick="return confirm('¿Eliminar este usuario?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">No hay usuarios.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>