<?php

use Propman\User\UserPermission;

$app->get('/register', $guest , function () use ($app){
    $app->render('auth/register.php');
})->name('register');

$app->post('/register', $guest , function () use ($app) {

    $request = $app->request;

    $email = $request->post('email');
    $username = $request->post('username');
    $password = $request->post('password');
    $passwordConfirm = $request->post('password_confirm');

    $v = $app->validation;

    $v->validate(array(
        'email'     => array($email, 'required|email|uniqueEmail'),
        'username'  => array($username, 'required|alnumDash|max(20)|uniqueUsername'),
        'password'  => array($password, 'required|min(6)'),
        'password_confirm'  => array($passwordConfirm, 'required|matches(password)')
    ));

    if ($v->passes()) {

        $identifier = $app->randomlib->generateString(128);

       $user = $app->user->create(array(
            'email'          => $email,
            'username'       => $username,
            'password'       => $app->hash->password($password),
            'active'         => false,
            'active_hash'    => $app->hash->hash($identifier)
       ));

        $user->permissions()->create(UserPermission::$defaults);



        $app->mail->send('email/auth/registered.php', array('user' => $user, 'identifier' => $identifier ) , function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Thanks for registering.');
        });

        $app->flash('global', 'You have been registered. Please check you email.');
        $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/register.php', array(
        'errors' => $v->errors(),
        'request' => $request

    ));


})->name('register.post');