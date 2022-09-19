<?php
session_start();
require('../require/check_data.php');

if (
    isset($session_users_id)
    && (isset($session_users_type) && $session_users_type == 'admin')
    && isset($get_id)

) {

    require('../require/co_bdd.php');
    require('../require/action_deco_auto.php');

    $req = $bdd->prepare('DELETE FROM purchased_contents WHERE id= :id');
    $req->execute(array(
        ':id' => $get_id
    ));

    header('location: ../../purchased_contents.php?success=035243');
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../purchased_contents.php?error=03515');
    die();
}
