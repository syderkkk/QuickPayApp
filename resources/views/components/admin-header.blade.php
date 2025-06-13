<header class="z-10 py-4 bg-white shadow-md border-b border-[#e0e7ff]">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-[#284494]">
        <div class="flex justify-center flex-1 lg:mr-32">
            <div class="relative w-full max-w-xl mr-6 focus-within:text-[#2563eb]">
                <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input
                    class="w-full pl-8 pr-2 text-sm text-[#284494] placeholder-[#b3b8d0] bg-[#ede8f6] border-0 rounded-md focus:bg-white focus:border-[#2563eb] focus:outline-none focus:shadow-outline-purple form-input"
                    type="text" placeholder="Buscar en el dashboard" aria-label="Buscar" />
            </div>
        </div>
        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Profile menu -->
            <li class="relative">
                <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                    aria-haspopup="true">
                    <img class="object-cover w-8 h-8 rounded-full border-2 border-[#2563eb]"
                        src="{{ asset('avatar-2.jpg') }}" alt="" aria-hidden="true" />
                </button>
            </li>
        </ul>
    </div>
</header>
