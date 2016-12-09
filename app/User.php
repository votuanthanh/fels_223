<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use App\Model\Lesson;
use App\Model\Category;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'lessons', 'user_id', 'category_id')->withTimestamps();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function socialLogins()
    {
        return $this->hasMany(SocialLogin::class);
    }

    public function isAdmin()
    {
        return $this->role == config('settings.user.is_admin');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }
}
