<x-app-layout>
    <div class="flex min-h-screen items-center justify-center py-8 px-4">
        <div class="w-full max-w-md bg-[#E8E4EC] rounded-xl shadow p-6 sm:p-8 border border-gray-300">
            <div class="text-center mb-4">
                <h1 class="font-extrabold text-2xl mb-1 font-mono">QuickPay<span class="text-yellow-400">⚡</span></h1>
                <p class="text-gray-500 font-mono text-sm">
                    {{ __('Gracias por registrarte. Antes de comenzar, por favor verifica tu correo electrónico haciendo clic en el enlace que te enviamos. Si no lo recibiste, puedes solicitar otro.') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    {{ __('Un nuevo enlace de verificación ha sido enviado a tu correo electrónico.') }}
                </div>
            @endif

            <div class="mt-4 flex flex-col gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-3 font-mono text-base transition">
                        {{ __('Reenviar correo de verificación') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full block rounded-full border border-gray-400 bg-white text-black font-bold py-3 font-mono text-base text-center hover:bg-gray-100 transition">
                        {{ __('Cerrar sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>