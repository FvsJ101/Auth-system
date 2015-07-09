<?php

namespace Propman\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'users';

    protected $fillable = array(
        // there are any other fields that needs updating indcate them here
        'email',
        'first_name',
        'last_name',
        'username',
        'password',
        'active',
        'recover_hash',
        'active_hash',
        'remember_identifier',
        'remember_token',

    );

    public function getFullName()
    {
        if (!$this->first_name || !$this->last_name) {
            return null;
        }

        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullNameOrUsername()
    {
        return $this->getFullName() ? : $this->username;
    }

    public function activateAccount()
    {
        $this->update(array(
            'active'        => true,
            'active_hash'   => null

        ));
    }

    public function getAvatarUrl ($options = array())
    {
        $size = isset($options['size']) ? $options['size'] : 45;
        return 'http://www.gravatar.com/avatar/'. md5($this->email). '?s='.$size. '&d=mm';
    }

    public function updateRememberCredentials($identifier, $token)
    {
        $this->update(array(
            'remember_identifier' => $identifier,
            'remember_token'      => $token

        ));
    }

    public function removeRememberCredentials()
    {
        $this->updateRememberCredentials(null,null);
    }

    public function hasPermission ($permission)
    {
        return (bool) $this->permissions->{$permission};
    }

    public function isAdmin ()
    {
        return $this->hasPermission('is_admin');
    }

    /// we have to link the users table to the permissions table and we do it like this
    public function permissions ()
    {
        return $this->hasOne('Propman\User\UserPermission', 'user_id');
    }



}

