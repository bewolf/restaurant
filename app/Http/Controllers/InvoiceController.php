<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::
        select('number', 'created_at')
            ->groupBy('number', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->product_name); $i++) {
            $data[] = [
                'number' => $request->number,
                'product_name' => $request->product_name[$i],
                'quantity' => $request->quantity[$i],
                'unit' => $request->unit[$i],
                'unit_price' => $request->unit_price[$i],
                'added_by' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (Invoice::where('number', $request->number)->exists()) {
            return back()->with('error', 'Duplicate Invoice number')->withInput();
        }
        Invoice::insert($data);
        return back()->with('success', 'Successful added invoice');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice
     * @return \Illuminate\Http\Response
     */
    public function show($number)
    {
        $invoiceData = Invoice::where('number', $number)->get();

        return view('invoice.show', compact('invoiceData'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $warehouse)
    {
        //
    }
}
