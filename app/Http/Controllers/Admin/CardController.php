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
    public function index()
    {
        $cards = Card::with('user')->orderBy('id', 'desc')->paginate(20);
        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $card = Card::with('user')->findOrFail($id);
        return view('admin.cards.show', compact('card'));
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
            'card_holder' => 'required|string|max:255',
            'brand' => 'nullable|string|max:50',
            'is_default' => 'boolean',
            'nickname' => 'nullable|string|max:50',
        ]);

        $card->card_holder = $request->card_holder;
        $card->brand = $request->brand;
        $card->is_default = $request->is_default ?? false;
        $card->nickname = $request->nickname;
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
