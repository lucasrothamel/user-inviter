<?php

namespace App\Models;

use App\QueryFilters\Email;
use App\QueryFilters\Name;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pipeline\Pipeline;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function invitations()
    {
        return $this->hasMany('App\Models\Invitations', 'user_inviting_id', 'id');
    }

    public function profileTemplate()
    {
        return $this->hasOne('App\Models\ProfileTemplates', 'id', 'profile_template_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Posts', 'user_id', 'id')->orderBy('created_at', 'desc');
    }

    /**
     * sortable and searchable list of Users, based on Request parameters.
     * @return mixed
     */
    public static function allUsers()
    {
        return app(Pipeline::class)
            ->send(User::query())
            ->through(
                [
                    Name::class,
                    Email::class,
                ]
            )->thenReturn()
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
