<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSales extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'manager_name',
        'position_id',
        'bulan',
        'target_penjualan',
        'penjualan_aktual',
        'selisih',
    ];
}
