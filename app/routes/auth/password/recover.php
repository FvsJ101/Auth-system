<?php
$app->get('/recover-password',$guest(), function () use ($app){
    $app->render('auth/password/recover.php');
})->name('password.recover');

$app->post('/recover-password', $guest(), function () use($app) {
    $request = $app->request();

    $email= $request->post('email');

    $v = $app->validation;

    $v->validate(array(
        'email'      => array($email, 'required|email'),
        ));

    if ($v->passes()) {
        $user = $app->user->where('email', $email)->first();

        if (!$user) {
           $app->flash('global', 'Sorry your mail can\'t be found!?');
            $app->response->redirect($app->urlFor('password.recover'));
        } else {
            $identifier = $app->randomlib->generateString(128);

            $user->update(array(
                'recover_hash' => $app->hash->hash($identifier)

            ));

            $app->mail->send('email/auth/password/recover.php', array(
                'user'       => $user,
                'identifier' => $identifier
                ), function ($message) use($user) {
                             $message->to($user->email);
                             $message->subject('Forgotten Password');

            });

            $app->flash('global', 'An email was sent to your account.');
            $app->response->redirect($app->urlFor('home'));

        }



    }

    /// output any validation errors
    $app->render('auth/password/recover.php', array(
        'errors'  =>  $v->errors(),
        'request' => $request
    ));


})->name('password.recover.post');

