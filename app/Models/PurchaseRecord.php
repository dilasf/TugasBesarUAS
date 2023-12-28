<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseRecord extends Model
{
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    protected $fillable = [
        'code_purchase',
        'code_product',
        'product_name',
        'quantity',
        'purchase_price',
        'transaction_date',
        'supplier_name',
        'supplier_id',
        'product_id',
    ];
}
