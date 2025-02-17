<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    use HasFactory;

    protected $fillable = [
        'modul_id',
        'name',
        'detail',
        'is_active',
    ];

    public function modul()
    {
        return $this->belongsTo(\App\Models\Modul::class);
    }

    public function getApiResponseAttribute()
    {
        return [
            'id' => $this->id,
            'modul' => $this->modul->only(['id', 'name']),
            'name' => $this->name,
            'detail' => $this->detail,
            'is_active' => (boolean) $this->is_active,
        ];
    }

}