<x-app-layout>
    <div class="flex min-h-screen bg-[#F0F4F4] font-primary">
        <x-admin-sidebar />
        <div class="flex flex-col flex-1 w-full">
            <main class="h-full overflow-y-auto">
                <div class="max-w-4xl mx-auto px-4 py-8">
                    <h2 class="mb-6 text-2xl font-extrabold text-[#284494] text-center">Contactos de {{ $user->name }}
                        {{ $user->lastname }}</h2>
                    @if ($user->contacts->isEmpty())
                        <div class="text-center text-gray-400 py-8 font-mono">No tiene contactos guardados.</div>
                    @else
                        <div class="bg-white rounded-2xl shadow-lg p-4 border border-[#e0e7ff]">
                            <table class="min-w-full text-left font-mono text-sm">
                                <thead>
                                    <tr class="border-b border-[#e0e7ff] bg-[#ede8f6] text-[#284494] uppercase text-xs">
                                        <th class="py-3 px-4 font-bold">ID</th>
                                        <th class="py-3 px-4 font-bold">Nombre</th>
                                        <th class="py-3 px-4 font-bold">Apellido</th>
                                        <th class="py-3 px-4 font-bold">Correo</th>
                                        <th class="py-3 px-4 font-bold">Teléfono</th>
                                        <th class="py-3 px-4 font-bold">Dirección</th>
                                        <th class="py-3 px-4 font-bold">País</th>
                                        <th class="py-3 px-4 font-bold">Alias</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->contacts as $contact)
                                        <tr class="border-b border-gray-100 hover:bg-[#f5f7fa] transition">
                                            <td class="py-3 px-4 text-gray-700">
                                                {{ $contact->contact->id ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 font-semibold text-gray-800">
                                                {{ $contact->contact->name ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 font-semibold text-gray-800">
                                                {{ $contact->contact->lastname ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 text-gray-700">
                                                {{ $contact->contact->email ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 text-gray-700">
                                                {{ $contact->contact->phone ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 text-gray-700">
                                                {{ $contact->contact->address ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 text-gray-700">
                                                {{ $contact->contact->country ?? '-' }}
                                            </td>
                                            <td class="py-3 px-4 text-gray-700">
                                                {{ $contact->alias ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
