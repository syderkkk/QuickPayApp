<x-app-layout>
    <div class="flex min-h-screen items-center justify-center py-8 px-4">
        <div class="w-full max-w-md bg-[#E8E4EC] rounded-xl shadow p-6 sm:p-8 border border-gray-300">
            <div class="text-center mb-4">
                <h1 class="font-extrabold text-2xl mb-1 font-mono">QuickPay<span class="text-yellow-400">⚡</span></h1>
                <p class="text-gray-500 font-mono text-sm">
                    {{ __('Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" class="sr-only" />
                    <x-text-input id="password"
                        class="block w-full rounded-md border border-gray-300 bg-white py-3 px-4 font-mono text-base placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="Contraseña" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="w-full rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3 font-mono text-base transition">
                        {{ __('Confirmar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
