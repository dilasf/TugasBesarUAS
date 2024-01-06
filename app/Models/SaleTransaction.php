<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleTransaction extends Model
{
    use HasFactory;

    public function payments(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'ppayment_status_id', 'id');
    }

    public function payment_statuses(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    protected $fillable = [
        'branch_id',
        'code_sale',
        'transaction_date',
        'brand',
        'sale_price',
        'quantity',
        'tax_amount',
        'total_price',
        'discount_name',
        'total_price_after_discount',
        'payment_id',
        'total_payment',
        'change_amount',
        'payment_status_id',
        'product_id',
        'discount_id',
    ];
}
