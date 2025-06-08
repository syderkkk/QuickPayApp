<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones | QuickPayApp</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    @include('components.header')
    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl w-full bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Términos y Condiciones</h1>
            <p class="text-gray-600 mb-4">
                Bienvenido a <span class="font-semibold">QuickPayApp</span>. Al utilizar nuestra aplicación, aceptas los
                siguientes términos y condiciones. Por favor, léelos cuidadosamente.
            </p>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">1. Uso de la aplicación</h2>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Debes ser mayor de edad para registrarte y utilizar nuestros servicios.</li>
                <li>La información proporcionada debe ser verídica y actualizada.</li>
                <li>No está permitido el uso de la aplicación para actividades ilícitas.</li>
            </ul>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">2. Responsabilidad del usuario</h2>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Eres responsable de mantener la confidencialidad de tus credenciales.</li>
                <li>Debes notificar inmediatamente cualquier uso no autorizado de tu cuenta.</li>
            </ul>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">3. Pagos y transacciones</h2>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Todos los pagos realizados a través de la aplicación son procesados de forma segura.</li>
                <li>No nos hacemos responsables por errores en los datos proporcionados para las transacciones.</li>
            </ul>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">4. Modificaciones</h2>
            <p class="text-gray-600 mb-4">
                Nos reservamos el derecho de modificar estos términos en cualquier momento. Los cambios serán
                notificados a través de la aplicación o por correo electrónico.
            </p>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">5. Propiedad intelectual</h2>
            <p class="text-gray-600 mb-4">
                Todo el contenido y diseño de <span class="font-semibold">QuickPayApp</span> es propiedad exclusiva de
                la empresa y está protegido por las leyes de derechos de autor.
            </p>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">6. Contacto</h2>
            <p class="text-gray-600 mb-4">
                Si tienes dudas sobre estos términos, contáctanos en <a href="mailto:soporte@quickpayapp.com"
                    class="text-blue-600 underline">soporte@quickpayapp.com</a>.
            </p>
        </div>
    </div>
</body>

</html>
