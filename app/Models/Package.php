<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'thumbnail',
        'status',
    ];

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }
}
