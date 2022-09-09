<?php
session_start();
require('../require/check_data.php');


if (
    isset($post_old_password)
    && isset($post_new_password)
    && isset($post_new_password_confirm)
    && isset($session_users_id)
) {

    require('../require/co_bdd.php');
    require('../require/action_deco_auto.php');


    $req = $bdd->prepare('SELECT password FROM users WHERE id = :id');
    $req->bindParam(':id', $session_users_id, PDO::PARAM_INT);
    $req->execute();
    $user = $req->fetch();

    if ($user) {

        if (password_verify($post_old_password, $user['password'])) {

            if ($post_new_password == $post_new_password_confirm) {

                $password = password_hash($post_new_password, PASSWORD_BCRYPT);

                $req = $bdd->prepare('UPDATE users SET password = :password WHERE id = :id ');
                $req->bindParam(':password', $password, PDO::PARAM_STR);
                $req->bindParam(':id', $session_users_id, PDO::PARAM_INT);
                $req->execute();

                $bdd = null;
                header('location:../../my_account.php?success=015225');
                die();
            } else {

                $bdd = null;
                header('location: ../../my_account.php?error=015114');
                die();
            }
        } else {

            $bdd = null;
            header('location: ../../my_account.php?error=05126');
            die();
        }
    }
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../my_account.php?error=01515');
    die();
}
