<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-5xl mx-auto px-2 sm:px-4 pt-8">
                    <!-- Título y buscador -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Cuentas bancarias asociadas</h2>
                    </div>
                    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4">
                        <form method="GET" class="flex-1 flex flex-wrap items-center gap-2 w-full">
                            <!-- Buscar por usuario -->
                            <div class="relative w-full sm:w-60">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-[#2563eb]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                    </svg>
                                </span>
                                <input type="text" name="search" placeholder="Buscar usuario (nombre, correo)"
                                    value="{{ request('search') }}"
                                    class="pl-10 pr-4 py-2 w-full rounded-lg border border-[#c7d2fe] text-xs bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" />
                            </div>
                            <!-- Estado -->
                            <select name="is_enabled"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white">
                                <option value="">Estado</option>
                                <option value="1" {{ request('is_enabled') === '1' ? 'selected' : '' }}>Habilitada
                                </option>
                                <option value="0" {{ request('is_enabled') === '0' ? 'selected' : '' }}>
                                    Inhabilitada</option>
                            </select>
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
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] overflow-x-auto">
                        <table class="w-full min-w-[700px] divide-y divide-[#e0e7ff] text-xs">
                            <thead>
                                <tr class="font-bold text-[#284494] uppercase bg-[#ede8f6]">
                                    <th class="px-3 py-2 text-left">Usuario</th>
                                    <th class="px-3 py-2 text-left">Banco</th>
                                    <th class="px-3 py-2 text-left">Tipo de Cuenta</th>
                                    <th class="px-3 py-2 text-left">Estado</th>
                                    <th class="px-3 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banks as $bank)
                                    <tr>
                                        <td class="px-3 py-2">{{ $bank->user->name ?? '-' }}
                                            {{ $bank->user->lastname ?? '' }}</td>
                                        <td class="px-3 py-2">{{ $bank->bank_name }}</td>
                                        <td class="px-3 py-2">{{ $bank->account_type }}</td>
                                        <td class="px-3 py-2">
                                            @if ($bank->is_enabled)
                                                <span
                                                    class="px-2 py-1 rounded-full bg-green-100 text-green-700 font-bold text-xs font-mono">Habilitada</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 rounded-full bg-red-100 text-red-700 font-bold text-xs font-mono">Inhabilitada</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 text-center align-middle flex gap-1 justify-center">
                                            <a href="{{ route('admin.banks.edit', $bank) }}"
                                                class="inline-flex items-center px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-bold text-[10px] hover:bg-yellow-200 transition"
                                                title="Editar">
                                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                                                </svg>
                                                Detalles
                                            </a>
                                            <form action="{{ route('admin.banks.destroy', $bank) }}" method="POST"
                                                class="inline" onsubmit="return confirm('¿Eliminar cuenta bancaria?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 rounded bg-red-100 text-red-700 font-bold text-[10px] hover:bg-red-200 transition"
                                                    title="Eliminar">
                                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-gray-400">No hay cuentas
                                            bancarias registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <x-admin-pagination :paginator="$banks" />
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
