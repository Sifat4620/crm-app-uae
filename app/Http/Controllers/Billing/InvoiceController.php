<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    // Display a listing of invoices
    public function index()
    {
        $invoices = Invoice::all(); 
        return view('Invoice.index', compact('invoices')); 
    }

    // Show the form for creating a new invoice
    public function create()
    {
        return view('Invoice.create');
    }

    // Store a newly created invoice in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,due,canceled,overdue,refunded',
        ]);

        Invoice::create($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }

    // Display the specified invoice
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    // Show the form for editing the specified invoice
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    // Update the specified invoice in storage
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|in:paid,due,canceled,overdue,refunded',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }

    // Remove the specified invoice from storage
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }

    // Generate and download PDF version of invoice
    public function download(Invoice $invoice)
    {
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }
}
