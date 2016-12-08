<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Lesson extends Model
{
    protected $fillable = ['category_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
