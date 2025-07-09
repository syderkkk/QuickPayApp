<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\TimezoneHelper;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = Country::all();
        return view('auth.register', compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:2'],
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $timezone = TimezoneHelper::getTimezoneByCountry($request->country);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'country' => $request->country,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'timezone' => $timezone,
            'password' => Hash::make($request->password),
        ]);

        $currency = match ($user->country) {
            'AR' => 'ARS', // Argentina - Peso argentino
            'BO' => 'BOB', // Bolivia - Boliviano
            'BR' => 'BRL', // Brasil - Real brasileño
            'CL' => 'CLP', // Chile - Peso chileno
            'CO' => 'COP', // Colombia - Peso colombiano
            'CR' => 'CRC', // Costa Rica - Colón costarricense
            'CU' => 'CUP', // Cuba - Peso cubano
            'DO' => 'DOP', // República Dominicana - Peso dominicano
            'EC' => 'USD', // Ecuador - Dólar estadounidense
            'SV' => 'USD', // El Salvador - Dólar estadounidense 
            'GT' => 'GTQ', // Guatemala - Quetzal
            'HN' => 'HNL', // Honduras - Lempira
            'MX' => 'MXN', // México - Peso mexicano
            'NI' => 'NIO', // Nicaragua - Córdoba
            'PA' => 'USD', // Panamá - Dólar estadounidense
            'PY' => 'PYG', // Paraguay - Guaraní
            'PE' => 'PEN', // Perú - Sol
            'PR' => 'USD', // Puerto Rico - Dólar estadounidense
            'UY' => 'UYU', // Uruguay - Peso uruguayo
            'VE' => 'VES', // Venezuela - Bolívar soberano
            default => 'PEN', // Valor por defecto
        };

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'currency' => $currency,
        ]);



        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
