<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SocialLogin extends Model
{
    protected $table = 'social_logins';

    protected $fillable = ['user_id', 'provider', 'social_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
