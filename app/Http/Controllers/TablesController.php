<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTablesRequest;
use App\Models\Tables;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = count(Tables::all());

        return view('tables.index', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTablesRequest $request)
    {
        $number_of_tables = $request->number_of_tables;

        if (self::checkForOccupiedTables() !== 0) {

            return redirect()->route('table.index')->with('error', 'Please close all orders. Then you can change table numbers.');
        }

        Tables::truncate();

        for ($i = 0; $i < $number_of_tables; $i++) {
            Tables::insert([
                'is_available' => true,
            ]);
        }

        return redirect()->route('table.index')->with('success', 'Successful updated number ot tables and zones');
    }

    public function checkForOccupiedTables()
    {
        return Tables::select('is_available')->where('is_available', false)->count();
    }
}
