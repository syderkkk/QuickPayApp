<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Auth::user()->cards;
        return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_holder' => 'required|string|max:255',
            'card_number' => 'required|digits_between:13,19',
            'expiry_month' => 'required|digits:2',
            'expiry_year' => 'required|digits:4',
        ]);

        $user = Auth::user();
        Card::create([
            'user_id' => $user->id,
            'card_holder' => $request->card_holder,
            'card_number' => $request->card_number,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'brand' => 'Visa', // Aquí podrías integrar una API para detectar la marca
            'last_four' => substr($request->card_number, -4),
            'is_default' => false, // Por defecto, no es la tarjeta principal
        ]);
    
        return redirect()->route('cards.index')->with('success', 'Tarjeta añadida correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
