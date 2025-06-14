<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuickPay</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite('resources/css/app.css')
    @endif
</head>

<body class="bg-[#ffffff] min-h-screen flex flex-col">
    <!-- Header -->
    @include('components.header')

    <!-- Hero SOLO con fondo -->
    <section class="flex flex-col items-center justify-start relative overflow-hidden w-full"
        style="min-height: 90vh;">
        <!-- Imagen de fondo decorativa -->
        <img src="{{ asset('home.png') }}" alt="Home Hero"
            class="absolute w-full object-cover object-center opacity-100 pointer-events-none select-none z-0"
            style="top: 120px; height: 600px;" />
        <!-- Degradado superior -->
        <div class="absolute top-[120px] w-full h-32 bg-gradient-to-b from-white to-transparent z-10"></div>
        <!-- Degradado inferior -->
        <div class="absolute top-[calc(120px+600px-128px)] w-full h-32 bg-gradient-to-t from-white/90 to-transparent z-10"></div>

        <div class="relative z-10 w-full flex flex-col items-center pt-8 pb-12 mt-2 px-2 sm:px-0">
            <h1
                class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-center mb-4 mt-0 leading-tight text-[#1a2a3a]">
                Transacciones seguras, sin<br>comisiones
            </h1>
            <a href="#"
                class="mb-2 bg-[#2563eb] text-white px-8 py-4 rounded-full font-bold text-xl sm:text-2xl shadow hover:bg-[#1d4ed8] transition">
                ¡Empieza ahora!
            </a>
        </div>
    </section>

    <!-- Beneficios (fuera del hero, SIN fondo de imagen) -->
    <section id="beneficios"
        class="flex flex-col md:flex-row gap-16 w-full max-w-6xl justify-center mx-auto mt-8 sm:mt-16 relative z-20 px-2">
        <!-- Enviar dinero -->
        <div
            class="bg-[#e8e4ec] rounded-2xl shadow-[0_6px_24px_0_#0C5CAD80] max-w-[220px] w-full mx-auto p-4 flex flex-col items-center text-center font-mono transition hover:scale-105">
            <img src="{{ asset('envia_dinero_facil.png') }}" alt="Enviar dinero"
                class="w-20 h-20 mb-2 select-none pointer-events-none" draggable="false">
            <h2 class="font-bold text-base mb-2">Envía dinero fácil<br>y rápido</h2>
            <p class="text-[#222] text-xs leading-tight">Transfiere dinero a tus amigos, familiares o empresas en
                segundos. Solo necesitas su correo o nombre de usuario. ¡Sin complicaciones!</p>
        </div>
        <!-- Seguridad -->
        <div
            class="bg-[#e8e4ec] rounded-2xl shadow-[0_6px_24px_0_#0C5CAD80] max-w-[220px] w-full mx-auto p-4 flex flex-col items-center text-center font-mono transition hover:scale-105">
            <img src="{{ asset('seguridad_transaccion.png') }}" alt="Seguridad"
                class="w-20 h-20 mb-2 select-none pointer-events-none" draggable="false">
            <h2 class="font-bold text-base mb-2">Seguridad en cada<br>transacción</h2>
            <p class="text-[#222] text-xs leading-tight">Tus pagos están protegidos con tecnología avanzada. Disfruta de
                tranquilidad y soporte en todo momento.</p>
        </div>
        <!-- Ahorra tiempo -->
        <div
            class="bg-[#e8e4ec] rounded-2xl shadow-[0_6px_24px_0_#0C5CAD80] max-w-[220px] w-full mx-auto p-4 flex flex-col items-center text-center font-mono transition hover:scale-105">
            <img src="{{ asset('ahorra_tiempo.png') }}" alt="Ahorra tiempo"
                class="w-20 h-20 mb-2 select-none pointer-events-none" draggable="false">
            <h2 class="font-bold text-base mb-2">Ahorra tiempo</h2>
            <p class="text-[#222] text-xs leading-tight">Olvídate de filas y trámites. Con QuickPay, tus pagos y
                transferencias se hacen en segundos, estés donde estés.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white mt-8 sm:mt-12 py-4 sm:py-6 border-t text-center text-xs sm:text-sm text-[#1a2a3a]">
        <div class="flex flex-col md:flex-row justify-center gap-4 sm:gap-6 mb-2">
            <a href="{{ route('terminos') }}" class="text-[#2563eb] hover:underline">Términos y Condiciones</a>
            <a href="{{ route('privacidad') }}" class="text-[#2563eb] hover:underline">Política de Privacidad</a>
            <a href="mailto:soporte@quickpay.com" class="text-[#2563eb] hover:underline">Correo de contacto</a>
        </div>
        <div class="text-[#888]">&copy; 2025 QuickPay. Todos los derechos reservados.</div>
    </footer>
</body>

</html>
