@php
    $user = auth()->user();
    $notifications = $user->notifications()->where('is_active', true)->latest()->take(5)->get();
    $unreadCount = $notifications->count();

    $navLinks = [
        ['name' => 'Inicio', 'route' => 'dashboard'],
        ['name' => 'Enviar y Solicitar', 'route' => 'transactions.send.step1'],
        ['name' => 'Cartera', 'route' => 'payment-methods.index'],
        ['name' => 'Movimientos', 'route' => 'transactions.index'],
    ];
@endphp

<nav x-data="{ open: false }" class="bg-primary w-full font-secondary shadow-lg relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <span class="flex items-center font-extrabold text-white text-2xl select-none">
                Q<span class="ml-1 text-yellow-400 text-3xl -mt-1">⚡</span>
            </span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex flex-1 justify-center">
            <ul class="flex gap-8 items-center">
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}"
                            class="px-5 py-2 rounded-full transition-all duration-200 font-bold uppercase tracking-wide text-base
                            {{ request()->routeIs($link['route'])
                                ? 'bg-white text-primary shadow-lg transform scale-105'
                                : 'text-white hover:bg-white hover:text-primary hover:shadow-lg hover:scale-105' }}">
                            {{ $link['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Desktop Icons -->
        <div class="hidden md:flex items-center gap-6">
            <!-- Notifications -->
            <div x-data="{ openNotif: false }" class="relative">
                <button type="button" @click="openNotif = !openNotif"
                    class="relative text-white hover:text-yellow-400 transition-colors duration-200 p-2 rounded-full hover:bg-white/10"
                    title="Notificaciones">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold animate-pulse">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </button>

                <!-- Notifications Dropdown - Centrado debajo de la campana -->
                <div x-show="openNotif" @click.away="openNotif = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                    class="absolute left-1/2 transform -translate-x-1/2 top-full mt-3 w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 z-50 overflow-hidden">
                    
                    <!-- Arrow centrado -->
                    <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white border-l border-t border-gray-200 rotate-45"></div>
                    
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-primary to-blue-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-white text-lg">Notificaciones</h3>
                            @if($unreadCount > 0)
                                <span class="bg-yellow-400 text-primary px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $unreadCount }} nuevas
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Notifications List -->
                    <div class="max-h-96 overflow-y-auto p-2">
                        <div class="space-y-3" id="notifications-list">
                            @forelse($notifications as $notification)
                                <!-- Card individual para cada notificación -->
                                <div class="notification-item bg-white hover:bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-200 {{ $notification->type === 'request' ? 'cursor-pointer' : '' }}"
                                    id="notif-{{ $notification->id }}"
                                    @if($notification->type === 'request')
                                        onclick="handleNotificationClick({{ $notification->id }}, '{{ $notification->data['request_id'] ?? '' }}')"
                                    @endif>
                                    <div class="flex items-start gap-3">
                                        <!-- Icon based on notification type -->
                                        <div class="flex-shrink-0 mt-1">
                                            @if($notification->type === 'request')
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                    </svg>
                                                </div>
                                            @elseif($notification->type === 'transaction')
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1 pr-2">
                                                    <h4 class="font-semibold text-gray-900 text-sm leading-5 mb-1">
                                                        {{ $notification->title }}
                                                    </h4>
                                                    <p class="text-gray-600 text-sm mb-2">
                                                        {{ $notification->message }}
                                                    </p>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-xs text-gray-500">
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        </span>
                                                        @if($notification->type === 'request')
                                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                                Solicitud
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <!-- Mark as read button -->
                                                <button type="button" 
                                                    class="flex-shrink-0 p-2 rounded-full hover:bg-gray-200 transition-colors duration-200"
                                                    onclick="event.stopPropagation(); markAsRead({{ $notification->id }})"
                                                    title="Marcar como leída">
                                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8" id="notif-empty">
                                    <div class="text-gray-400">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        <p class="text-sm font-medium">No tienes notificaciones nuevas</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" 
                class="text-white hover:text-yellow-400 transition-all duration-200 p-2 rounded-full hover:bg-white/10" 
                title="Perfil">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <mask id="lineMdCogFilled0">
                        <defs>
                            <symbol id="lineMdCogFilled1">
                                <path d="M11 13L15.74 5.5C16.03 5.67 16.31 5.85 16.57 6.05C16.57 6.05 16.57 6.05 16.57 6.05C16.64 6.1 16.71 6.16 16.77 6.22C18.14 7.34 19.09 8.94 19.4 10.75C19.41 10.84 19.42 10.92 19.43 11C19.43 11 19.43 11 19.43 11C19.48 11.33 19.5 11.66 19.5 12z">
                                    <animate fill="freeze" attributeName="d" begin="0.5s" dur="0.2s" values="M11 13L15.74 5.5C16.03 5.67 16.31 5.85 16.57 6.05C16.57 6.05 16.57 6.05 16.57 6.05C16.64 6.1 16.71 6.16 16.77 6.22C18.14 7.34 19.09 8.94 19.4 10.75C19.41 10.84 19.42 10.92 19.43 11C19.43 11 19.43 11 19.43 11C19.48 11.33 19.5 11.66 19.5 12z;M11 13L15.74 5.5C16.03 5.67 16.31 5.85 16.57 6.05C16.57 6.05 19.09 5.04 19.09 5.04C19.25 4.98 19.52 5.01 19.6 5.17C19.6 5.17 21.67 8.75 21.67 8.75C21.77 8.92 21.73 9.2 21.6 9.32C21.6 9.32 19.43 11 19.43 11C19.48 11.33 19.5 11.66 19.5 12z"/>
                                </path>
                            </symbol>
                        </defs>
                        <g fill="none" stroke="#fff" stroke-width="2">
                            <path stroke-dasharray="36" stroke-dashoffset="36" stroke-width="5" d="M12 7c2.76 0 5 2.24 5 5c0 2.76 -2.24 5 -5 5c-2.76 0 -5 -2.24 -5 -5c0 -2.76 2.24 -5 5 -5Z">
                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.5s" values="36;0"/>
                                <set fill="freeze" attributeName="opacity" begin="0.5s" to="0"/>
                            </path>
                            <g fill="#fff" stroke="none" opacity="0">
                                <use href="#lineMdCogFilled1"/>
                                <use href="#lineMdCogFilled1" transform="rotate(60 12 12)"/>
                                <use href="#lineMdCogFilled1" transform="rotate(120 12 12)"/>
                                <use href="#lineMdCogFilled1" transform="rotate(180 12 12)"/>
                                <use href="#lineMdCogFilled1" transform="rotate(240 12 12)"/>
                                <use href="#lineMdCogFilled1" transform="rotate(300 12 12)"/>
                                <set fill="freeze" attributeName="opacity" begin="0.5s" to="1"/>
                            </g>
                        </g>
                        <circle cx="12" cy="12" r="3.5"/>
                    </mask>
                    <rect width="24" height="24" fill="currentColor" mask="url(#lineMdCogFilled0)"/>
                </svg>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-white hover:text-yellow-400 font-bold uppercase text-sm transition-all duration-200 px-3 py-2 rounded-full hover:bg-white/10"
                    title="Cerrar sesión">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m4-8V5a2 2 0 10-4 0v1"/>
                    </svg>
                    <span class="hidden lg:inline">CERRAR SESIÓN</span>
                </button>
            </form>
        </div>

        <!-- Mobile hamburger button -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open" 
                class="text-white focus:outline-none p-2 rounded-full hover:bg-white/10 transition-colors duration-200">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-primary border-t border-white/10">
        
        <!-- Navigation Links -->
        <div class="px-4 pt-4 pb-2">
            <ul class="flex flex-col gap-2">
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}"
                            class="block w-full text-center px-5 py-3 rounded-xl transition-all duration-200 font-bold uppercase tracking-wide text-sm
                            {{ request()->routeIs($link['route'])
                                ? 'bg-white text-primary shadow-lg'
                                : 'text-white hover:bg-white/10 hover:text-yellow-400' }}">
                            {{ $link['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Mobile Actions -->
        <div class="border-t border-white/10 px-4 py-4">
            <div class="flex justify-center gap-8">
                <!-- Mobile Notifications -->
                <div x-data="{ mobileNotifOpen: false }" class="relative">
                    <button type="button" @click="mobileNotifOpen = !mobileNotifOpen"
                        class="relative text-white hover:text-yellow-400 transition-colors duration-200 p-2 rounded-full hover:bg-white/10"
                        title="Notificaciones">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                            </span>
                        @endif
                    </button>
                    
                    <!-- Mobile Notifications Dropdown - Centrado -->
                    <div x-show="mobileNotifOpen" @click.away="mobileNotifOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute left-1/2 transform -translate-x-1/2 top-full mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-200 z-50 max-w-[90vw]">
                        
                        <!-- Arrow centrado -->
                        <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 w-4 h-4 bg-white border-l border-t border-gray-200 rotate-45"></div>
                        
                        <!-- Mobile notifications content -->
                        <div class="bg-gradient-to-r from-primary to-blue-600 px-4 py-3 rounded-t-2xl">
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-white">Notificaciones</h3>
                                @if($unreadCount > 0)
                                    <span class="bg-yellow-400 text-primary px-2 py-1 rounded-full text-xs font-bold">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="max-h-64 overflow-y-auto p-2">
                            <div class="space-y-2">
                                @forelse($notifications as $notification)
                                    <!-- Card individual para mobile -->
                                    <div class="bg-white hover:bg-gray-50 border border-gray-200 rounded-lg p-3 shadow-sm {{ $notification->type === 'request' ? 'cursor-pointer' : '' }}"
                                        @if($notification->type === 'request')
                                            onclick="handleNotificationClick({{ $notification->id }}, '{{ $notification->data['request_id'] ?? '' }}')"
                                        @endif>
                                        <div class="flex items-start gap-2">
                                            <div class="flex-1">
                                                <h4 class="font-medium text-gray-900 text-sm">{{ $notification->title }}</h4>
                                                <p class="text-gray-600 text-xs mt-1">{{ $notification->message }}</p>
                                                <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                            <button onclick="event.stopPropagation(); markAsRead({{ $notification->id }})" 
                                                class="p-1 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-6 text-center text-gray-500 text-sm">
                                        No tienes notificaciones nuevas
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Profile -->
                <a href="{{ route('profile.edit') }}" 
                    class="text-white hover:text-yellow-400 transition-colors duration-200 p-2 rounded-full hover:bg-white/10" 
                    title="Perfil">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.43 12.98l1.77-1.03a2 2 0 000-3.46l-1.77-1.03.34-1.93a2 2 0 00-2.45-2.45l-1.93.34-1.03-1.77a2 2 0 00-3.46 0l-1.03 1.77-1.93-.34a2 2 0 00-2.45 2.45l.34 1.93-1.77 1.03a2 2 0 000 3.46l1.77 1.03-.34 1.93a2 2 0 002.45 2.45l1.93-.34 1.03 1.77a2 2 0 003.46 0l1.03-1.77 1.93.34a2 2 0 002.45-2.45l-.34-1.93z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </a>

                <!-- Mobile Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-white hover:text-yellow-400 transition-colors duration-200 p-2 rounded-full hover:bg-white/10"
                        title="Cerrar sesión">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m4-8V5a2 2 0 10-4 0v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function markAsRead(id) {
        fetch('/notifications/' + id + '/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                const notifElement = document.getElementById('notif-' + id);
                if (notifElement) {
                    notifElement.style.opacity = '0';
                    setTimeout(() => {
                        notifElement.remove();
                        updateNotificationCount();
                        checkEmptyNotifications();
                    }, 200);
                }
            }
        }).catch(error => {
            console.error('Error marking notification as read:', error);
        });
    }

    function markAllAsRead() {
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                // Remove all notification items
                const notificationItems = document.querySelectorAll('.notification-item');
                notificationItems.forEach(item => {
                    item.style.opacity = '0';
                    setTimeout(() => item.remove(), 200);
                });
                
                setTimeout(() => {
                    updateNotificationCount();
                    checkEmptyNotifications();
                }, 300);
            }
        }).catch(error => {
            console.error('Error marking all notifications as read:', error);
        });
    }

    function handleNotificationClick(notificationId, requestId) {
        if (requestId) {
            // Mark as read and redirect
            markAsRead(notificationId);
            window.location.href = '/requests/' + requestId;
        }
    }

    function updateNotificationCount() {
        const remainingNotifications = document.querySelectorAll('.notification-item').length;
        const countBadges = document.querySelectorAll('span[class*="bg-red-500"]');
        
        countBadges.forEach(badge => {
            if (remainingNotifications === 0) {
                badge.style.display = 'none';
            } else {
                badge.textContent = remainingNotifications > 9 ? '9+' : remainingNotifications;
            }
        });
    }

    function checkEmptyNotifications() {
        const notificationsList = document.getElementById('notifications-list');
        const remainingNotifications = document.querySelectorAll('.notification-item').length;
        
        if (remainingNotifications === 0) {
            // Remove existing empty message if any
            const existingEmpty = document.getElementById('notif-empty');
            if (existingEmpty) {
                existingEmpty.remove();
            }
            
            // Add new empty state
            const emptyState = document.createElement('div');
            emptyState.id = 'notif-empty';
            emptyState.className = 'text-center py-8';
            emptyState.innerHTML = `
                <div class="text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-sm font-medium">No tienes notificaciones nuevas</p>
                </div>
            `;
            notificationsList.appendChild(emptyState);
        }
    }
</script>