<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'number', 'product_id', 'quantity', 'unit_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function CheckInvoiceNumberExists($request)
    {
        return Invoice::where('number', $request->number)->exists();
    }
}
