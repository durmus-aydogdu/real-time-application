<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable = ['role_id', 'user_id'];

    protected $table = 'role_user';
}
