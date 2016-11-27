<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    const ADMIN = 'super-admin';
    const MEMBER = 'site-member';

    // by default the user_groups table gets created_at, updated_at columns

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
