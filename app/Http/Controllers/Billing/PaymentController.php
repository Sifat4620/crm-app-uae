<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; 
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;


class PaymentController extends Controller
{
    // Show list of payments (admin view)
    public function index()
    {
        $clientId = Auth::user()->client->id;

     $orders = Order::with('product', 'payments')  // eager load relations
        ->where('client_id', $clientId)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return view('payment.payments.index', compact('orders'));
    }

    // Show form to record new payment
    public function create(Request $request)
    {
        $order = \App\Models\Order::with('payments')->findOrFail($request->order_id);
        return view('payment.payments.create', compact('order'));
    }


    // Store new payment
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
            'payment_account_id' => 'required|exists:payment_accounts,id', // assuming user selects account
        ]);

        $user = auth()->user();

        DB::beginTransaction();

        try {
            // Create payment record
            $payment = Payment::create([
                'order_id' => $request->order_id,
                'client_id' => $user->id,
                'amount' => $request->amount,
                'payment_date' => now()->toDateString(),
                'payment_method' => 'wallet', // or get from request
                'notes' => $request->notes,
                'status' => 'completed',
            ]);

            // Deposit amount into wallet
            $user->deposit($request->amount, [
                'payment_id' => $payment->id,
                'order_id' => $request->order_id,
            ]);

            // Create cash transaction record
            $transactionNumber = strtoupper(Str::random(12)); // Generate a random transaction number

            CashTransaction::create([
                'payment_account_id' => $request->payment_account_id,
                'transaction_number' => $transactionNumber,
                'amount' => $request->amount,
                'type' => 'deposit',
                'notes' => 'Payment ID: ' . $payment->id . '. ' . ($request->notes ?? ''),
            ]);

            DB::commit();

            return redirect()->route('payments.index')->with('success', 'Payment successful and wallet updated.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }


    // Payment report (optional)
    public function report()
    {
        $payments = Payment::with('order', 'client')->orderBy('created_at', 'desc')->get();
        return view('payment.payments.report', compact('payments'));
    }
}
