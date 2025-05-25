<?php

namespace App\Http\Controllers;

use App\Models\CashTransaction;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function index()
    {
        $transactions = CashTransaction::latest()->paginate(20);
        return view('payment.cash-transactions.index', compact('transactions'));
    }

    public function report()
    {
        $transactions = CashTransaction::all();
        return view('payment.cash-transactions.report', compact('transactions'));
    }

    public function create()
    {
        return view('payment.cash-transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:credit,debit',
            'note' => 'nullable|string',
        ]);

        CashTransaction::create($request->all());
        return redirect()->route('cash-transactions.index')->with('success', 'Cash transaction recorded.');
    }
}
