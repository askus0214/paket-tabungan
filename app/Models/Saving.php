<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
// WAJIB TAMBAHKAN IMPORT INI AGAR MODEL RECOGNIZED
use App\Models\Package;

class Saving extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'target_amount',
        'current_amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function transactions()
    {
        // Menghubungkan satu tabungan ke banyak transaksi berdasarkan 'saving_id'
        return $this->hasMany(Transaction::class, 'saving_id');
    }
}
