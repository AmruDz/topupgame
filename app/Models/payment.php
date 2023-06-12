<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'nama_payment',
        'fee',
        'status',
        'foto'=>'required|image|mimes:jpeg,jpg,png,bmp,gif,svg',
    ];
}
