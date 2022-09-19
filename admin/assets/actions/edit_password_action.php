<?php
session_start();
require('../require/check_data.php');

if (
    isset($session_users_id)
    && (isset($session_users_type) && $session_users_type == 'admin')
    && isset($post_id)
    && isset($post_password)
) {

    require('../require/co_bdd.php');
    require('../require/action_deco_auto.php');

    $req = $bdd->prepare('UPDATE users SET password = :password WHERE id= :id');
    $req->execute(array(
        ':password' => password_hash($post_password, PASSWORD_BCRYPT),
        ':id' => $post_id
    ));

    header('location: ../../users.php?success=034225');
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../users.php?error=03415');
    die();
}
