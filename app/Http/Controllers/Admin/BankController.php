<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bank::with('user');

        // Filtro por nombre o correo del usuario
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por estado (habilitada/inhabilitada)
        if ($request->filled('is_enabled')) {
            $query->where('is_enabled', $request->is_enabled);
        }

        $banks = $query->paginate(5);

        return view('admin.banks.index', compact('banks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bank = Bank::with('user')->findOrFail($id);
        return view('admin.banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);

        $request->validate([
            'is_enabled' => 'required|boolean',
        ]);

        $bank->is_enabled = $request->is_enabled;
        $bank->save();

        return redirect()->route('admin.banks.index')->with('success', 'Estado de la cuenta bancaria actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return redirect()->route('admin.banks.index')->with('success', 'Cuenta bancaria eliminada correctamente.');
    }
}
