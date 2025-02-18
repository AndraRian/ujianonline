<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'question_id',
        'detail',
        'is_true',
        'is_active',
    ];

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }

    public function getApiResponseAttribute()
    {
        return [
            'id' => $this->id,
            'question' => $this->question->only(['id', 'question']),
            'detail' => $this->detail,
            'is_true' => (boolean) $this->is_true,
            'is_active' => (boolean) $this->is_active,
        ];
    }
}
