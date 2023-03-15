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
        return Inertia::render('Contacts/Create', ['accounts' => Account::all()]);
    }

    public function store(Request $request)
    {
        Contact::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'account_id' => $request->account_id,
        ]);
        return Redirect::route('contacts.index');
    }

    public function edit(Request $request)
    {
        $contact = Contact::with(['account'])->where('id', $request->route('contact'))->first();
        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
            'accounts' => Account::all()
        ]);
    }

    public function update(Request $request)
    {
        $account = Contact::where('id', $request->route('contact'))->firstorfail();
        $account->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'position' => $request->position,
            'account_id' => $request->account_id,
        ]);
        return Redirect::route('contacts.index');
    }

    public function destroy(Request $request)
    {
        $contact = Contact::where('id', $request->route('contact'))->firstorfail();
        $contact->delete();

        return Redirect::route('contacts.index');
    }
}
