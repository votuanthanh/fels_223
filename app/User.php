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
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id')->withTimestamps();
    }

    public function avatarPath()
    {
        return preg_match('#^(http)|(https).*$#', $this->avatar)
                ? $this->avatar
                : asset('uploads/avatar/' . $this->avatar);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            //set password for user sign up social network
            if (!$user->password) {
                $user->password = config('settings.user.default_password_seeder');
            }
            $user->role = config('settings.user.member');
        });
    }
}
