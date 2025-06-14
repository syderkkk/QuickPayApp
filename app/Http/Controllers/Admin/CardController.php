<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Card::with('user');

        // Filtro por usuario (nombre, apellido, correo)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por últimos 4 dígitos
        if ($request->filled('last_four')) {
            $query->where('last_four', $request->last_four);
        }

        $cards = $query->orderBy('id', 'desc')->paginate(5)->appends($request->all()); // 9
        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $card = Card::with('user')->findOrFail($id);
        $users = User::all();
        return view('admin.cards.edit', compact('card', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);

        $request->validate([
            'status' => 'required|in:enabled,disabled',
        ]);

        $card->status = $request->status;
        $card->save();

        return redirect()->route('admin.cards.index')->with('success', 'Tarjeta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();

        return redirect()->route('admin.cards.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
