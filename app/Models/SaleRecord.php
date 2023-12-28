<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleRecord extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        'code_sale',
        'transaction_date',
        'product_name',
        'quantity',
        'sale_price',
        'discount_name',
        'total_price',
        'product_id',
        'discount_id',
    ];
}
