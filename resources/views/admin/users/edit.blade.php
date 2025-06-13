<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-xl mx-auto px-2 sm:px-4 pt-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494]">Editar usuario</h2>
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Volver
                        </a>
                    </div>

                    <x-alert-errors />

                    <form method="POST" action="{{ route('admin.users.update', $user) }}"
                        class="bg-white rounded-2xl shadow-lg p-6 border border-[#e0e7ff] space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Nombre</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Apellido</label>
                                <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Correo</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Teléfono</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Dirección</label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">País</label>
                                <select name="country"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                                    <option value="" disabled>Seleccione su país</option>
                                    <option value="PE" @selected(old('country', $user->country) == 'PE')>Perú</option>
                                    <option value="AR" @selected(old('country', $user->country) == 'AR')>Argentina</option>
                                    <option value="CL" @selected(old('country', $user->country) == 'CL')>Chile</option>
                                    <option value="CO" @selected(old('country', $user->country) == 'CO')>Colombia</option>
                                    <option value="MX" @selected(old('country', $user->country) == 'MX')>México</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Rol</label>
                                <select name="role"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                                    <option value="user" @selected($user->role == 'user')>Usuario</option>
                                    <option value="admin" @selected($user->role == 'admin')>Administrador</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-[#284494] text-xs">Bloqueado</label>
                                <select name="is_blocked"
                                    class="w-full border rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                    required>
                                    <option value="0" @selected(!$user->is_blocked)>No</option>
                                    <option value="1" @selected($user->is_blocked)>Sí</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 justify-center pt-4 border-t border-[#e0e7ff]">
                            <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold shadow hover:bg-blue-700 transition text-xs">
                                Guardar cambios
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