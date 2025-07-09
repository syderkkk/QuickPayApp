<x-app-layout>
    @include('layouts.navigation')
    <x-tabs-transacciones activo="contactos" />

    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-2xl mx-auto py-8 px-2 sm:px-4">
            <h2 class="text-2xl sm:text-3xl font-mono font-extrabold text-black mb-6 text-center">Selecciona un contacto
            </h2>

            <!-- Botón para agregar contactos -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('contacts.store') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-2 px-6 font-mono text-sm transition shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Agregar contacto
                </a>
            </div>
            <div class="grid grid-cols-1 gap-4">
                @forelse($contacts as $contact)
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between bg-white rounded-xl shadow p-4 border border-gray-200 transition hover:scale-[1.01]">
                        <div class="flex items-center gap-3 mb-3 sm:mb-0">
                            <!-- SVG usuario -->
                            <span
                                class="flex-shrink-0 bg-[#2563eb] rounded-full w-10 h-10 flex items-center justify-center text-white text-xl font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <div>
                                <div class="font-mono font-bold text-lg text-black break-words">{{ $contact->name }}
                                    {{ $contact->lastname }}</div>
                                <div class="font-mono text-xs text-gray-500 break-all">{{ $contact->email }}</div>
                                @if($contact->alias)
                                    <div class="font-mono text-xs text-gray-400">Alias: {{ $contact->alias }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- Formularios ocultos para enviar y solicitar -->
                        <form method="POST" action="{{ route('transactions.send.step2') }}"
                            id="send-form-{{ $contact->user_id }}" style="display:none;">
                            @csrf
                            <input type="hidden" name="type" value="send">
                            <input type="hidden" name="receiver" value="{{ $contact->email }}">
                        </form>
                        <form method="POST" action="{{ route('transactions.request.step2') }}"
                            id="request-form-{{ $contact->user_id }}" style="display:none;">
                            @csrf
                            <input type="hidden" name="type" value="request">
                            <input type="hidden" name="receiver" value="{{ $contact->email }}">
                        </form>
                        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto mt-2 sm:mt-0">
                            <button
                                class="bg-[#2563eb] hover:bg-[#284494] text-white font-mono font-extrabold text-base py-2 px-6 rounded-xl transition shadow w-full sm:w-auto"
                                onclick="event.preventDefault(); document.getElementById('send-form-{{ $contact->user_id }}').submit();">
                                Enviar
                            </button>
                            <button
                                class="cursor-pointer bg-[#fbbf24] hover:bg-[#f59e42] text-white font-mono font-extrabold text-base py-2 px-6 rounded-xl transition shadow w-full sm:w-auto"
                                onclick="event.preventDefault(); document.getElementById('request-form-{{ $contact->user_id }}').submit();"
                                title="Solicitar">
                                Solicitar
                            </button>
                            <a href="{{ route('contacts.show', $contact->contact_relation_id) }}"
                                class="bg-gray-200 hover:bg-gray-300 text-[#2563eb] font-mono font-bold text-base py-2 px-6 rounded-xl transition shadow w-full sm:w-auto text-center"
                                title="Ver detalles">
                                Detalles
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 py-8 font-mono">No tienes contactos guardados.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>