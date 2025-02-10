<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'grup_id',
        'email',
        'name',
        'password',
        'detail',
    ];

    public function grup()
    {
        return $this->belongsTo(\App\Models\Grup::class);
    }

    public function getApiResponseAttribute()
    {
        return [
            'id' => $this->id,
            'grup' => $this->grup->only(['id', 'grup']),
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'detail' => $this->detail,
        ];
    }
}
