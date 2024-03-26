<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var array<int, string>
     *
     */


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($rolename) : bool
    {
        return Role::where("name",$rolename)->exists();
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }



    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'dateOfBirth',
        'city',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
