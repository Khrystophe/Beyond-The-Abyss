<?php

require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT email FROM users WHERE id = :id');
$req->execute(array(
    ':id' => $_POST['id']
));
$user_email = $req->fetch();

if ($_POST['email'] == $user_email['email']) {

    $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname, email = :email, password = :password, credits = :credits, type = :type WHERE id= :id');
    $req->execute(array(
        ':name' => $_POST['name'],
        ':lastname' => $_POST['lastname'],
        ':email' => $_POST['email'],
        ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        ':credits' => $_POST['credits'],
        ':type' => $_POST['type'],
        ':id' => $_POST['id']
    ));
    header('location: ../../users.php');
} else {

    $req = $bdd->query('SELECT email FROM users');
    $email = $req->fetchAll();

    if (in_array($_POST['email'], array_column($email, 'email'), TRUE) == false) {

        $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname, email = :email, password = :password, credits = :credits, type = :type WHERE id= :id');
        $req->execute(array(
            ':name' => $_POST['name'],
            ':lastname' => $_POST['lastname'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            ':credits' => $_POST['credits'],
            ':type' => $_POST['type'],
            ':id' => $_POST['id']
        ));
        header('location: ../../users.php');
    }
    header('location: ../../users.php?error=emailexist');
}
