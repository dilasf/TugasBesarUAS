<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'sale_price',
        'quantity',
        'tax_amount',
        'total_price',
        'total_price_after_discount',
        'total_payment',
        'change_amount',
        'code_purchase',
        'transaction_date',
        'payment_status_id',
        'code_product',
        'product_name',
        'brand',
        'stock',
    ];
}
