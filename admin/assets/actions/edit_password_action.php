<?php

require('../require/co_bdd.php');

$req = $bdd->prepare('UPDATE users SET password = :password WHERE id= :id');
$req->execute(array(
    ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
    ':id' => $_POST['id']
));

header('location: ../../users.php?success=password_changed');
