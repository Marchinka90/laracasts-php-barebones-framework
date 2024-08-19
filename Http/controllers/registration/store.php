<?php

use Core\{App, Database, Validator};

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 6, 255)) {
  $errors['password'] = 'Please provide a password of at least six charachters.';
}

if (!empty($errors)) {
  return view('registration/create.view.php', [
    'errors' => $errors
  ]);
}

$db = App::resolve(Database::class);

$user = $db->query('SELECT * from users where email = :email', [
  'email' => $email
])->find();

if ($user) {
  header('location: /');
  exit();

} else {
  $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
  ]);

  login($user);

  header('location: /');
  exit();
}
