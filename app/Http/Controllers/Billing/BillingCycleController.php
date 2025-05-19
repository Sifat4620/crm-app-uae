<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillingCycle;

class BillingCycleController extends Controller
{
    public function index()
    {
        $cycles = BillingCycle::latest()->get();
        return view('billing.index', compact('cycles'));
    }

    public function create()
    {
        return view('billing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cycle_name' => 'required|string|max:255',
            'duration_in_days' => 'required|integer|min:1',
        ]);

        BillingCycle::create($request->only('cycle_name', 'duration_in_days'));

        return redirect()->route('billing-cycles.index')
                         ->with('success', 'Billing cycle created successfully.');
    }

    public function edit(BillingCycle $billingCycle)
    {
        return view('billing.edit', compact('billingCycle'));
    }

    public function update(Request $request, BillingCycle $billingCycle)
    {
        $request->validate([
            'cycle_name' => 'required|string|max:255',
            'duration_in_days' => 'required|integer|min:1',
        ]);

        $billingCycle->update($request->only('cycle_name', 'duration_in_days'));

        return redirect()->route('billing.index')
                         ->with('success', 'Billing cycle updated successfully.');
    }

    public function destroy(BillingCycle $billingCycle)
    {
        $billingCycle->delete();

        return redirect()->route('billing-cycles.index')
                         ->with('success', 'Billing cycle deleted successfully.');
    }
}
