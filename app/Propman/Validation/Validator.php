<?php

namespace Propman\Validation;


use Violin\Violin;
use Propman\User\User;
use Propman\Helpers\Hash;


class Validator extends Violin
{

    protected $user;
    protected $hash;
    protected $auth;

    public function __construct (User $user, Hash $hash, $auth = null)
    {
        $this->user =$user;
        $this->hash =$hash;
        $this->auth =$auth;

        $this->addFieldMessages(array(
            'email'  => array(
                    'uniqueEmail' => 'That email is already in use'
            ),
            'username'  => array(
                    'uniqueUsername' => 'That username is already in use'
            )
        ));

        $this->addRuleMessages(array(
            'matchesCurrentPassword' => 'Your Password does not match Stored one!'
        ));

    }

    public function validate_uniqueEmail($value , $input, $args)
    {
        $user = $this->user->where('email', $value);

        if ($user->count()) {
            return false;
        }

        return true;
    }

    public function validate_uniqueUsername($value , $input, $args)
    {
        return ! (bool) $this->user->where('username', $value)->count();
    }

    public function validate_matchesCurrentPassword($value , $input, $args)
    {
        if ($this->auth && $this->hash->passwordCheck($value, $this->auth->password)) {
            return true;
        }
        return false;

    }

}
