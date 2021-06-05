<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'settings',
        'mute',
        'rotation_count',
        'fetch_interval',
        'rotation_interval'
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array'
    ];

    public function getInitialsAttribute()
    {
        $name_array = explode(' ', trim($this->name));
        $firstWord = $name_array[0];
        $lastWord = $name_array[count($name_array) - 1];

        return $firstWord[0] . "" . $lastWord[0];
    }

    public function settings()
    {
        return [
            "mute" => $this->mute,
            "rotation_count" => $this->rotation_count,
            "fetch_interval" => $this->fetch_interval,
            "rotation_interval" => $this->rotation_interval,
        ];
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'addressee_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'author_id');
    }

    public function device()
    {
        return $this->hasOne(Device::class, 'owner_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->wherePivot('accepted', '=', 1)->withPivot('accepted');
    }

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->wherePivot('accepted', '=', 0)->withPivot('accepted');
    }
}
