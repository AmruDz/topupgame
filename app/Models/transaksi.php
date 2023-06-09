<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';

    protected $fillable = [
        'invoice',
        'data',
        'waktu',
        'item_id',
        'status',
        'total_pembayaran',
        'nomor_whatsapp',
    ];



    public function item()
    {
        return $this->belongsTo(item::class, 'item_id');
    }
}
