<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494]">Registrar nuevo usuario</h2>
                    </div>
                    <x-alert-errors />
                    <form method="POST" action="{{ route('admin.users.store') }}"
                        class="bg-white rounded-2xl shadow-lg p-6 border border-[#e0e7ff] space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Nombre</label>
                                <input type="text" name="name"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Apellido</label>
                                <input type="text" name="lastname"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Correo</label>
                                <input type="email" name="email"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Contraseña</label>
                                <input type="password" name="password"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Rol</label>
                                <select name="role"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                                    <option value="user">Usuario</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Bloqueado</label>
                                <select name="is_blocked"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-center gap-4 pt-2">
                            <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold shadow hover:bg-blue-700 transition text-xs">
                                Registrar
                            </button>
                            <a href="{{ route('admin.users.index') }}"
                                class="text-[#2563eb] underline px-4 py-2 rounded-lg font-bold hover:text-blue-700 transition text-xs">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>