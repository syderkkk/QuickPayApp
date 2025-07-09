<header>
    <nav class="fixed w-full bg-white/80 backdrop-blur-md border-b border-[#e0e7ff] z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-extrabold text-[#2563eb] hover:text-[#1d4ed8] transition-colors duration-200">
                        Q<span class="text-yellow-400">⚡</span>
                    </a>
                </div>

                <!-- Desktop Navigation - Centrado -->
                <div class="hidden md:flex items-center justify-center flex-1 mx-8">
                    <div class="flex items-center space-x-8">
                        <a href="#beneficios" class="text-gray-700 hover:text-[#2563eb] transition-colors duration-200 font-mono relative group">
                            Beneficios
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#2563eb] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="#como-funciona" class="text-gray-700 hover:text-[#2563eb] transition-colors duration-200 font-mono relative group">
                            Cómo funciona
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#2563eb] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </div>
                </div>

                <!-- Desktop Auth Links -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#2563eb] transition-colors duration-200 font-mono">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" class="bg-[#2563eb] text-white px-6 py-2 rounded-xl font-bold hover:bg-[#1d4ed8] transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105 transform font-mono">
                        Crear cuenta
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-[#2563eb] focus:outline-none transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100">
                        <svg id="menu-icon" class="h-6 w-6 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="close-icon" class="h-6 w-6 transition-transform duration-300 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white/95 backdrop-blur-md border-t border-[#e0e7ff] shadow-lg">
                    <a href="#beneficios" class="block px-3 py-3 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded-lg transition-all duration-200 font-mono transform hover:translate-x-2">
                        Beneficios
                    </a>
                    <a href="#como-funciona" class="block px-3 py-3 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded-lg transition-all duration-200 font-mono transform hover:translate-x-2">
                        Cómo funciona
                    </a>
                    <a href="{{ route('login') }}" class="block px-3 py-3 text-gray-700 hover:text-[#2563eb] hover:bg-gray-50 rounded-lg transition-all duration-200 font-mono transform hover:translate-x-2">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-3 mx-3 mt-3 bg-[#2563eb] text-white rounded-xl font-bold hover:bg-[#1d4ed8] transition-all duration-200 shadow-lg text-center font-mono hover:shadow-xl transform hover:scale-105">
                        Crear cuenta
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- JavaScript mínimo para el menú hamburguesa -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            let isOpen = false;

            function toggleMenu() {
                isOpen = !isOpen;
                
                if (isOpen) {
                    menu.classList.remove('max-h-0', 'opacity-0');
                    menu.classList.add('max-h-96', 'opacity-100');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                } else {
                    menu.classList.remove('max-h-96', 'opacity-100');
                    menu.classList.add('max-h-0', 'opacity-0');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            }

            button.addEventListener('click', toggleMenu);
            
            // Cerrar menú al hacer clic en enlaces
            menu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    if (isOpen) toggleMenu();
                });
            });

            // Cerrar menú al hacer clic fuera
            document.addEventListener('click', (e) => {
                if (isOpen && !button.contains(e.target) && !menu.contains(e.target)) {
                    toggleMenu();
                }
            });
        });
    </script>

    <style>
        /* Asegurar transiciones suaves */
        #mobile-menu {
            transition-property: max-height, opacity;
            transition-duration: 300ms;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</header>