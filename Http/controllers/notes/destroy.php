<?php

use Core\{App, Database};

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
  'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

$db->query('DELETE from notes WHERE id = :id', [
  'id' => $_POST['id']
]);

header('location: /notes');
exit();
