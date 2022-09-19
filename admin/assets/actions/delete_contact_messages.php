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


    $req = $bdd->prepare('DELETE FROM contact WHERE id= :id');
    $req->execute(array(
        ':id' => $get_id
    ));

    header('location: ../../contacts.php?success=037244');
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../contacts.php?error=03715');
    die();
}
