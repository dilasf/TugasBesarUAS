<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function typesofgoods(): BelongsTo
    {
        return $this->belongsTo(Typesofgood::class, 'type_id', 'id');
    }

    public function units(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }


    public function purchaseRecords()
    {
        return $this->hasMany(PurchaseRecord::class);
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
        'buying_price',
        'stock',
        'supplier_id',
        'total_amount',
    ];
}
