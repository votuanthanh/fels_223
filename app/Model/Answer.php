<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['word_id', 'content', 'is_correct'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
