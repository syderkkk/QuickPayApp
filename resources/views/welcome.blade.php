<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuickPay⚡</title>
    @vite('resources/css/app.css')

    <style>
        html {
            scroll-behavior: smooth;
        }

        .fade-in {
            animation: fadeIn 1s cubic-bezier(.4, 0, .2, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .hover-up {
            transition: transform .18s cubic-bezier(.4, 0, .2, 1), box-shadow .18s;
        }

        .hover-up:hover {
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 12px 32px 0 #2563eb30;
        }

        .pulse {
            animation: pulse 1.6s infinite cubic-bezier(.4, 0, .2, 1);
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 #2563eb44;
            }

            50% {
                box-shadow: 0 0 0 8px #2563eb22;
            }
        }
    </style>
</head>

<body class="bg-[#F0F4F4] min-h-screen font-sans flex flex-col">

    <!-- Header -->
    <x-header />


    <!-- HERO -->
    <div class="relative overflow-hidden mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h1
                        class="text-4xl tracking-tight font-extrabold text-[#284494] sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl font-mono">
                        <span class="block xl:inline">Transfiere dinero</span>
                        <span class="block text-[#2563eb] xl:inline">al instante ⚡</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl font-mono">
                        La forma más rápida y segura de enviar y recibir dinero. Sin comisiones ocultas y con la mejor
                        experiencia.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 sm:justify-center lg:justify-start">
                        <a href="{{ route('register') }}"
                            class="bg-[#2563eb] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#1d4ed8] transition shadow-lg hover:shadow-xl text-center font-mono">
                            Comienza gratis
                        </a>
                        <a href="#como-funciona"
                            class="bg-[#ede8f6] text-[#2563eb] px-8 py-4 rounded-xl font-bold hover:bg-[#e0e7ff] transition shadow-lg hover:shadow-xl text-center border border-[#2563eb] font-mono">
                            Ver cómo funciona
                        </a>
                    </div>
                </div>
                <div
                    class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                        <div
                            class="relative block w-full bg-white rounded-2xl shadow-[0_8px_32px_0_rgba(37,99,235,0.2)] overflow-hidden border border-[#e0e7ff]">
                            <div class="p-8">
                                <div class="animate-pulse flex justify-center mb-4">
                                    <span class="text-4xl font-extrabold text-[#2563eb]">Q<span
                                            class="text-yellow-400">⚡</span></span>
                                </div>
                                <div class="text-center space-y-4">
                                    <h3 class="text-xl font-bold text-gray-900 font-mono">Tu balance</h3>
                                    <p class="mt-2 text-3xl font-extrabold text-[#2563eb] font-mono">S/ 0.00</p>
                                    <span
                                        class="inline-block px-4 py-1 text-sm rounded-full bg-[#16a34a] text-white font-mono">
                                        Disponible
                                    </span>
                                    <p class="text-sm text-gray-500 font-mono">Tu dinero siempre seguro y disponible</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BENEFICIOS -->
    <section id="beneficios" class="max-w-6xl mx-auto px-4 py-12 mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 fade-in">
        <div
            class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb20] border border-[#e0e7ff] p-8 flex flex-col items-center text-center hover-up">
            <span class="text-[#2563eb] text-3xl mb-2">⚡</span>
            <h2 class="font-bold text-lg mb-2 text-[#2563eb] font-mono">Rápido e instantáneo</h2>
            <p class="text-gray-600 font-mono">Tus transferencias llegan en segundos, sin esperas ni papeleos.</p>
        </div>
        <div
            class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb20] border border-[#e0e7ff] p-8 flex flex-col items-center text-center hover-up">
            <span class="text-[#2563eb] text-3xl mb-2">💸</span>
            <h2 class="font-bold text-lg mb-2 text-[#2563eb] font-mono">Sin comisiones</h2>
            <p class="text-gray-600 font-mono">Envía y recibe dinero sin pagar de más. ¡Tu dinero es tuyo!</p>
        </div>
        <div
            class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb20] border border-[#e0e7ff] p-8 flex flex-col items-center text-center hover-up">
            <span class="text-[#2563eb] text-3xl mb-2">🔒</span>
            <h2 class="font-bold text-lg mb-2 text-[#2563eb] font-mono">Seguro y confiable</h2>
            <p class="text-gray-600 font-mono">Protección avanzada y privacidad en cada transacción.</p>
        </div>
    </section>

    <!-- CÓMO FUNCIONA -->
    <!-- Cómo Funciona Section -->
    <section id="como-funciona" class="bg-[#ede8f6] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-[#284494] mb-12 font-mono">
                ¿Cómo funciona?
            </h2>
            <div class="relative">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-2xl shadow-[0_8px_32px_0_rgba(37,99,235,0.1)] p-8 border border-[#e0e7ff] group hover:shadow-[0_16px_48px_0_rgba(37,99,235,0.2)] transition-all duration-300">
                        <div class="flex items-center justify-center mb-6">
                            <span
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-[#2563eb] text-white text-2xl font-bold font-mono">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-center text-[#2563eb] mb-4 font-mono">Crea tu cuenta</h3>
                        <p class="text-center text-gray-600 font-mono">Regístrate en menos de 2 minutos</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-[0_8px_32px_0_rgba(37,99,235,0.1)] p-8 border border-[#e0e7ff] group hover:shadow-[0_16px_48px_0_rgba(37,99,235,0.2)] transition-all duration-300">
                        <div class="flex items-center justify-center mb-6">
                            <span
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-[#2563eb] text-white text-2xl font-bold font-mono">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-center text-[#2563eb] mb-4 font-mono">Vincula tus cuentas</h3>
                        <p class="text-center text-gray-600 font-mono">Conecta tus tarjetas o cuentas bancarias
                            fácilmente</p>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-[0_8px_32px_0_rgba(37,99,235,0.1)] p-8 border border-[#e0e7ff] group hover:shadow-[0_16px_48px_0_rgba(37,99,235,0.2)] transition-all duration-300">
                        <div class="flex items-center justify-center mb-6">
                            <span
                                class="flex items-center justify-center h-16 w-16 rounded-full bg-[#2563eb] text-white text-2xl font-bold font-mono">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-center text-[#2563eb] mb-4 font-mono">¡Listo!</h3>
                        <p class="text-center text-gray-600 font-mono">Comienza a enviar y recibir dinero al instante
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="max-w-5xl mx-auto px-4 py-16 fade-in">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-[#284494] mb-10 font-mono">Nuestros usuarios
            opinan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb20] border border-[#e0e7ff] p-6 flex flex-col items-center text-center hover-up">
                <span class="text-3xl mb-2">😊</span>
                <p class="text-gray-700 font-mono mb-2">"¡Rápido y sin complicaciones! Ahora envío dinero a mi familia
                    en segundos."</p>
                <span class="font-bold text-[#2563eb] font-mono text-sm">María G.</span>
            </div>
            <div
                class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb20] border border-[#e0e7ff] p-6 flex flex-col items-center text-center hover-up">
                <span class="text-3xl mb-2">👍</span>
                <p class="text-gray-700 font-mono mb-2">"La seguridad y la facilidad de uso me sorprendieron.
                    ¡Recomendado!"</p>
                <span class="font-bold text-[#2563eb] font-mono text-sm">Carlos P.</span>
            </div>
            <div
                class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb20] border border-[#e0e7ff] p-6 flex flex-col items-center text-center hover-up">
                <span class="text-3xl mb-2">😍</span>
                <p class="text-gray-700 font-mono mb-2">"La mejor app para transferencias. Sin comisiones y súper
                    intuitiva."</p>
                <span class="font-bold text-[#2563eb] font-mono text-sm">Lucía R.</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />
</body>

</html>
