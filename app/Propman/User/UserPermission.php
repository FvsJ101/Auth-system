<?php

namespace Propman\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserPermission extends Eloquent
{
    protected $table = 'users_permissions';

    protected $fillable = array(
        // there are any other fields that needs updating indcate them here
           'is_admin'
    );

    public static $defaults = array(
        'is_admin'  => false
    );

}