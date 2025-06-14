<header>
    <nav class="fixed w-full bg-white/80 backdrop-blur-md border-b border-[#e0e7ff] z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ url('/') }}"
                        class="text-2xl font-extrabold text-[#2563eb] hover:text-[#1d4ed8] transition">
                        Q<span class="text-yellow-400">⚡</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beneficios" class="text-gray-700 hover:text-[#2563eb] transition font-mono">Beneficios</a>
                    <a href="#como-funciona" class="text-gray-700 hover:text-[#2563eb] transition font-mono">Cómo
                        funciona</a>
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-[#2563eb] transition font-mono">Iniciar sesión</a>
                    <a href="{{ route('register') }}"
                        class="bg-[#2563eb] text-white px-6 py-2 rounded-xl font-bold hover:bg-[#1d4ed8] transition shadow-lg hover:shadow-xl font-mono">
                        Crear cuenta
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
