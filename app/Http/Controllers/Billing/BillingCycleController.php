<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillingCycle;

class BillingCycleController extends Controller
{
    /**
     * Display a listing of billing cycle
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cycles = BillingCycle::latest()->get();
        return view('billing.index', compact('cycles'));
    }

    /**
     * Display the form to create billinc cycle
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('billing.create');
    }

    /**
     * Store the billing cycle to database
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Show single billing cycle
     * @param \App\Models\BillingCycle $billingCycle
     * @return never
     */
    public function show(BillingCycle $billingCycle)
    {
        abort(404);
    }

    /**
     * Display edit form of billing cycle
     * @param \App\Models\BillingCycle $billingCycle
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(BillingCycle $billingCycle)
    {
        return view('billing.edit', compact('billingCycle'));
    }

    /**
     * Update billing cycle from database
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BillingCycle $billingCycle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BillingCycle $billingCycle)
    {
        $request->validate([
            'cycle_name' => 'required|string|max:255',
            'duration_in_days' => 'required|integer|min:1',
        ]);

        $billingCycle->update($request->only('cycle_name', 'duration_in_days'));

        return redirect()->route('billing-cycles.index')
            ->with('success', 'Billing cycle updated successfully.');
    }

    /**
     * Delete a billing cycle from database
     * @param \App\Models\BillingCycle $billingCycle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BillingCycle $billingCycle)
    {
        $billingCycle->delete();

        return redirect()->route('billing-cycles.index')
            ->with('success', 'Billing cycle deleted successfully.');
    }
}
