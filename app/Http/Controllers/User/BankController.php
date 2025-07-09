<?php

namespace App\Http\Controllers\User;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Services\BankService;
use App\Services\PaymentGatewayService;
use Exception;

class BankController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Auth::user()->banks;
        return view('banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_methods.banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'swift_code' => 'required|string|min:8',
            'account_number' => 'required|digits_between:13,19',
            'account_type' => 'required|in:corriente,ahorros',
            'currency' => 'required|in:PEN,USD',
            'document_number' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'billing_address' => 'required|string|max:255'
        ]);

        $gateway = app(PaymentGatewayService::class);
        $user = Auth::user();

        try {
            $availableBankAccount = $gateway->verifyBankAccount($request->account_number, $user->wallet->currency);
        } catch (Exception $e) {
            return back()->withErrors(['account_number' => $e->getMessage()])->withInput();
        }

        Bank::create([
            'user_id' => $user->id,
            'bank_name' => $request->bank_name,
            'swift_code' => $request->swift_code,
            'account_type' => $request->account_type,
            'account_number' => $request->account_number,
            'currency' => $request->currency,
            'document_number' => $request->document_number,
            'phone' => $request->phone,
            'billing_address' => $request->billing_address,
        ]);

        return view('payment_methods.banks.confirm', ['bankName' => $request->bank_name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('payment_methods.banks.edit', compact('bank'));
    }


    public function update(Request $request, Bank $bank)
    {
        if ($bank->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'phone' => 'required|string|max:15',
            'billing_address' => 'required|string|max:255'
        ]);

        $bank->phone = $request->phone;
        $bank->billing_address = $request->billing_address;
        $bank->update();

        return redirect()->route('payment-methods.index')->with('success', 'Cuenta bancaria actualizada.');
    }

    public function destroy(Bank $bank)
    {
        if ($bank->user_id !== Auth::id()) {
            abort(403);
        }

        $bank->delete();
        return redirect()->route('payment-methods.index')->with('success', 'Tarjeta eliminada correctamente.');
    }
}
