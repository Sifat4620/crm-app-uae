<?php


namespace App\Http\Controllers\Billing;

use App\Models\CashTransaction;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\BillingCycle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CashTransactionController extends Controller
{
    public function index()
    {
        $transactions = CashTransaction::with('paymentAccount')->latest()->paginate(20);
        return view('payment.cash-transactions.index', compact('transactions'));
    }


    public function report()
    {
            $transactions = CashTransaction::with([
                'paymentAccount',
                'order.client',
                'order.product',
                'order.billingCycle'
            ])->latest()->get();

        
        return view('payment.cash-transactions.report', compact('transactions'));
    }


    public function create()
    {
        $accounts = PaymentAccount::pluck('name', 'id');
        return view('payment.cash-transactions.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_account_id' => 'required|exists:payment_accounts,id',
            'amount' => 'required|numeric',
            'type' => 'required|in:deposit,withdraw',
            'notes' => 'nullable|string',
        ]);

        CashTransaction::create($request->all());
        return redirect()->route('cash-transactions.index')->with('success', 'Cash transaction recorded.');
    }
}
