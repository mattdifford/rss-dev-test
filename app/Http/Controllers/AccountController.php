<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Accounts/Index', [
            'accounts' => Account::all()
        ]);
    }

    public function show(Request $request)
    {
        return Inertia::render(
            'Accounts/Show',
            ['account' => Account::with(['contacts', 'owner'])->where('id', $request->route('account'))->first()]
        );
    }

    public function create()
    {
        return Inertia::render('Accounts/Create', []);
    }

    public function store()
    {
    }

    public function edit(Request $request)
    {
        return Inertia::render(
            'Accounts/Edit',
            [
                'account' => Account::with(['contacts', 'owner'])->where('id', $request->route('account'))->first(),
                'owners' => User::all()
            ]
        );
    }

    public function update(Request $request)
    {
        $account = Account::where('id', $request->route('account'))->firstorfail();
        return Redirect::route('accounts.index');
    }

    public function destroy(Request $request)
    {
        $account = Account::where('id', $request->route('account'))->firstorfail();
        $account->delete();

        return Redirect::route('accounts.index');
    }
}
