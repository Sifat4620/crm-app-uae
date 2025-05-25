<?php
namespace App\Http\Controllers;

use App\Models\PaymentAccount;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    public function index()
    {
        $accounts = PaymentAccount::all();
        return view('payment.payment-accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('payment.payment-accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gateway_id' => 'required|exists:payment_gateways,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        PaymentAccount::create($request->all());
        return redirect()->route('payment-accounts.index')->with('success', 'Payment account created.');
    }

    public function edit(PaymentAccount $account)
    {
        return view('payment.payment-accounts.edit', compact('account'));
    }

    public function update(Request $request, PaymentAccount $account)
    {
        $request->validate([
            'gateway_id' => 'required|exists:payment_gateways,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
        ]);

        $account->update($request->all());
        return redirect()->route('payment-accounts.index')->with('success', 'Payment account updated.');
    }

    public function destroy(PaymentAccount $account)
    {
        $account->delete();
        return redirect()->route('payment-accounts.index')->with('success', 'Payment account deleted.');
    }
}
