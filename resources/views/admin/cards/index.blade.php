<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-admin-header />
            <main class="h-full overflow-y-auto">
                <div class="max-w-5xl mx-auto px-2 sm:px-4 pt-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-6">
                        <h2 class="text-2xl font-extrabold text-[#284494] font-mono">Tarjetas asociadas</h2>
                    </div>

                    {{-- Mensajes de éxito/error --}}
                    @if (session('success'))
                        <div class="mb-4 text-green-700 bg-green-100 rounded p-3 font-mono">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 text-red-600 bg-red-100 rounded p-3 font-mono">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl shadow-lg border border-[#e0e7ff] overflow-x-auto">
                        <table class="w-full min-w-[600px] divide-y divide-[#e0e7ff] text-xs">
                            <thead>
                                <tr class="font-bold text-[#284494] uppercase bg-[#ede8f6]">
                                    <th class="px-3 py-2 text-left">ID</th>
                                    <th class="px-3 py-2 text-left">Usuario</th>
                                    <th class="px-3 py-2 text-left">Número</th>
                                    <th class="px-3 py-2 text-left">Titular</th>
                                    <th class="px-3 py-2 text-left">Últimos 4</th>
                                    <th class="px-3 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cards as $card)
                                    <tr class="hover:bg-[#f5f7fa] transition">
                                        <td class="px-3 py-2 align-middle">{{ $card->id }}</td>
                                        <td class="px-3 py-2 align-middle">{{ $card->user->name ?? '-' }}</td>
                                        <td class="px-3 py-2 align-middle font-mono">**** **** **** {{ $card->last_four }}</td>
                                        <td class="px-3 py-2 align-middle">{{ $card->card_holder }}</td>
                                        <td class="px-3 py-2 align-middle font-mono">{{ $card->last_four }}</td>
                                        <td class="px-3 py-2 text-center align-middle">
                                            <a href="{{ route('admin.cards.show', $card->id) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-blue-600 text-white text-xs font-bold shadow hover:bg-blue-700 transition"
                                               title="Ver detalles">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Ver
                                            </a>
                                            <a href="{{ route('admin.cards.edit', $card->id) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-yellow-400 text-black text-xs font-bold shadow hover:bg-yellow-500 transition ml-1"
                                               title="Editar">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6"/>
                                                </svg>
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.cards.destroy', $card->id) }}" method="POST" class="inline ml-1"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta tarjeta?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-red-500 text-white text-xs font-bold shadow hover:bg-red-700 transition"
                                                        title="Eliminar">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-gray-400">No hay tarjetas asociadas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación --}}
                    @if($cards->hasPages())
                        <div class="w-full flex justify-center mt-6">
                            <nav class="flex gap-1 font-mono" aria-label="Paginación">
                                {{-- Botón anterior --}}
                                @if ($cards->onFirstPage())
                                    <span class="px-3 py-2 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed select-none">Anterior</span>
                                @else
                                    <a href="{{ $cards->previousPageUrl() }}"
                                       class="px-3 py-2 rounded-full bg-[#2563eb] text-white hover:bg-[#284494] transition">Anterior</a>
                                @endif

                                {{-- Números de página --}}
                                @foreach ($cards->getUrlRange(1, $cards->lastPage()) as $page => $url)
                                    @if ($page == $cards->currentPage())
                                        <span class="px-3 py-2 rounded-full bg-[#ede8f6] text-[#2563eb] font-bold">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}"
                                           class="px-3 py-2 rounded-full bg-white text-[#2563eb] hover:bg-[#ede8f6] transition">{{ $page }}</a>
                                    @endif
                                @endforeach

                                {{-- Botón siguiente --}}
                                @if ($cards->hasMorePages())
                                    <a href="{{ $cards->nextPageUrl() }}"
                                       class="px-3 py-2 rounded-full bg-[#2563eb] text-white hover:bg-[#284494] transition">Siguiente</a>
                                @else
                                    <span class="px-3 py-2 rounded-full bg-gray-200 text-gray-400 cursor-not-allowed select-none">Siguiente</span>
                                @endif
                            </nav>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-app-layout>