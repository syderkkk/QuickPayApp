<header class="z-10 py-4 bg-white shadow-md border-b border-[#e0e7ff]">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-[#284494]">
        <!-- Mostrar nombre y apellido del usuario autenticado -->
        <div class="flex items-center gap-3">
            <img class="object-cover w-8 h-8 rounded-full border-2 border-[#2563eb]"
                src="{{ asset('avatar-2.jpg') }}" alt="" aria-hidden="true" />
            <span class="font-bold text-base">
                {{ auth()->user()->name }} {{ auth()->user()->lastname }}
            </span>
        </div>
    </div>
</header>