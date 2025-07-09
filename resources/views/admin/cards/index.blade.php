<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-5xl mx-auto px-2 sm:px-4 pt-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Tarjetas asociadas</h2>
                    </div>

                    {{-- Mensajes de éxito/error --}}
                    <x-alert-succes />
                    <x-alert-errors />

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
                            <select name="status"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white">
                                <option value="">Estado</option>
                                <option value="enabled" {{ request('status') == 'enabled' ? 'selected' : '' }}>
                                    Habilitada</option>
                                <option value="disabled" {{ request('status') == 'disabled' ? 'selected' : '' }}>
                                    Inhabilitada</option>
                            </select>
                            <!-- Últimos 4 dígitos -->
                            <input type="text" name="last_four" maxlength="4" placeholder="Últimos 4 dígitos"
                                value="{{ request('last_four') }}"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-28" />
                            {{-- <!-- ID de tarjeta -->
                            <input type="number" name="card_id" min="1" placeholder="ID tarjeta"
                                value="{{ request('card_id') }}"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-24" />
                            <!-- Marca -->
                            <select name="brand"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white">
                                <option value="">Marca</option>
                                <option value="Visa" {{ request('brand') == 'Visa' ? 'selected' : '' }}>Visa</option>
                                <option value="Mastercard" {{ request('brand') == 'Mastercard' ? 'selected' : '' }}>
                                    Mastercard</option>
                                <option value="American Express"
                                    {{ request('brand') == 'American Express' ? 'selected' : '' }}>American Express
                                </option>
                                <!-- Agrega más marcas si es necesario -->
                            </select> --}}
                            <!-- Botón -->
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
                        <table class="w-full min-w-[600px] divide-y divide-[#e0e7ff] text-xs">
                            <thead>
                                <tr class="font-bold text-[#284494] uppercase bg-[#ede8f6]">
                                    {{-- <th class="px-3 py-2 text-left">ID</th> --}}
                                    <th class="px-3 py-2 text-left">Usuario</th>
                                    <th class="px-3 py-2 text-left">Token</th>
                                    <th class="px-3 py-2 text-left">Titular</th>
                                    <th class="px-3 py-2 text-left">Últimos 4</th>
                                    <th class="px-3 py-2 text-left">Estado</th> <!-- Nueva columna -->
                                    <th class="px-3 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cards as $card)
                                    <tr class="hover:bg-[#f5f7fa] transition">
                                        {{-- <td class="px-3 py-2 align-middle">{{ $card->id }}</td> --}}
                                        <td class="px-3 py-2 align-middle">{{ $card->user->name ?? '-' }}
                                            {{ $card->user->lastname ?? '-' }}</td>
                                        <td class="px-3 py-2 align-middle font-mono">
                                            {{ $card->token }}</td>
                                        <td class="px-3 py-2 align-middle">{{ $card->card_holder }}</td>
                                        <td class="px-3 py-2 align-middle font-mono">{{ $card->last_four }}</td>
                                        <td class="px-3 py-2 align-middle">
                                            @if ($card->status === 'enabled' || $card->status === 'habilitada')
                                                <span
                                                    class="px-2 py-1 rounded-full bg-green-100 text-green-700 font-bold text-xs font-mono">Habilitada</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 rounded-full bg-red-100 text-red-700 font-bold text-xs font-mono">Inhabilitada</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-2 text-center align-middle flex gap-1 justify-center">
                                            {{-- Botón Editar --}}
                                            <a href="{{ route('admin.cards.edit', $card->id) }}"
                                                class="inline-flex items-center px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-bold text-[10px] hover:bg-yellow-200 transition"
                                                title="Editar">
                                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                                                </svg>
                                                Editar
                                            </a>
                                            {{-- Botón Eliminar --}}
                                            <form action="{{ route('admin.cards.destroy', $card->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('¿Seguro que deseas eliminar esta tarjeta?');">
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
                                        <td colspan="7" class="text-center py-6 text-gray-400">No hay tarjetas
                                            asociadas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Paginación --}}
                    <x-admin-pagination :paginator="$cards" />
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
