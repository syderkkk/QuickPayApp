<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 250)">
    <!-- Loading Screen -->
    <div x-show="loading" x-transition.opacity style="z-index:9999"
         class="fixed inset-0 flex flex-col items-center justify-center h-screen bg-gradient-to-br from-gray-50 to-gray-100 text-center transition px-4 sm:px-6 lg:px-8">
        
        <!-- Loading Container -->
        <div class="flex flex-col items-center justify-center space-y-6 sm:space-y-8 max-w-sm mx-auto">
            
            <!-- Enhanced Spinner with Pulse Effect -->
            <div class="relative">
                <!-- Outer pulse ring -->
                <div class="absolute inset-0 w-16 h-16 sm:w-20 sm:h-20 border-2 border-blue-200 rounded-full animate-ping opacity-75"></div>
                <!-- Main spinner -->
                <div class="relative w-16 h-16 sm:w-20 sm:h-20 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin shadow-lg"></div>
                <!-- Inner dot -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-2 h-2 sm:w-3 sm:h-3 bg-blue-500 rounded-full animate-pulse"></div>
                </div>
            </div>
            
            <!-- Loading Text -->
            <div class="text-center">
                <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-700">
                    Cargando contenido...
                </h3>
            </div>
            
        </div>
        
        <!-- Subtle Background Pattern (Optional) -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(59,130,246,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div x-show="!loading" x-transition>
        <slot></slot>
    </div>
</div>

<!-- Custom CSS for additional animations -->
<style>
    @keyframes progress {
        0% { width: 0%; }
        50% { width: 100%; }
        100% { width: 0%; }
    }
    
    /* Improved animations for better performance */
    @media (prefers-reduced-motion: reduce) {
        .animate-spin, .animate-bounce, .animate-pulse, .animate-ping {
            animation: none;
        }
    }
    
    /* Enhanced hover effects for interactive elements */
    .loading-container:hover .animate-spin {
        animation-duration: 0.5s;
    }
</style>