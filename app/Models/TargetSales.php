<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSales extends Model
{
    use HasFactory;

    public function manager()
{
    return $this->hasOne(User::class, 'id', 'user_id');
}

    protected $fillable = [
        'branch_id',
        'bulan',
        'target_penjualan',
        'penjualan_aktual',
        'selisih',
        'user_id',
    ];
}
