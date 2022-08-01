<?php
session_start();
require('../require/co_bdd.php');


$id = $_SESSION['users']['id'];
$old = $_POST['old_password'];
$new = $_POST['new_password'];
$newC = $_POST['new_password_confirm'];

$req = $bdd->prepare('SELECT password FROM users WHERE id = ?');
$req->execute([$id]);
$user = $req->fetch();

if ($user) {

    if (isset($old) && !empty($old) && isset($new) && !empty($new) && isset($newC) && !empty($newC)) {

        if (password_verify($old, $user['password'])) {

            if ($new == $newC) {

                $req = $bdd->prepare("UPDATE users SET password = ? WHERE id = $id");
                $req->execute(array(
                    password_hash($new, PASSWORD_BCRYPT),
                ));

                header('location:../../my_account.php?success=change_ok');
            } else {

                header('location: ../../my_account.php?error=confirm_false');
            }
        } else {

            header('location: ../../my_account.php.php?error=invalid_password');
        }
    } else {

        header('location: ../../my_account.php?error=empty');
    }
}
