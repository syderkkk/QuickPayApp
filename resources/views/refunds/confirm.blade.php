<x-app-layout>
    @include('layouts.navigation')
    
    <div class="bg-[#F0F4F4] min-h-screen py-1">
        <div class="flex justify-center items-start w-full py-4 mt-1">
            <div class="bg-white rounded-2xl max-w-lg w-full shadow-[0_6px_12px_0_#2563eb30] border border-[#e0e7ff]">
                <div class="p-8 text-center">
                    
                    <!-- Icono de éxito -->
                    <div class="mb-6">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Título principal -->
                    <h2 class="font-mono font-extrabold text-2xl text-[#284494] mb-3">
                        ¡Solicitud Enviada!
                    </h2>
                    
                    <!-- Subtítulo -->
                    <p class="font-mono text-base text-gray-600 mb-6 leading-relaxed">
                        Tu solicitud de reembolso ha sido<br>procesada correctamente
                    </p>

                    <!-- Panel informativo -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="bg-green-100 rounded-full p-1 mt-0.5">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 text-left">
                                <div class="font-mono text-sm font-bold text-green-800 mb-1">¿Qué sigue?</div>
                                <div class="font-mono text-xs text-green-700 leading-relaxed">
                                    El destinatario del pago evaluará tu solicitud, verás tu saldo actualizado en caso de ser aceptada. {{-- Recibirás una notificación una vez que se haya tomado una decisión. --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información adicional -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="bg-blue-100 rounded-full p-1 mt-0.5">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 text-left">
                                <div class="font-mono text-sm font-bold text-blue-800 mb-1">Seguimiento</div>
                                <div class="font-mono text-xs text-blue-700 leading-relaxed">
                                    Puedes ver el estado de tu solicitud en la sección de "Reembolsos" de tus transacciones.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="space-y-3">
                        <a href="{{ route('transactions.index', ['tab' => 'reembolsos']) }}"
                           class="block w-full bg-gradient-to-r from-[#2563eb] to-[#1d4ed8] hover:from-[#1d4ed8] hover:to-[#1e40af] text-white font-mono font-bold text-sm py-3.5 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Ver mis Reembolsos
                            </div>
                        </a>
                        
                        <a href="{{ route('transactions.index') }}"
                           class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-mono font-semibold py-3.5 rounded-xl transition-all duration-200 text-sm">
                            Ir a Transacciones
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>