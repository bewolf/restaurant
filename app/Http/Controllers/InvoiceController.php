<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:shift_manager');
    }

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
    public function store(InvoiceStoreRequest $request)
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

        if (Invoice::CheckInvoiceNumberExists($request)) {
            return back()->with('error', 'Duplicate Invoice number')->withInput();
        }
        $productsForWarehouse = [];
        for ($i = 0; $i < count($data); $i++) {

            if (Product::where('name', $data[$i]['product_name'])->exists()) {

                Product::where('name', $data[$i]['product_name'])
                    ->increment('quantity', $data[$i]['quantity']);

                //  Need to be refactored
//                if ( Product::where('name', $data[$i]['product_name'])->pluck('unit')->first() == $data[$i]['unit']) {
//                    Product::where('name', $data[$i]['product_name'])
//                        ->increment('quantity', $data[$i]['quantity']);
//                } else {
//                    return redirect()->route('invoice.create')->with('error', 'Wrong unit of product ' . $data[$i]['product_name']);
//                }


            } else {
                Product::insert([
                    'name' => $data[$i]['product_name'],
                    'quantity' => $data[$i]['quantity'],
                    'unit' => $data[$i]['unit'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Invoice::insert($data);

        return redirect()->route('invoice.create')->with('success', 'Successful added invoice');

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
     * *@param  \App\Models\Invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
