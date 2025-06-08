<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 250)">
    <div x-show="loading" x-transition.opacity style="z-index:9999"
        class="fixed inset-0 flex flex-col items-center justify-center h-screen bg-gray-100 text-center transition">
        <div class="w-12 h-12 border-4 border-gray-300 border-t-blue-500 rounded-full animate-spin"></div>
        <p class="mt-4 text-lg font-medium text-gray-700">
            Cargando contenido...
        </p>
    </div>
    <div x-show="!loading" x-transition>
        <slot></slot>
    </div>
</div>