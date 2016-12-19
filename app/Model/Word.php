<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['category_id', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    protected static function boot()
    {
        parent::boot();
        //before delete() method call this
        static::deleting(function ($word) {
            $word->answers()->delete();
            $word->results()->delete();
        });
    }
}
