<?php
session_start();
require('../require/co_bdd.php');


$req = $bdd->prepare('SELECT password FROM users WHERE id = :id');
$req->execute(array(
    ':id' => $_SESSION['users']['id']
));
$user = $req->fetch();

if ($user) {

    if (isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password']) && isset($_POST['new_password_confirm']) && !empty($_POST['new_password_confirm'])) {

        if (password_verify($_POST['old_password'], $user['password'])) {

            if ($_POST['new_password'] == $_POST['new_password_confirm']) {

                $req = $bdd->prepare("UPDATE users SET password = :password WHERE id =" . $_SESSION['users']['id']);
                $req->execute(array(
                    ':password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT),
                ));

                header('location:../../my_account.php?success=change_ok');
            } else {

                header('location: ../../my_account.php?error=confirm_false');
            }
        } else {

            header('location: ../../my_account.php.php?error=invalid_password');
        }
    }
}
