<?php
session_start();
require('../require/co_bdd.php');

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];

    $req = $bdd->prepare('SELECT * FROM users WHERE email = ?');
    $req->execute([$email]);
    $user = $req->fetch();

    if ($user) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['users']['id'] = $user['id'];
            $_SESSION['users']['email'] = $user['email'];
            $_SESSION['users']['name'] = $user['name'];
            $_SESSION['users']['lastname'] = $user['lastname'];
            $_SESSION['users']['type'] = $user['type'];

            if (isset($_GET['page']) && !empty($_GET['page'])) {

                if ($_GET['page'] == 'add_content') {
                    header('location: ../../add_content.php');
                } else if ($_GET['page'] == 'my_account') {
                    header('location: ../../my_account.php');
                }
            } else {
                header('location: ../../index.php');
            }
        } else {
            header('location: ../../login.php?error=password');
        }
    } else {
        header('location: ../../login.php?error=nonexist');
    }
} else {
    header('location: ../../login.php?error=empty');
}
