<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Menggunakan role sesuai database
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        // Hapus cast boolean is_admin karena kolomnya bertipe string
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya yang isi kolom role-nya bernilai 'admin' yang bisa masuk panel
        return $this->role === 'admin';
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }
}
