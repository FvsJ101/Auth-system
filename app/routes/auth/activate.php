<?php
$app->get('/activate', $guest, function () use ($app){
    $request = $app->request;

    $email      = $request->get('email');
    $identifier = $request->get('identifier');

    $hashedIdentifier = $app->hash->hash($identifier);

    $user = $app->user->where('email', $email)
                      ->where('active', false)
                      ->first();

    if (!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier) ) {

        $app->flash('global', 'User could be registered due to authentication problem! ');
        $app->response->redirect($app->urlFor('home'));
    } else {
        $user->activateAccount();
        $app->flash('global', 'Your account is now active!');
        $app->response->redirect($app->urlFor('home'));
    }

})->name('activate');