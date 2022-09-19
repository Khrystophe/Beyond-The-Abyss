<?php
session_start();
require('../require/check_data.php');

if (
    isset($session_users_id)
    && (isset($session_users_type) && $session_users_type == 'admin')
    && isset($post_id)
    && isset($post_name)
    && isset($post_lastname)
    && isset($post_email)
    && ((isset($check_post_credits) && ($check_post_credits === true)) xor $check_post_credits === null)
    && isset($post_type)
) {

    if (($session_users_id != $post_id)) {

        require('../require/co_bdd.php');
        require('../require/action_deco_auto.php');

        $req = $bdd->prepare('SELECT email FROM users WHERE id = :id');
        $req->execute(array(
            ':id' => $post_id
        ));
        $user_email = $req->fetch();

        if ($post_email == $user_email['email']) {

            $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname, email = :email, credits = :credits, type = :type WHERE id= :id');
            $req->execute(array(
                ':name' => $post_name,
                ':lastname' => $post_lastname,
                ':email' => $post_email,
                ':credits' => $_POST['credits'],
                ':type' => $post_type,
                ':id' => $post_id
            ));

            header('location: ../../users.php?success=033242');
        } else {

            $req = $bdd->query('SELECT email FROM users');
            $email = $req->fetchAll();

            if (in_array($post_email, array_column($email, 'email'), TRUE) == false) {

                $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname, email = :email,  credits = :credits, type = :type WHERE id= :id');
                $req->execute(array(
                    ':name' => $post_name,
                    ':lastname' => $post_lastname,
                    ':email' => $post_email,
                    ':credits' => $_POST['credits'],
                    ':type' => $post_type,
                    ':id' => $post_id
                ));
                $bdd = null;
                header('location: ../../users.php?success=033260');
                die();
            } else {

                $bdd = null;
                header('location: ../../users.php?error=033115');
                die();
            }
        }
    } else {

        $bdd = null;
        header('location: ../../users.php?error=033134');
        die();
    }
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../users.php?error=03315');
    die();
}
