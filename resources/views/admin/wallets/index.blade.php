<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-5xl mx-auto px-2 sm:px-4 pt-8">
                    <!-- Título y buscador -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Wallets de usuarios</h2>
                    </div>
                    <div class="mb-6 flex flex-col sm:flex-row items-center gap-4">
                        <form method="GET" class="flex-1 flex flex-wrap items-center gap-2 w-full">
                            <!-- ...buscador existente... -->
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
                            <!-- Filtro moneda -->
                            <select name="currency"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-24">
                                <option value="">Moneda</option>
                                <option value="PEN" {{ request('currency') == 'PEN' ? 'selected' : '' }}>PEN</option>
                                <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="MXN" {{ request('currency') == 'MXN' ? 'selected' : '' }}>MXN</option>
                            </select>
                            <!-- Filtro saldo mínimo -->
                            <input type="number" step="0.01" min="0" name="min_balance"
                                value="{{ request('min_balance') }}" placeholder="Saldo mínimo"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-28" />
                            <!-- Filtro saldo máximo -->
                            <input type="number" step="0.01" min="0" name="max_balance"
                                value="{{ request('max_balance') }}" placeholder="Saldo máximo"
                                class="rounded-lg border border-[#c7d2fe] text-xs py-2 px-3 bg-white w-28" />
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
                                    <th class="px-3 py-2 text-left">Usuario</th>
                                    <th class="px-3 py-2 text-left">Correo</th>
                                    <th class="px-3 py-2 text-left">Saldo</th>
                                    <th class="px-3 py-2 text-left">Moneda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wallets as $wallet)
                                    <tr>
                                        <td class="px-3 py-2 font-semibold">{{ $wallet->user->name }}
                                            {{ $wallet->user->lastname }}
                                        </td>
                                        <td class="px-3 py-2">{{ $wallet->user->email }}</td>
                                        <td class="px-3 py-2 font-semibold">{{ number_format($wallet->balance, 2) }}
                                        </td>
                                        <td class="px-3 py-2 font-semibold">{{ $wallet->currency }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6 text-gray-400">No hay wallets
                                            registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-admin-pagination :paginator="$wallets" />
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
