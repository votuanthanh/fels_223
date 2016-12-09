<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lessons', 'category_id', 'user_id');
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
