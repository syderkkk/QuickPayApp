<x-app-layout>
    @include('layouts.navigation')
    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-3xl mx-auto px-2 sm:px-4 pt-12">

            <!-- Título principal -->
            <h1 class="text-2xl sm:text-3xl font-bold font-mono text-[#2563eb] text-center mb-8">Contactos</h1>

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="mb-4 text-red-600 font-mono bg-red-100 rounded p-3">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario agregar contacto -->
            <div id="add-contact-form" class="mt-8 mb-10 flex justify-center">
                <form method="POST" action="{{ route('contacts.store') }}"
                    class="flex flex-col sm:flex-row gap-4 items-center w-full max-w-2xl">
                    @csrf
                    <input type="email" name="contact_email" placeholder="Correo del contacto" required
                        class="border border-gray-400 px-4 py-2 rounded-full font-mono w-full sm:w-1/2 text-sm sm:text-base">
                    <button type="submit"
                        class="bg-[#2563eb] text-white px-6 py-2 rounded-full font-bold font-mono transition hover:bg-[#1d4ed8] text-sm sm:text-base">Agregar</button>
                </form>
            </div>

            <!-- Tabla de contactos -->
            <div class="bg-white rounded-xl shadow p-2 sm:p-4 overflow-x-auto">
                <table class="min-w-full text-left font-mono text-sm sm:text-base">
                    <thead>
                        <tr class="border-b border-gray-400 text-black">
                            <th class="py-3 px-2 sm:px-4 font-bold">Nombre</th>
                            <th class="py-3 px-2 sm:px-4 font-bold">Correo electrónico</th>
                            <th class="py-3 px-2 sm:px-4 font-bold">Número telefónico</th>
                            <th class="py-3 px-2 sm:px-4 font-bold text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr class="border-b border-gray-400">
                                <td class="py-3 px-2 sm:px-4 flex items-center gap-3">
                                    <span
                                        class="inline-flex items-center justify-center rounded-full bg-white border border-gray-300 w-8 h-8 sm:w-10 sm:h-10 text-[#2563eb] font-bold text-base sm:text-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <div>
                                        @if ($contact->alias)
                                            <div class="font-bold text-black truncate max-w-[120px] sm:max-w-none">
                                                {{ $contact->alias }}
                                            </div>
                                            <div class="text-xs text-gray-600 truncate max-w-[120px] sm:max-w-none">
                                                {{ $contact->contact->name }} {{ $contact->contact->lastname }}
                                            </div>
                                        @else
                                            <div class="font-bold text-black truncate max-w-[120px] sm:max-w-none">
                                                {{ $contact->contact->name }} {{ $contact->contact->lastname }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-2 sm:px-4 align-middle break-all">{{ $contact->contact->email }}</td>
                                <td class="py-3 px-2 sm:px-4 align-middle">
                                    <div>{{ $contact->contact->phone ?? '-' }}</div>
                                    <div class="text-xs text-gray-600">{{ $contact->contact->address ?? '-' }}</div>
                                </td>
                                <td class="py-3 px-2 sm:px-4 text-center flex gap-2 justify-center">
                                    <!-- Botón para mostrar formulario de edición de alias -->
                                    <a href="#" title="Editar alias"
                                        onclick="event.preventDefault(); document.getElementById('edit-alias-{{ $contact->id }}').classList.toggle('hidden');"
                                        class="text-[#2563eb] hover:text-[#1d4ed8] transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 inline"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a4 4 0 01-2.828 1.172H7v-2a4 4 0 011.172-2.828z" />
                                        </svg>
                                    </a>
                                    <!-- Formulario inline para editar alias -->
                                    <form id="edit-alias-{{ $contact->id }}" class="hidden mt-2" method="POST"
                                        action="{{ route('contacts.update', $contact) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="alias" value="{{ $contact->alias }}"
                                            class="border px-2 py-1 rounded text-xs font-mono" placeholder="Alias">
                                        <button type="submit"
                                            class="text-xs bg-[#2563eb] text-white px-2 py-1 rounded">Guardar</button>
                                    </form>
                                    <form method="POST" action="{{ route('contacts.destroy', $contact) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Eliminar"
                                            class="text-[#2563eb] hover:text-[#d32f2f] transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 inline"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-gray-400">No tienes contactos guardados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Ver contactos bloqueados -->
            <div class="mt-8 text-center">
                <a href="#" class="text-[#2563eb] font-mono underline text-base hover:text-[#1d4ed8]">Ver
                    contactos bloqueados</a>
            </div>
        </div>
    </div>
</x-app-layout>
