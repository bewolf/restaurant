<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use PhpParser\Node\Stmt\Else_;

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
        if (Invoice::CheckInvoiceNumberExists($request)) {
            return back()->with('error', 'Duplicate Invoice number')->withInput();
        }
        for ($i = 0; $i <= count($data); $i++) {
            dd($data[$i]    );
            if (DB::table('warehouse')->where('name', $data[$i]->product_name)->exists()) {
//                DB::table('warehouse')
//                    ->where('name', $data[$i]->product_name)
//                    ->update('quantity', 5);
            } else {
                DB::table('warehouse')->insert([
                    'name' => $data[$i]->product_name,
                    'quantity' => $data[$i]->quantity,
                    'unit' => $data[$i]->unit,
                    'updated_at' => now(),
                ]);
            }
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
