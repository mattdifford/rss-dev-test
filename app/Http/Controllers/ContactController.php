<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        return Inertia::render('Contacts/Index', [
            'contacts' => Contact::with(['account'])->get()
        ]);
    }

    public function show(Request $request)
    {
        $contact = Contact::with(['account'])->where('id', $request->route('contact'))->first();
        return Inertia::render('Contacts/Show', [
            'contact' => $contact
        ]);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit(Request $request)
    {
        $contact = Contact::with(['account'])->where('id', $request->route('contact'))->first();
        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
            'accounts' => Account::all()
        ]);
    }

    public function update()
    {
    }

    public function destroy(Request $request)
    {
        $contact = Contact::where('id', $request->route('contact'))->firstorfail();
        $contact->delete();

        return Redirect::route('contacts.index');
    }
}
