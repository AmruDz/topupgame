<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $table = 'items';

    protected $fillable = [
        'produk_id',
        'nama_item',
        'status',
        'stock',
        'harga_modal',
        'harga_jual',
    ];



    public function produk()
    {
        return $this->belongsTo(produk::class, 'produk_id');
    }
}
