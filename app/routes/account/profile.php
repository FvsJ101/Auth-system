<?php

$app->get('/account/profile',$autheticated(), function () use ($app) {
        $app->render('/account/profile.php');
})->name('account.profile');

//// this must be post as this form submits in the post method
$app->post('/account/profile',$autheticated(), function () use ($app) {

    $request = $app->request;
    $user = $app->auth;

    $email      = $request->post('email');
    $firstName = $request->post('first_name');
    $lastName  = $request->post('last_name');

    $v = $app->validation;

    $v->validate(array(
        'email'        => array($email, 'required|email|uniqueEmail'),
        'first_name'   => array($firstName, 'alpha|max(50)'),
        'last_name'   => array($lastName, 'alpha|max(50)')
    ));

    if ($v->passes()) {

        $user->update(array(
            'email'       => $email,
            'first_name'  => $firstName,
            'last_name'   => $lastName
        ));

        $app->flash('global', 'Your account info has been updated');
        $app->response->redirect($app->urlFor('account.profile'));
    }

    $app->render('/account/profile.php', array(
        'errors' => $v->errors(),
        'request' => $request
    ));


})->name('account.profile.post');


