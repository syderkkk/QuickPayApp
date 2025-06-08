<x-app-layout>
    <div class="flex min-h-screen items-center justify-center py-8 px-4">
        <div class="w-full max-w-md bg-[#E8E4EC] rounded-xl shadow p-6 sm:p-8 border border-gray-300">
            <div class="text-center mb-4">
                <h1 class="font-extrabold text-2xl mb-1 font-mono">QuickPay<span class="text-yellow-400">⚡</span></h1>
                <p class="text-gray-500 font-mono text-sm">
                    ¿Olvidaste tu contraseña? Ingresa tu correo y te enviaremos un enlace para restablecerla.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" class="sr-only" />
                    <x-text-input id="email"
                        class="block w-full rounded-md border border-gray-300 bg-white py-3 px-4 font-mono text-base placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="Correo electrónico" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="space-y-3 mt-2">
                    <button type="submit"
                        class="w-full rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3 font-mono text-base transition">
                        Enviar enlace de restablecimiento
                    </button>
                    <a href="{{ url('/') }}"
                        class="w-full block rounded-full border border-gray-400 bg-white text-black font-bold py-3 font-mono text-base text-center hover:bg-gray-100 transition">Cancelar</a>
                </div>
            </form>

            <div class="mt-6 text-center">
                <span class="text-xs text-gray-400 font-mono">¿Recuerdas tu contraseña?</span>
                <a href="{{ route('login') }}"
                    class="text-xs text-[#2563eb] font-mono font-semibold hover:underline ml-1">Inicia sesión</a>
            </div>
        </div>
    </div>
</x-app-layout>