@props(['activo' => 'enviar'])

<div class="w-full bg-[#D9D9D9] border-b-2 border-gray-300">
    <div class="max-w-2xl mx-auto flex flex-col sm:flex-row">
        <a href="{{ route('transactions.send.step1') }}"
            class="font-mono text-lg font-extrabold px-4 py-2 text-center {{ $activo == 'enviar' ? 'text-black border-b-4 border-black' : 'text-gray-600' }}">
            Enviar
        </a>
        <span
            class="font-mono text-base px-4 py-2 sm:ml-2 text-center text-gray-400 cursor-not-allowed border-b-4 border-transparent select-none">
            Solicitar
        </span>
        {{-- <a href="#"
           class="font-mono text-base px-4 py-2 sm:ml-2 text-center {{ $activo == 'solicitar' ? 'text-black border-b-4 border-black' : 'text-gray-600' }}">
            Solicitar
        </a> --}}
        <a href="{{ route('transactions.contacts.select') }}"
            class="font-mono text-base px-4 py-2 sm:ml-2 text-center {{ $activo == 'contactos' ? 'text-black border-b-4 border-black' : 'text-gray-600' }}">
            Contactos
        </a>
    </div>
</div>
