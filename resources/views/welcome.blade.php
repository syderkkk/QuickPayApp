<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuickPay</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite('resources/css/app.css')
    @endif
</head>
<body class="bg-[#f6faff] min-h-screen flex flex-col">
    <!-- Header -->
    <header class="flex items-center justify-between px-8 py-6 bg-white shadow">
        <div class="flex items-center gap-2">
            <span class="font-bold text-xl text-[#1a2a3a]">QuickPay</span>
        </div>
        <nav class="flex items-center gap-8">
            <a href="#" class="text-[#1a2a3a] font-medium hover:underline">Cómo funciona</a>
            <a href="{{ route('login') }}" class="text-[#1a2a3a] font-medium hover:underline">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="bg-[#2563eb] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#1d4ed8] transition">Registrarse</a>
        </nav>
    </header>

    <!-- Hero -->
    <section class="flex flex-col items-center justify-center flex-1 px-4 py-10">
        <h1 class="text-4xl md:text-5xl font-extrabold text-center mb-4 mt-8">Transacciones seguras, sin<br>comisiones</h1>
        <a href="#" class="mt-4 mb-8 bg-[#2563eb] text-white px-6 py-3 rounded-full font-bold text-lg shadow hover:bg-[#1d4ed8] transition">¡Empieza ahora!</a>
        <!-- Imagen ilustrativa -->
        <div class="w-full flex justify-center mb-10">
            <img src="{{ asset('ilustracion.png') }}" alt="Descripción" />
        </div>
        <!-- Beneficios -->
        <div class="flex flex-col md:flex-row gap-6 w-full max-w-5xl justify-center">
            <div class="bg-white rounded-2xl shadow p-6 flex-1 flex flex-col items-center text-center">
                <img src="https://raw.githubusercontent.com/ricardoolivaalonso/assets/main/quickpay-send.svg" alt="Enviar dinero" class="w-14 h-14 mb-3" />
                <h2 class="font-bold text-lg mb-2">Envía dinero fácil y rápido</h2>
                <p class="text-[#555]">Transfiere dinero a tus amigos, familia o negocios en segundos, sin complicaciones ni comisiones.</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 flex-1 flex flex-col items-center text-center">
                <img src="https://raw.githubusercontent.com/ricardoolivaalonso/assets/main/quickpay-secure.svg" alt="Seguridad" class="w-14 h-14 mb-3" />
                <h2 class="font-bold text-lg mb-2">Seguridad en cada transacción</h2>
                <p class="text-[#555]">Tus pagos están protegidos con tecnología de seguridad y verificación en todo momento.</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 flex-1 flex flex-col items-center text-center">
                <img src="https://raw.githubusercontent.com/ricardoolivaalonso/assets/main/quickpay-time.svg" alt="Ahorra tiempo" class="w-14 h-14 mb-3" />
                <h2 class="font-bold text-lg mb-2">Ahorra tiempo</h2>
                <p class="text-[#555]">Olvídate de filas y trámites. Con QuickPay, tu dinero se transfiere y recibe donde sea, cuando sea.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white mt-12 py-6 border-t text-center text-sm text-[#1a2a3a]">
        <div class="flex flex-col md:flex-row justify-center gap-6 mb-2">
            <a href="#" class="text-[#2563eb] hover:underline">Términos y Condiciones</a>
            <a href="#" class="text-[#2563eb] hover:underline">Política de Privacidad</a>
            <a href="#" class="text-[#2563eb] hover:underline">Correo de contacto</a>
        </div>
        <div class="text-[#888]">&copy; 2025 QuickPay. Todos los derechos reservados.</div>
    </footer>
</body>
</html>