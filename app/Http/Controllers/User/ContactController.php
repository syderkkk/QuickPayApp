<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Auth::user()->contacts;
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_email' => 'required|email|exists:users,email|not_in:' . Auth::user()->email,
        ]);

        $contactUser = User::where('email', $request->contact_email)->firstOrFail();

        $exists = Contact::where('user_id', Auth::id())
            ->where('contact_id', $contactUser->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['contact_email' => 'Este contacto ya está agregado.'])->withInput();
        }

        Contact::create([
            'user_id' => Auth::id(),
            'contact_id' => $contactUser->id,
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contacto agregado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::with('user')->findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'alias' => 'nullable|string|max:255',
        ]);
        $contact->alias = $request->alias;
        $contact->update();

        return redirect()->route('contacts.index')->with('success', 'Alias actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contacto eliminado correctamente.');
    }
}
