<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_methods.banks.create');
    }
}
