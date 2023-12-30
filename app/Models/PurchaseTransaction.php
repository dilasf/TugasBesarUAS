<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseTransaction extends Model
{
    use HasFactory;


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Typesofgood::class, 'type_id', 'id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_method_id', 'id');
    }

    protected $fillable = [
        'branch_id',
        'code_purchase',
        'transaction_date',
        'code_product',
        'product_name',
        'type_id',
        'unit_id',
        'brand',
        'quantity',
        'supplier_name',
        'supplier_id',
        'buying_price',
        'total_amount',
        'payment_method_id',
    ];
}
