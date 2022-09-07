<?php
session_start();
require('../require/check_data.php');

if (
    isset($session_users_id)
    && isset($session_users_type)
    && isset($post_id)
) {

    if (($session_users_id != $post_id)) {

        require('../require/co_bdd.php');

        $req = $bdd->prepare('SELECT email FROM users WHERE id = :id');
        $req->execute(array(
            ':id' => $_POST['id']
        ));
        $user_email = $req->fetch();

        if ($_POST['email'] == $user_email['email']) {

            $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname, email = :email, credits = :credits, type = :type WHERE id= :id');
            $req->execute(array(
                ':name' => $_POST['name'],
                ':lastname' => $_POST['lastname'],
                ':email' => $_POST['email'],
                ':credits' => $_POST['credits'],
                ':type' => $_POST['type'],
                ':id' => $_POST['id']
            ));
            header('location: ../../users.php');
        } else {

            $req = $bdd->query('SELECT email FROM users');
            $email = $req->fetchAll();

            if (in_array($_POST['email'], array_column($email, 'email'), TRUE) == false) {

                $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname, email = :email,  credits = :credits, type = :type WHERE id= :id');
                $req->execute(array(
                    ':name' => $_POST['name'],
                    ':lastname' => $_POST['lastname'],
                    ':email' => $_POST['email'],
                    ':credits' => $_POST['credits'],
                    ':type' => $_POST['type'],
                    ':id' => $_POST['id']
                ));
                $bdd = null;
                header('location: ../../users.php?success=edit_ok');
                die();
            }
            $bdd = null;
            header('location: ../../users.php?error=emailexist');
            die();
        }
    } else {

        $bdd = null;
        header('location: ../../users.php?error=forbidden_action');
        die();
    }
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../users.php?error=processing_bad_or_malformed_request');
    die();
}
