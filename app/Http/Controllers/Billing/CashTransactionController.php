<?php


namespace App\Http\Controllers\Billing;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Enum\Permissions;
use App\Models\BillingCycle;
use Illuminate\Http\Request;
use App\Models\PaymentAccount;
use App\Models\CashTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class CashTransactionController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can(Permissions::CashTransactionIndex)) {
            abort(403);
        }

        $transactions = CashTransaction::with('paymentAccount')->latest()->paginate(20);
        return view('payment.cash-transactions.index', compact('transactions'));
    }


    public function report()
    {
        if (!Auth::user()->can(Permissions::CashTransactionReport)) {
            abort(403);
        }

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
        if (!Auth::user()->can(Permissions::CashTransactionCreate)) {
            abort(403);
        }

        $accounts = PaymentAccount::pluck('name', 'id');
        return view('payment.cash-transactions.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can(Permissions::CashTransactionCreate)) {
            abort(403);
        }

        $request->validate([
            'payment_account_id' => 'required|exists:payment_accounts,id',
            'amount'             => 'required|numeric',
            'type'               => 'required|in:deposit,withdraw',
            'notes'              => 'nullable|string',
        ]);

        CashTransaction::create($request->all());
        return redirect()->route('cash-transactions.index')->with('success', 'Cash transaction recorded.');
    }
}
