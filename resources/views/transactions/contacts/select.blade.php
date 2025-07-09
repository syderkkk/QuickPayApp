<x-app-layout>
    @include('layouts.navigation')
    <x-tabs-transacciones activo="contactos" />

    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-2xl mx-auto py-8 px-2 sm:px-4">
            <x-alert />
            <!-- Header con título y botón agregar -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h2
                    class="text-2xl sm:text-3xl font-mono font-extrabold text-black mb-4 sm:mb-0 text-center sm:text-left">
                    Selecciona un contacto
                </h2>
                <button onclick="openAddContactModal()"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] hover:from-[#1d4ed8] hover:to-[#1e40af] text-white font-mono font-bold py-2.5 px-5 rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-sm">Agregar contacto</span>
                </button>
            </div>

            <!-- Buscador mejorado -->
            <div class="mb-6">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                    </svg>
                    <input type="text" id="searchInput" placeholder="Buscar por nombre, email o alias..."
                        class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-2xl font-mono text-sm bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-all duration-200 hover:shadow-md">
                </div>
            </div>

            <!-- Lista de contactos -->
            <div class="grid grid-cols-1 gap-4" id="contactsList">
                @forelse($contacts as $contact)
                    <div class="contact-item flex flex-col sm:flex-row sm:items-center justify-between bg-white rounded-2xl shadow-sm hover:shadow-lg p-5 border border-gray-200 transition-all duration-300 hover:scale-[1.01] hover:border-[#2563eb]/20"
                        data-name="{{ strtolower($contact->name . ' ' . $contact->lastname) }}"
                        data-email="{{ strtolower($contact->email) }}"
                        data-alias="{{ strtolower($contact->alias ?? '') }}">
                        <div class="flex items-center gap-4 mb-4 sm:mb-0">
                            <!-- Avatar usuario -->
                            <div
                                class="flex-shrink-0 bg-gradient-to-br from-[#2563eb] to-[#1d4ed8] rounded-full w-12 h-12 flex items-center justify-center text-white shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <div class="min-w-0 flex-1">
                                        @if ($contact->alias)
                                            <!-- Mostrar alias destacado -->
                                            <div class="font-mono font-bold text-lg text-gray-900 break-words">
                                                {{ $contact->alias }}
                                            </div>
                                            <div class="font-mono text-sm text-gray-500 break-words">
                                                {{ $contact->name }} {{ $contact->lastname }}
                                            </div>
                                        @else
                                            <!-- Mostrar nombre cuando no hay alias -->
                                            <div class="font-mono font-bold text-lg text-gray-900 break-words">
                                                {{ $contact->name }} {{ $contact->lastname }}
                                            </div>
                                        @endif
                                        <div class="font-mono text-sm text-gray-600 break-all">{{ $contact->email }}
                                        </div>
                                    </div>
                                    <!-- Botón de editar alias -->
                                    <button
                                        onclick="openEditAliasModal({{ $contact->id }}, '{{ $contact->alias ?? '' }}', '{{ $contact->name }} {{ $contact->lastname }}')"
                                        class="p-2 text-gray-400 hover:text-[#2563eb] transition-colors duration-200 rounded-full hover:bg-gray-100"
                                        title="Editar alias">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Formularios ocultos -->
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

                        <!-- Botones de acción mejorados -->
                        <div class="flex items-center gap-3 mt-2 sm:mt-0">
                            <!-- Botón Enviar -->
                            <button
                                class="bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] hover:from-[#1d4ed8] hover:to-[#1e40af] text-white font-mono font-bold text-sm py-2.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95 flex items-center gap-2"
                                onclick="event.preventDefault(); document.getElementById('send-form-{{ $contact->user_id }}').submit();"
                                title="Enviar dinero">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Enviar
                            </button>

                            <!-- Botón Solicitar -->
                            <button
                                class="bg-gradient-to-r from-[#f59e0b] to-[#d97706] hover:from-[#d97706] hover:to-[#b45309] text-white font-mono font-bold text-sm py-2.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95 flex items-center gap-2"
                                onclick="event.preventDefault(); document.getElementById('request-form-{{ $contact->user_id }}').submit();"
                                title="Solicitar dinero">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                </svg>
                                Solicitar
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <p class="text-gray-400 font-mono text-lg">No tienes contactos guardados</p>
                        <p class="text-gray-500 font-mono text-sm mt-2">Agrega tu primer contacto</p>
                    </div>
                @endforelse
            </div>

            <!-- Mensaje cuando no hay resultados de búsqueda -->
            <div id="noResults" class="text-center py-12 hidden">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
                <p class="text-gray-400 font-mono text-lg">No se encontraron contactos</p>
                <p class="text-gray-500 font-mono text-sm mt-2">Intenta con otros términos de búsqueda</p>
            </div>
        </div>
    </div>

    <!-- Modal para agregar contacto -->
    <div id="addContactModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md mx-4 transform scale-95 opacity-0 transition-all duration-300"
            id="addModalContent">
            <!-- Header del modal -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] p-2 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#284494] font-mono">Agregar contacto</h3>
                </div>
                <button onclick="closeAddContactModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-2 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('contacts.store') }}" id="addContactForm">
                @csrf
                <div class="mb-6">
                    <label for="contact_email" class="block text-sm font-medium text-[#284494] font-mono mb-3">
                        Correo electrónico del contacto
                    </label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                        <input type="email" id="contact_email" name="contact_email"
                            placeholder="ejemplo@correo.com"
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-2xl font-mono text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-all duration-200 hover:shadow-md"
                            required>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] hover:from-[#1d4ed8] hover:to-[#1e40af] text-white font-mono font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Agregar
                        </span>
                    </button>
                    <button type="button" onclick="closeAddContactModal()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-105 active:scale-95">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar alias -->
    <div id="editAliasModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md mx-4 transform scale-95 opacity-0 transition-all duration-300"
            id="editModalContent">
            <!-- Header del modal -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="bg-gradient-to-r from-[#f59e0b] to-[#d97706] p-2 rounded-full">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#284494] font-mono">Editar alias</h3>
                </div>
                <button onclick="closeEditAliasModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-2 rounded-full hover:bg-gray-100">
                    <form method="POST" id="deleteContactForm" class="ml-auto" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Eliminar contacto"
                            onclick="return confirm('¿Seguro que deseas eliminar este contacto?');"
                            class="p-2 rounded-full hover:bg-red-50 transition-colors">
                            <svg class="w-6 h-6 text-red-600 hover:text-red-800" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2" />
                            </svg>
                        </button>
                    </form>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('contacts.update', ':id') }}" id="editAliasForm">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-[#284494] font-mono mb-2">
                        Contacto
                    </label>
                    <div class="text-gray-700 font-mono text-sm p-3 bg-gray-50 rounded-lg" id="contactName">
                        <!-- Se llenará con JavaScript -->
                    </div>
                </div>

                <div class="mb-6">
                    <label for="edit_alias" class="block text-sm font-medium text-[#284494] font-mono mb-3">
                        Alias (opcional)
                    </label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <input type="text" id="edit_alias" name="alias"
                            placeholder="Ej: Mamá, Hermano, Mejor amigo..."
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-2xl font-mono text-sm focus:outline-none focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb] transition-all duration-200 hover:shadow-md">
                    </div>
                    <p class="text-xs text-gray-500 font-mono mt-2">Déjalo vacío para eliminar el alias</p>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-[#f59e0b] to-[#d97706] hover:from-[#d97706] hover:to-[#b45309] text-white font-mono font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Guardar
                        </span>
                    </button>
                    <button type="button" onclick="closeEditAliasModal()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-105 active:scale-95">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const rafQueue = [];
        let rafId = null;

        function processQueue() {
            if (rafQueue.length > 0) {
                const fn = rafQueue.shift();
                fn();
                rafId = requestAnimationFrame(processQueue);
            } else {
                rafId = null;
            }
        }

        function addToQueue(fn) {
            rafQueue.push(fn);
            if (!rafId) {
                rafId = requestAnimationFrame(processQueue);
            }
        }

        function openAddContactModal() {
            const modal = document.getElementById('addContactModal');
            const modalContent = document.getElementById('addModalContent');

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            addToQueue(() => {
                modalContent.style.transform = 'scale(1)';
                modalContent.style.opacity = '1';
            });

            setTimeout(() => {
                const input = document.getElementById('contact_email');
                if (input) input.focus();
            }, 150);
        }

        function closeAddContactModal() {
            const modal = document.getElementById('addContactModal');
            const modalContent = document.getElementById('addModalContent');

            addToQueue(() => {
                modalContent.style.transform = 'scale(0.95)';
                modalContent.style.opacity = '0';
            });

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('addContactForm').reset();
            }, 300);
        }

        function openEditAliasModal(contactId, currentAlias, contactName) {

            const modal = document.getElementById('editAliasModal');
            const modalContent = document.getElementById('editModalContent');
            const form = document.getElementById('editAliasForm');
            const aliasInput = document.getElementById('edit_alias');
            const contactNameDiv = document.getElementById('contactName');
            const deleteForm = document.getElementById('deleteContactForm');

            form.action = `/contacts/${contactId}`;
            deleteForm.action = `/contacts/${contactId}`;

            aliasInput.value = currentAlias;
            contactNameDiv.textContent = contactName;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            addToQueue(() => {
                modalContent.style.transform = 'scale(1)';
                modalContent.style.opacity = '1';
            });

            setTimeout(() => {
                aliasInput.focus();
            }, 150);
        }

        function closeEditAliasModal() {
            const modal = document.getElementById('editAliasModal');
            const modalContent = document.getElementById('editModalContent');

            addToQueue(() => {
                modalContent.style.transform = 'scale(0.95)';
                modalContent.style.opacity = '0';
            });

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('editAliasForm').reset();
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', function() {
            ['addContactModal', 'editAliasModal'].forEach(modalId => {
                document.getElementById(modalId).addEventListener('click', function(e) {
                    if (e.target === this) {
                        if (modalId === 'addContactModal') {
                            closeAddContactModal();
                        } else {
                            closeEditAliasModal();
                        }
                    }
                });
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const addModal = document.getElementById('addContactModal');
                    const editModal = document.getElementById('editAliasModal');

                    if (!addModal.classList.contains('hidden')) {
                        closeAddContactModal();
                    } else if (!editModal.classList.contains('hidden')) {
                        closeEditAliasModal();
                    }
                }
            });

            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = this.value.toLowerCase().trim();
                    const contacts = document.querySelectorAll('.contact-item');
                    const noResults = document.getElementById('noResults');
                    let hasResults = false;

                    contacts.forEach(contact => {
                        const name = contact.getAttribute('data-name');
                        const email = contact.getAttribute('data-email');
                        const alias = contact.getAttribute('data-alias');

                        if (name.includes(searchTerm) || email.includes(searchTerm) || alias
                            .includes(searchTerm)) {
                            contact.style.display = 'flex';
                            hasResults = true;
                        } else {
                            contact.style.display = 'none';
                        }
                    });

                    noResults.classList.toggle('hidden', !searchTerm || hasResults);
                }, 300);
            });

            const contacts = document.querySelectorAll('.contact-item');
            contacts.forEach((contact, index) => {
                contact.style.opacity = '0';
                contact.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    addToQueue(() => {
                        contact.style.transition = 'all 0.3s ease';
                        contact.style.opacity = '1';
                        contact.style.transform = 'translateY(0)';
                    });
                }, index * 50);
            });
        });
    </script>
</x-app-layout>
