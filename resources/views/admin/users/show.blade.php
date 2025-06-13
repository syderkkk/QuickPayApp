<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
                    <h2 class="mb-6 text-2xl font-extrabold text-[#284494] text-center">Detalle de usuario</h2>
                    <x-alert-errors />
                    <div class="bg-white rounded-2xl shadow p-6 border border-[#e0e7ff]">
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="font-semibold">ID</dt>
                                <dd>{{ $user->id }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Nombre</dt>
                                <dd>{{ $user->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Apellido</dt>
                                <dd>{{ $user->lastname }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Correo</dt>
                                <dd>{{ $user->email }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Rol</dt>
                                <dd>{{ ucfirst($user->role) }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold">Bloqueado</dt>
                                <dd>
                                    @if ($user->is_blocked)
                                        <span class="text-red-600 font-bold">Sí</span>
                                    @else
                                        <span class="text-green-600 font-bold">No</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                        <div class="mt-6 text-center">
                            <a href="{{ route('admin.users.index') }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded">Volver</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
