<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// WAJIB TAMBAHKAN IMPORT INI: agar class Saving dikenali oleh Eloquent
use App\Models\Saving;

class Transaction extends Model
{
    protected $fillable = [
        'saving_id',
        'amount',
        'transaction_date',
        'note',
    ];

    /**
     * Relasi ke model Saving menggunakan nama custom 'savingPlan'
     * untuk menghindari tabrakan dengan method internal Laravel saving().
     */
    public function savingPlan()
    {
        // Menentukan foreign key 'saving_id' secara eksplisit
        return $this->belongsTo(Saving::class, 'saving_id');
    }

    protected static function booted()
    {
        static::created(function ($transaction) {
            // Ambil data saving yang terkait dengan transaksi ini
            $saving = $transaction->savingPlan; // sesuaikan nama relasinya

            if ($saving) {
                // Tambahkan nominal transaksi ke total uang yang terkumpul
                $saving->increment('current_amount', $transaction->amount);
            }
        });
    }
}
