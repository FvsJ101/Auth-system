<?php

$app->get('/password-reset',$guest(), function () use ($app){

    $request = $app->request;

    $email      = $request->get('email');
    $identifier = $request->get('identifier');

    $hashIdentifier = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)->first();

    if (!$user) {
        $app->response->redirect($app->urlFor('home'));
    }

    if (!$user->recover_hash) {
        $app->response->redirect($app->urlFor('home'));
    }

    if (!$app->hash->hashCheck($user->recover_hash, $hashIdentifier)) {
        $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/reset.php', array(
        'email'       => $user->email,
        'identifier'  => $identifier
    ));

})->name('password.reset');


$app->post('/password-reset', $guest(), function () use($app) {
    $request = $app->request;

    $email      = $request->get('email');
    $identifier = $request->get('identifier');

    $password         = $request->post('password');
    $passwordConfirm = $request->post('password_confirm');

    $hashIdentifier = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)->first();

    if (!$user) {
        $app->response->redirect($app->urlFor('home'));
    }

    if (!$user->recover_hash) {
        $app->response->redirect($app->urlFor('home'));
    }

    if (!$app->hash->hashCheck($user->recover_hash, $hashIdentifier)) {
        $app->response->redirect($app->urlFor('home'));
    }

    $v = $app->validation;

    $v->validate(array(
        'password'           => array($password, 'required|min(6)'),
        'password_confirm'   => array($passwordConfirm, 'required|matches(password)')
    ));

    if ($v->passes()) {

        $user->update(array(
            'password'      => $app->hash->password($password),
            'recover_hash'  => null
        ));

        $app->flash('global', 'Your password has been reset');
        $app->response->redirect($app->urlFor('home'));

    }

    $app->render('auth/password/reset.php', array(
        'errors'     => $v->errors(),
        'email'      => $user->email,
        'identifier' => $identifier
    ));


})->name('password.reset.post');