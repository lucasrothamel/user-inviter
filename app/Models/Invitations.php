<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitations extends Model
{
    public function userCreated()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_created_id');
    }

    public function userInvited()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_inviting_id');
    }

    public function method()
    {
        return $this->hasOne('App\Models\InvitationMethods', 'id', 'method_id');
    }

    public static function pending($userId = null)
    {
        $builder = Invitations::query();

        if (!empty($userId)) {
            $builder->where('user_inviting_id', $userId);
        }

        return $builder
            ->with('userCreated', 'method')
            ->whereNull('user_created_id')
            ->get();
    }

    public static function successful($userId = null)
    {
        $builder = Invitations::query();

        if (!empty($userId)) {
            $builder->where('user_inviting_id', $userId);
        }

        return $builder
            ->with('userCreated', 'method')
            ->whereNotNull('user_created_id')
            ->get();
    }
}
