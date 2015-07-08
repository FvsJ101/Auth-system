<?php

$app->get('/u/:username', function ($username) use ($app){

    $user = $app->user->where('username', $username)->first();

    if (!$user) {
        $app->notFound();
    }

    $app->render('user/profile.php', array(
        'user' =>$user
    ));

})->name('user.profile');