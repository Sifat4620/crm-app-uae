<?php
namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $gateways = PaymentGateway::all();
        return view('payment.payment-gateways.index', compact('gateways'));
    }

    public function create()
    {
        return view('payment.payment-gateways.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        PaymentGateway::create($request->all());
        return redirect()->route('payment-gateways.index')->with('success', 'Payment gateway added.');
    }

    public function edit(PaymentGateway $gateway)
    {
        return view('payment.payment-gateways.edit', compact('gateway'));
    }

    public function update(Request $request, PaymentGateway $gateway)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $gateway->update($request->all());
        return redirect()->route('payment-gateways.index')->with('success', 'Payment gateway updated.');
    }

    public function destroy(PaymentGateway $gateway)
    {
        $gateway->delete();
        return redirect()->route('payment-gateways.index')->with('success', 'Payment gateway deleted.');
    }
}
