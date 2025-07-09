<?php

namespace App\Http\Controllers\User;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\BankService;
use App\Services\PaymentGatewayService;
use Exception;
use Illuminate\Support\Str;

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
        return view('payment_methods.cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|digits_between:13,19',
            'expiry_month' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => 'required|digits_between:3,4',
            'card_holder' => 'required|string|max:255',
        ]);

        [$month, $year] = explode('/', $request->expiry_month);
        $card_number = preg_replace('/\s+/', '', $request->card_number);

        $gateway = app(PaymentGatewayService::class);
        $user = Auth::user();
        try {
            $result = $gateway->verifyCard($card_number, $request->cvv, $month, '20' . $year, $user->wallet->currency);
        } catch (Exception $e) {
            return back()->withErrors(['card_number' => $e->getMessage()])->withInput();
        }
        
        
        $card = Card::create([
            'user_id' => $user->id,
            'token' => $result['token'],
            'card_holder' => $request->card_holder,
            'brand' => $result['brand'],
            'last_four' => $result['last_four'],
            'is_default' => false,
        ]);

        return view('payment_methods.cards.confirm', ['card' => $card]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('payment_methods.cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        if ($card->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'card_holder' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:50',
        ]);

        $card->card_holder = $request->card_holder;
        $card->nickname = $request->nickname;
        $card->update();

        return redirect()->route('payment-methods.index')->with('success', 'Tarjeta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        if ($card->user_id !== Auth::id()) {
            abort(403);
        }

        $card->delete();
        return redirect()->route('payment-methods.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
