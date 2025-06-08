@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen items-center justify-center py-4 px-2">
        <div class="w-full max-w-md bg-[#E8E4EC] rounded-lg shadow p-4 border border-gray-300">
            <div class="text-center mb-2">
                <h1 class="font-extrabold text-xl mb-1 font-mono">QuickPay<span class="text-yellow-400">⚡</span></h1>
                <p class="text-gray-500 font-mono text-sm">Regístrate para enviar y recibir dinero.</p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="w-full">
                        <x-input-label for="name" :value="__('Nombre')" class="sr-only" />
                        <x-text-input id="name"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Nombre" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="lastname" :value="__('Apellido')" class="sr-only" />
                        <x-text-input id="lastname"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                            type="text" name="lastname" :value="old('lastname')" required autocomplete="family-name"
                            placeholder="Apellido" />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" class="sr-only" />
                    <x-text-input id="email"
                        class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Correo electrónico" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="w-full">
                        <x-input-label for="country" :value="__('País')" class="sr-only" />
                        <select id="country" name="country" required
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm text-gray-500 placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]">
                            <option value="" disabled {{ old('country') ? '' : 'selected' }}>Seleccione su país
                            </option>
                            <option value="PE" {{ old('country') == 'PE' ? 'selected' : '' }}>Perú</option>
                            <option value="AR" {{ old('country') == 'AR' ? 'selected' : '' }}>Argentina</option>
                            <option value="CL" {{ old('country') == 'CL' ? 'selected' : '' }}>Chile</option>
                            <option value="CO" {{ old('country') == 'CO' ? 'selected' : '' }}>Colombia</option>
                            <option value="MX" {{ old('country') == 'MX' ? 'selected' : '' }}>México</option>
                        </select>
                        <x-input-error :messages="$errors->get('country')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="phone" :value="__('Teléfono')" class="sr-only" />
                        <x-text-input id="phone"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                            type="text" name="phone" :value="old('phone')" required autocomplete="tel"
                            placeholder="Teléfono" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="address" :value="__('Dirección de residencia')" class="sr-only" />
                    <x-text-input id="address"
                        class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                        type="text" name="address" :value="old('address')" required autocomplete="street-address"
                        placeholder="Dirección de residencia" />
                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="w-full">
                        <x-input-label for="password" :value="__('Contraseña')" class="sr-only" />
                        <x-text-input id="password"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                            type="password" name="password" required autocomplete="new-password" placeholder="Contraseña" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="sr-only" />
                        <x-text-input id="password_confirmation"
                            class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 font-mono text-sm placeholder-gray-400 focus:ring-2 focus:ring-[#2563eb] focus:border-[#2563eb]"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirmar contraseña" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                </div>

                <div class="space-y-2 mt-1">
                    <button type="submit"
                        class="w-full rounded-full bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold py-2 font-mono text-sm transition">Registrarse</button>
                    <a href="{{ url('/') }}"
                        class="w-full block rounded-full border border-gray-400 bg-white text-black font-bold py-2 font-mono text-sm text-center hover:bg-gray-100 transition">Cancelar</a>
                </div>
            </form>
            <div class="mt-4 text-center">
                <span class="text-xs text-gray-400 font-mono">¿Ya tienes una cuenta?</span>
                <a href="{{ route('login') }}"
                    class="text-xs text-[#2563eb] font-mono font-semibold hover:underline ml-1">Inicia sesión</a>
            </div>
        </div>
    </div>
@endsection
