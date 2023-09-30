<?php

namespace App\Http\Controllers\user;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\CreateinvoiceRequest;
use App\Http\Requests\user\UpdateinvoiceRequest;
use App\Models\Customer;
use App\Models\User;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    public function index()
    {
        request()->user()->hasPermission('view-invoice');
        $invoices = Invoice::all();

        return view('user.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::all();
        $salepersons = User::whereRole('saleperson')->get();
        return view('user.invoices.create', compact('customers', 'salepersons'));
    }

    public function store(CreateinvoiceRequest $request)
    {
        request()->user()->hasPermission('create-invoice');
        $data = $request->validated();
        $invoiceData = $this->invoiceService->getInvoiceData($data);
        $invoiceData['invoice_number'] = $this->invoiceService->generateInvoiceNumber();
        $Items = $this->invoiceService->getInvoiceItemsData($data);

        DB::transaction(function () use ($invoiceData, $Items) {
            $invoice = Invoice::create($invoiceData);
            $invoice->items()->createMany($Items);
        });

        return back()->with('success', 'invoice created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        request()->user()->hasPermission('view-invoice');

        return view('user.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        request()->user()->hasPermission('edit-invoice');

        return view('user.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinvoiceRequest $request, Invoice $invoice)
    {
        request()->user()->hasPermission('edit-invoice');
        $invoice->update($request->validated());

        return to_route('user.invoices.index')->with('success', 'invoice updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return back()->with('success', 'invoice deleted');
    }
}
