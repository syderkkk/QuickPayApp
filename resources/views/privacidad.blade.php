<x-app-layout>
    @auth
        @include('layouts.navigation')
    @else
        @include('components.header')
    @endauth

    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-3xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-12">
            <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-8 border border-[#e0e7ff]">
                <h1 class="font-mono font-extrabold text-2xl sm:text-3xl text-[#284494] mb-6 text-center drop-shadow-[0_6px_6px_rgba(37,99,235,0.15)]">
                    Política de Privacidad
                </h1>
                <p class="text-gray-500 font-mono mb-4 text-base text-center">
                    En <span class="font-semibold text-[#2563eb]">QuickPayApp</span>, valoramos y protegemos tu privacidad. Esta política describe cómo recopilamos, usamos y protegemos tu información personal.
                </p>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">1. Información que recopilamos</h2>
                <ul class="list-disc list-inside text-gray-600 mb-4 font-mono text-base">
                    <li>Datos personales como nombre, correo electrónico y número de teléfono.</li>
                    <li>Información de pago y transacciones.</li>
                    <li>Datos de uso y navegación dentro de la aplicación.</li>
                </ul>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">2. Uso de la información</h2>
                <ul class="list-disc list-inside text-gray-600 mb-4 font-mono text-base">
                    <li>Procesar pagos y transacciones de manera segura.</li>
                    <li>Mejorar la experiencia del usuario y nuestros servicios.</li>
                    <li>Enviar notificaciones importantes relacionadas con tu cuenta.</li>
                </ul>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">3. Protección de datos</h2>
                <p class="text-gray-600 mb-4 font-mono text-base">
                    Implementamos medidas de seguridad técnicas y organizativas para proteger tu información contra accesos no autorizados, alteraciones o destrucción.
                </p>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">4. Compartir información</h2>
                <p class="text-gray-600 mb-4 font-mono text-base">
                    No compartimos tu información personal con terceros, salvo cuando sea necesario para cumplir con la ley o procesar tus transacciones.
                </p>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">5. Tus derechos</h2>
                <ul class="list-disc list-inside text-gray-600 mb-4 font-mono text-base">
                    <li>Acceder, corregir o eliminar tus datos personales.</li>
                    <li>Solicitar la limitación del uso de tus datos.</li>
                    <li>Retirar tu consentimiento en cualquier momento.</li>
                </ul>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">6. Cambios en la política</h2>
                <p class="text-gray-600 mb-4 font-mono text-base">
                    Nos reservamos el derecho de actualizar esta política. Notificaremos cualquier cambio a través de la aplicación o por correo electrónico.
                </p>
                <p class="text-gray-600 mt-8 text-sm text-center font-mono">
                    Si tienes preguntas sobre nuestra política de privacidad, contáctanos en
                    <a href="mailto:soporte@quickpayapp.com" class="text-blue-600 underline">soporte@quickpayapp.com</a>.
                </p>
            </div>
        </div>
        <x-footer />
    </div>
</x-app-layout>