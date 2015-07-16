<?php

use Carbon\Carbon;

$app->get('/login', $guest(), function () use ($app){
$app->render('auth/login.php');
})->name('login');

$app->post('/login', function () use ($app) {

    $request = $app->request;

    $identifier = $request->post('identifier');
    $password = $request->post('password');
    $remeber = $request->post('remember');

    $v = $app->validation;

    $v->validate(array(
        'identifier'   => array($identifier, 'required'),
        'password'     => array($password, 'required')
    ));

    if ($v->passes()) {
        $user = $app->user
            ->where('active', true)
            ->where(function($query) use($identifier){
                return $query->where('email' , $identifier)->orWhere('username', $identifier);
            })
            ->first();

        if ($user && $app->hash->passwordCheck($password, $user->password)) {
            $_SESSION[$app->config->get('auth.session')] = $user->id;

            if ($remeber === 'on') {
                $rememberIdentifier  = $app->randomlib->generateString(128);
                $rememberToken       = $app->randomlib->generateString(128);

                $user->updateRememberCredentials(
                    $rememberIdentifier,
                    $app->hash->hash($rememberToken)
                );

                $app->setCookie(
                  $app->config->get('auth.remember'),
                    "{$rememberIdentifier}___{$rememberToken}",
                    Carbon::parse('+1 week')->timestamp

                );


            }

            $app->flash('global', 'You are now logged in.');
            $app->response->redirect($app->urlFor('home'));
        }else {
            $app->flash('global', 'Couldn\'t login Please check info');
            $app->response->redirect($app->urlFor('login'));
        }
    }

    $app->render('auth/login.php', array(
        'errors' => $v->errors(),
        'request' => $request
    ));


})->name('login.post');