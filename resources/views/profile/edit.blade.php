<x-app-layout>
    @include('layouts.navigation')

    <div class="bg-[#F0F4F4] min-h-screen pb-0">
        <div class="max-w-4xl mx-auto px-2 sm:px-4 md:px-6 lg:px-8 pt-8">
            <!-- Título -->
            <div class="mb-6 text-center">
                <h1 class="font-mono font-extrabold text-2xl sm:text-3xl text-[#284494] mb-1 drop-shadow-[0_6px_6px_rgba(37,99,235,0.15)]">
                    Editar Perfil
                </h1>
                <p class="text-gray-500 font-mono text-sm">Actualiza tu información personal, cambia tu contraseña o elimina tu cuenta.</p>
            </div>
            <!-- Grilla de formularios -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información de perfil -->
                <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-6 border border-[#e0e7ff] flex flex-col justify-between">
                    <h2 class="font-bold text-lg text-[#2563eb] font-mono mb-4">Información personal</h2>
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" class="font-mono" />
                                <x-text-input id="name" name="name" type="text" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]" :value="old('name', auth()->user()->name)" required autofocus autocomplete="name" placeholder="Nombre" />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="lastname" :value="__('Apellido')" class="font-mono" />
                                <x-text-input id="lastname" name="lastname" type="text" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]" :value="old('lastname', auth()->user()->lastname)" required autocomplete="family-name" placeholder="Apellido" />
                                <x-input-error :messages="$errors->get('lastname')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('País')" class="font-mono" />
                                <select id="country" name="country" required class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm text-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]">
                                    <option value="" disabled>Seleccione su país</option>
                                    <option value="PE" {{ old('country', auth()->user()->country) == 'PE' ? 'selected' : '' }}>Perú</option>
                                    <option value="AR" {{ old('country', auth()->user()->country) == 'AR' ? 'selected' : '' }}>Argentina</option>
                                    <option value="CL" {{ old('country', auth()->user()->country) == 'CL' ? 'selected' : '' }}>Chile</option>
                                    <option value="CO" {{ old('country', auth()->user()->country) == 'CO' ? 'selected' : '' }}>Colombia</option>
                                    <option value="MX" {{ old('country', auth()->user()->country) == 'MX' ? 'selected' : '' }}>México</option>
                                </select>
                                <x-input-error :messages="$errors->get('country')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="phone" :value="__('Teléfono')" class="font-mono" />
                                <x-text-input id="phone" name="phone" type="text" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]" :value="old('phone', auth()->user()->phone)" required autocomplete="tel" placeholder="Teléfono" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="address" :value="__('Dirección de residencia')" class="font-mono" />
                            <x-text-input id="address" name="address" type="text" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]" :value="old('address', auth()->user()->address)" required autocomplete="street-address" placeholder="Dirección de residencia" />
                            <x-input-error :messages="$errors->get('address')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Correo electrónico')" class="font-mono" />
                            <x-text-input id="email" name="email" type="email" class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]" :value="old('email', auth()->user()->email)" required autocomplete="username" placeholder="Correo electrónico" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-2 px-6 font-mono text-sm transition">Guardar cambios</button>
                        </div>
                    </form>
                </div>
                <!-- Cambiar contraseña -->
                <div class="bg-white rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-6 border border-[#e0e7ff] flex flex-col justify-between">
                    <h2 class="font-bold text-lg text-[#2563eb] font-mono mb-4">Cambiar contraseña</h2>
                    <div>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                <!-- Eliminar cuenta (ocupa toda la fila en mobile) -->
                <div class="bg-[#ede8f6] rounded-2xl shadow-[0_6px_12px_0_#2563eb30] p-6 border border-[#e0e7ff] flex flex-col justify-between md:col-span-2 mt-2">
                    <h2 class="font-bold text-lg text-[#d32f2f] font-mono mb-4">Eliminar cuenta</h2>
                    <div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>