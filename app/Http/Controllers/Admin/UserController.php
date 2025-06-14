<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                if (is_numeric($search)) {
                    $q->where('id', $search);
                }
                $q->orWhere('name', 'ILIKE', "%{$search}%")
                    ->orWhere('lastname', 'ILIKE', "%{$search}%")
                    ->orWhere('email', 'ILIKE', "%{$search}%");
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(5);

        return view('admin.users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
            'is_blocked' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_blocked' => $request->is_blocked,
        ]);

        $currency = match ($user->country ?? null) {
            'PE' => 'PEN',
            'AR' => 'ARS',
            'CL' => 'CLP',
            default => 'PEN',
        };

        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
            'currency' => $currency,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'is_blocked' => 'required|boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->is_blocked = $request->is_blocked;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }


    // Metodos personalizados para mostrar relaciones
    public function contacts($id)
    {
        $user = User::with('contacts.contact')->findOrFail($id);
        return view('admin.users.contacts', compact('user'));
    }

    public function paymentMethods($userId)
    {
        $user = User::findOrFail($userId);

        // Ejemplo: si tienes relaciones 'cards' y 'banks'
        $cards = $user->cards ?? collect();
        $banks = $user->banks ?? collect();

        // Unificamos ambos tipos en un solo array/colección
        $methods = $cards->map(function ($card) {
            $card->type = 'card';
            return $card;
        })->concat(
            $banks->map(function ($bank) {
                $bank->type = 'bank';
                return $bank;
            })
        );

        return view('admin.users.payment_methods', compact('user', 'methods'));
    }

    public function transactions($id)
    {
        $user = User::findOrFail($id);

        $transactions = \App\Models\Transaction::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('admin.users.transactions', compact('user', 'transactions'));
    }
}
