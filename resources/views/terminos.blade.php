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
                    Términos y Condiciones
                </h1>
                <p class="text-gray-500 font-mono mb-4 text-base text-center">
                    Bienvenido a <span class="font-semibold text-[#2563eb]">QuickPayApp</span>. Al utilizar nuestra aplicación, aceptas los siguientes términos y condiciones. Por favor, léelos cuidadosamente.
                </p>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">1. Uso de la aplicación</h2>
                <ul class="list-disc list-inside text-gray-600 mb-4 font-mono text-base">
                    <li>Debes ser mayor de edad para registrarte y utilizar nuestros servicios.</li>
                    <li>La información proporcionada debe ser verídica y actualizada.</li>
                    <li>No está permitido el uso de la aplicación para actividades ilícitas.</li>
                </ul>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">2. Responsabilidad del usuario</h2>
                <ul class="list-disc list-inside text-gray-600 mb-4 font-mono text-base">
                    <li>Eres responsable de mantener la confidencialidad de tus credenciales.</li>
                    <li>Debes notificar inmediatamente cualquier uso no autorizado de tu cuenta.</li>
                </ul>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">3. Pagos y transacciones</h2>
                <ul class="list-disc list-inside text-gray-600 mb-4 font-mono text-base">
                    <li>Todos los pagos realizados a través de la aplicación son procesados de forma segura.</li>
                    <li>No nos hacemos responsables por errores en los datos proporcionados para las transacciones.</li>
                </ul>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">4. Modificaciones</h2>
                <p class="text-gray-600 mb-4 font-mono text-base">
                    Nos reservamos el derecho de modificar estos términos en cualquier momento. Los cambios serán notificados a través de la aplicación o por correo electrónico.
                </p>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">5. Propiedad intelectual</h2>
                <p class="text-gray-600 mb-4 font-mono text-base">
                    Todo el contenido y diseño de <span class="font-semibold text-[#2563eb]">QuickPayApp</span> es propiedad exclusiva de la empresa y está protegido por las leyes de derechos de autor.
                </p>
                <h2 class="text-xl font-bold text-[#2563eb] font-mono mt-6 mb-2">6. Contacto</h2>
                <p class="text-gray-600 mb-4 font-mono text-base">
                    Si tienes dudas sobre estos términos, contáctanos en
                    <a href="mailto:soporte@quickpayapp.com" class="text-blue-600 underline">soporte@quickpayapp.com</a>.
                </p>
            </div>
        </div>
        <x-footer />
    </div>
</x-app-layout>