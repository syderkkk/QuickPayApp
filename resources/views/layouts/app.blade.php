<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="QuickPay - Transfiere dinero de forma rápida y segura">
    <meta name="keywords" content="transferencias, pagos, dinero, finanzas, QuickPay">
    <meta name="author" content="QuickPay">
    <meta name="robots" content="index, follow">




    <!-- Optimización para dispositivos móviles -->
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="QuickPay">

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#2563eb">
    <meta name="mobile-web-app-capable" content="yes">

    <title>{{ config('app.name', 'QuickPayApp') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
    * {
        box-sizing: border-box;
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#ffffff]">

        <!-- Page Content -->
        <x-loading />
        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>

</body>

</html>
