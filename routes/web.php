<?php

// Rutas públicas
require __DIR__.'/web/public.php';

// Rutas autenticadas (usuario)
require __DIR__.'/web/user.php';

// Rutas de administrador
require __DIR__.'/web/admin.php';

// Auth (Laravel Breeze)
require __DIR__ . '/auth.php';
