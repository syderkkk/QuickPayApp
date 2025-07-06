<?php

namespace App\Http\Controllers\User\Transactions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function step1()
    {
        return view('transactions.request.step1');
    }

    public function step2(Request $request)
    {
        $request->validate([
            'receiver' => 'required|email|exists:users,email',
        ]);

        $receiver = User::where('email', $request->receiver)->firstOrFail();
        $user = Auth::user();

        if ($receiver->id === $user->id) {
            return redirect()
                ->route('transactions.request.step1')
                ->withInput()
                ->withErrors(['receiver' => 'No puedes solicitarte dinero a ti mismo.']);
        }

        $wallet = $user->wallet;

        return view('transactions.request.step2', [
            'receiver' => $receiver,
            'wallet_currency' => $wallet->currency,
        ]);
    }

    // Falta confirmación de la solicitud
    // Falta lógica para manejar la solicitud de dinero
    public function confirm(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'message' => 'nullable|string|max:255',
        ]);

        $receiver = User::findOrFail($request->receiver_id);
        $user = Auth::user(); 

    }
}
