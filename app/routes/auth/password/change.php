<?php


$app->get('/change-password', $autheticated(), function () use ($app){
    /// this is the path under views
    $app->render('auth/password/change.php');
    // the name has a path to the file separated with  .
})->name('password.change');

$app->post('/change-password', $autheticated(), function () use($app) {
    $request = $app->request();

    $passwordOld = $app->request->post('password_old');
    $password = $app->request->post('password');
    $passwordConfirm = $app->request->post('password_confirm');

    $v = $app->validation;

    $v->validate(array(
        'password_old'      => array($passwordOld, 'required|matchesCurrentPassword'),
        'password'          => array($password, 'required|min(6)'),
        'password_confirm'  => array($passwordConfirm, 'required|matches(password)')
    ));

    if ($v->passes()) {

        $user = $app->auth;

        $user->update(array(
            'password' => $app->hash->hash($password)
        ));

        $app->mail->send('email/auth/password/changed.php', array(), function($message) use($user) {
            $message->to($user->email);
            $message->subject('Password Changed');
        });

        $app->flash('global', 'Your password is Updated!');
        $app->response->redirect($app->urlFor('home'));
    }

    $app->render('auth/password/change.php', array(
        'errors' =>  $v->errors()
    ));


})->name('password.change.post');
