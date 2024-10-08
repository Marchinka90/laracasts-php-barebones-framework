<?php

use Core\{App, Database, Validator};

$db = App::resolve(Database::class);


$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
  'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
  $errors['body'] = 'A body of no more than 1,000 charactersis required';
}

if(! empty($errors)) {
  return view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note
  ]);
}

$db->query('UPDATE notes SET body = :body where id = :id', [
  'id' => $_POST['id'],
  'body' => $_POST['body'],
]);

header('location: /notes');
exit();
