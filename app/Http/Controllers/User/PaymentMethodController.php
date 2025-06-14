<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cards = Card::where('user_id', Auth::id())->get();
        $banks = Bank::where('user_id', Auth::id())->get();

        $selectedCardId = $request->input('selected_card_id');
        $selectedBankId = $request->input('selected_bank_id');

        // Si el usuario selecciona una tarjeta, la guardamos en sesion y redirigimos
        if ($selectedCardId && $cards->where('id', $selectedCardId)->count()) {
            session(['selected_card_id' => $selectedCardId]);
            session()->forget('selected_bank_id');
            return redirect()->route('payment-methods.index');
        }
        // Si el usuario selecciona una cuenta bancaria, la guardamos en sesion y redirigimos
        if ($selectedBankId && $banks->where('id', $selectedBankId)->count()) {
            session(['selected_bank_id' => $selectedBankId]);
            session()->forget('selected_card_id');
            return redirect()->route('payment-methods.index');
        }

        // Si la seleccionada ya no existe, limpia la sesion
        if (session('selected_card_id') && !$cards->where('id', session('selected_card_id'))->count()) {
            session()->forget('selected_card_id');
        }
        
        // Si la seleccionada ya no existe, limpia la sesion
        if (session('selected_bank_id') && !$banks->where('id', session('selected_bank_id'))->count()) {
            session()->forget('selected_bank_id');
        }

        return view('payment_methods.index', compact('cards', 'banks'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
