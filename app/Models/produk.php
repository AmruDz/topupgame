<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = 'produks';

    protected $fillable = [
        'kategori_id',
        'produk',
        'deskripsi',
        'status',
        'foto'=>'required|image|mimes:jpeg,jpg,png,bmp,gif,svg'
    ];



    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
