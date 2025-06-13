<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <h2 class="mb-6 text-2xl font-extrabold text-[#284494] text-center">Editar usuario</h2>
                    <x-alert-errors />
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white rounded-2xl shadow p-6 border border-[#e0e7ff]">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block font-bold mb-1">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold mb-1">Correo</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold mb-1">Rol</label>
                            <select name="role" class="w-full border rounded px-3 py-2" required>
                                <option value="user" @selected($user->role == 'user')>Usuario</option>
                                <option value="admin" @selected($user->role == 'admin')>Administrador</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold mb-1">Bloqueado</label>
                            <select name="is_blocked" class="w-full border rounded px-3 py-2" required>
                                <option value="0" @selected(!$user->is_blocked)>No</option>
                                <option value="1" @selected($user->is_blocked)>Sí</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Guardar</button>
                            <a href="{{ route('admin.users.index') }}" class="ml-4 text-[#2563eb] underline">Cancelar</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>