<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grup extends Model
{
    use HasFactory;

    protected $fillable = [
        'grup'
    ];

    public function getApiResponseAttribute()
    {
        return [
            'id' => $this->id,
            'grup' => $this->grup
        ];
    }

}