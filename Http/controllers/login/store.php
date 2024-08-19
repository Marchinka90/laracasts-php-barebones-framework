<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
]);

$auth = new Authenticator();

$singedIn = $auth->attempt($attributes['email'], $attributes['password']);

if (!$singedIn) {
  $form->error('email', 'No matching account found for that email address and password.')->throw();
}

redirect('/');
