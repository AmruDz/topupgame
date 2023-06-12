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

    function generateInvoiceNumber()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 10;
    $invoiceNumber = '';

    do {
        $invoiceNumber = '';

        for ($i = 0; $i < $length; $i++) {
            $invoiceNumber .= $characters[rand(0, strlen($characters) - 1)];
        }
    } while (Transaksi::isInvoiceNumberExists($invoiceNumber));

    return $invoiceNumber;
}

    public static function isInvoiceNumberExists($invoiceNumber)
    {
        return self::where('nomor_invoice', $invoiceNumber)->exists();
    }


}
