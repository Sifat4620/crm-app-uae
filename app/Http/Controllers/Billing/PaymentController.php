<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; 
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\PaymentAccount;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\CashTransaction;



class PaymentController extends Controller
{
    // Show list of payments (admin view)
    public function index()
    {
        $clientId = auth()->user()->client->id;

        $orders = Order::with('product')
            ->withExists(['payments as has_paid' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->where('client_id', $clientId)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('payment.payments.index', compact('orders'));
    }


    // Show form to record new payment
    public function create(Request $request)
    {
        $orderId = $request->order_id;
        $order = Order::with('payments')->findOrFail($orderId);
        $paymentAccounts = PaymentAccount::all(); // or filtered by client if needed

        return view('payment.payments.create', compact('order', 'paymentAccounts'));
    }


    // Store new payment
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
            'payment_account_name' => 'required|string|max:255',
            'transaction_number' => 'required|string|max:255',
            // New fields are optional, but you can make them required if you want
            'account_number' => 'nullable|string|max:255',
            'holder_name' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        DB::beginTransaction();

        try {
            // Check if payment account exists for the user with this bank name
            $paymentAccount = \App\Models\PaymentAccount::where('holder_name', $request->holder_name)
                ->where('bank_name', $request->payment_account_name)
                ->where('account_number', $request->account_number)
                ->first();

            // If no payment account, create a new one
            if (!$paymentAccount) {
                $paymentAccount = \App\Models\PaymentAccount::create([
                    'holder_name' => $request->holder_name ?? $user->name,
                    'bank_name' => $request->payment_account_name,
                    'account_number' => $request->account_number ?? '',
                    'branch' => $request->branch ?? '',
                ]);
            }

            // Create Payment record
            $payment = Payment::create([
                'order_id' => $request->order_id,
                'client_id' => $user->id,
                'amount' => $request->amount,
                'payment_date' => now()->toDateString(),
                'payment_method' => 'wallet',
                'notes' => $request->notes,
                'status' => 'completed',
            ]);

            // Deposit to user's wallet
            $user->deposit($request->amount, [
                'payment_id' => $payment->id,
                'order_id' => $request->order_id,
            ]);

            // Create CashTransaction linked to the payment account
            CashTransaction::create([
                'payment_account_id' => $paymentAccount->id,  // Important: link payment account id
                'transaction_number' => $request->transaction_number,
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
    public function generateReport()
    {
        $payments = Payment::with('order', 'client')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('payment.payments.report', compact('payments'));
    }

}
