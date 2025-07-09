@php
    $alerts = collect([
        'success' => session('success'),
        'info' => session('info'),
        'warning' => session('warning'),
        'error' => $errors->any() ? $errors->all() : null
    ])->filter()->toArray();
@endphp

@if(!empty($alerts))
    <div class="mb-4 space-y-2">
        @foreach($alerts as $type => $message)
            @php
                $config = [
                    'success' => [
                        'bg' => 'bg-green-500',
                        'text' => 'text-white',
                        'icon' => 'M5 13l4 4L19 7'
                    ],
                    'info' => [
                        'bg' => 'bg-blue-500',
                        'text' => 'text-white',
                        'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                    ],
                    'warning' => [
                        'bg' => 'bg-yellow-500',
                        'text' => 'text-white',
                        'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.736 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z'
                    ],
                    'error' => [
                        'bg' => 'bg-red-500',
                        'text' => 'text-white',
                        'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                    ]
                ][$type];
            @endphp
            
            <div class="alert-banner {{ $config['bg'] }} {{ $config['text'] }} rounded-lg shadow-sm p-3 transform transition-all duration-300 ease-out opacity-0 -translate-y-2">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                    </svg>
                    
                    <div class="flex-1 min-w-0">
                        @if($type === 'error' && is_array($message))
                            <div class="text-sm font-medium">
                                @if(count($message) === 1)
                                    {{ $message[0] }}
                                @else
                                    {{ count($message) }} errores encontrados
                                    <div class="mt-1 text-xs opacity-90">
                                        {{ implode(', ', array_slice($message, 0, 2)) }}
                                        @if(count($message) > 2)
                                            y {{ count($message) - 2 }} más...
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-sm font-medium truncate">{{ $message }}</div>
                        @endif
                    </div>
                    
                    <button onclick="this.parentElement.parentElement.remove()" 
                            class="flex-shrink-0 p-1 hover:bg-black hover:bg-opacity-10 rounded transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .alert-banner {
            animation: slideDown 0.3s ease-out forwards;
        }
        
        @keyframes slideDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeUp {
            to {
                opacity: 0;
                transform: translateY(-8px);
            }
        }
        
        .alert-banner[data-auto-dismiss="true"] {
            animation: slideDown 0.3s ease-out forwards;
        }
    </style>

    <script>
        // Las alertas solo se eliminan manualmente con el botón X
        // No hay auto-dismiss
    </script>
@endif

{{-- @php
    $alerts = collect([
        'success' => session('success'),
        'info' => session('info'),
        'warning' => session('warning'),
        'error' => $errors->any() ? $errors->all() : null
    ])->filter()->toArray();
@endphp

@if(!empty($alerts))
    <div class="mb-4 space-y-2">
        @foreach($alerts as $type => $message)
            @php
                $config = [
                    'success' => [
                        'bg' => 'bg-green-500',
                        'text' => 'text-white',
                        'icon' => 'M5 13l4 4L19 7'
                    ],
                    'info' => [
                        'bg' => 'bg-blue-500',
                        'text' => 'text-white',
                        'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                    ],
                    'warning' => [
                        'bg' => 'bg-yellow-500',
                        'text' => 'text-white',
                        'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.966-.833-2.736 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z'
                    ],
                    'error' => [
                        'bg' => 'bg-red-500',
                        'text' => 'text-white',
                        'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                    ]
                ][$type];
            @endphp
            
            <div class="alert-banner {{ $config['bg'] }} {{ $config['text'] }} rounded-lg shadow-sm p-3 transform transition-all duration-300 ease-out opacity-0 -translate-y-2" 
                 data-auto-dismiss="true">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                    </svg>
                    
                    <div class="flex-1 min-w-0">
                        @if($type === 'error' && is_array($message))
                            <div class="text-sm font-medium">
                                @if(count($message) === 1)
                                    {{ $message[0] }}
                                @else
                                    {{ count($message) }} errores encontrados
                                    <div class="mt-1 text-xs opacity-90">
                                        {{ implode(', ', array_slice($message, 0, 2)) }}
                                        @if(count($message) > 2)
                                            y {{ count($message) - 2 }} más...
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-sm font-medium truncate">{{ $message }}</div>
                        @endif
                    </div>
                    
                    <button onclick="this.parentElement.parentElement.remove()" 
                            class="flex-shrink-0 p-1 hover:bg-black hover:bg-opacity-10 rounded transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .alert-banner {
            animation: slideDown 0.3s ease-out forwards, fadeUp 0.3s ease-out 2.7s forwards;
        }
        
        @keyframes slideDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeUp {
            to {
                opacity: 0;
                transform: translateY(-8px);
            }
        }
        
        .alert-banner[data-auto-dismiss="true"] {
            animation: slideDown 0.3s ease-out forwards, fadeUp 0.3s ease-out 2.7s forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-banner');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert.parentElement) {
                        alert.remove();
                    }
                }, 3000);
            });
        });
    </script>
@endif --}}