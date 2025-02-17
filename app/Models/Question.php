<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'modul_id',
        'topik_id',
        'question',
        'answer',
        'timer',
        'inline_answers',
        'audio',
        'audio_play',
        'auto_next',
        'type',
        'difficulty',
        'is_active',
    ];

    public function modul()
    {
        return $this->belongsTo(\App\Models\Modul::class);
    }

    public function topik()
    {
        return $this->belongsTo(\App\Models\Topik::class);
    }

    public function getApiResponseAttribute()
    {
        return [
            'id' => $this->id,
            'modul' => $this->modul->only(['id', 'name']), 
            'topik' => $this->topik->only(['id', 'name']),
            'answer' => $this->answer,
            'timer' => $this->timer,
            'inline_answers' => $this->inline_answers,
            'audio' => $this->audio,
            'audio_play' => (boolean) $this->audio_play,
            'auto_next' => (boolean) $this->auto_next,
            'type' => $this->type,
            'difficulty' => $this->difficulty,
            'is_active' => (boolean) $this->is_active,
        ];
    }
}