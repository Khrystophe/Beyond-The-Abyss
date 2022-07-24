<?php
session_start();
require('../require/co_bdd.php');

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

            if ($_GET['page'] == 'ajout') {
                header('location: ../ajout.php');
            } else if ($_GET['page'] == 'compte') {
                header('location: ../compte.php');
            }
        } else {
            header('location: ../../index.php');
        }
    } else {
        header('location: ../../connexionFormulaire.php?error=password');
    }
} else {
    header('location: ../../connexionFormulaire.php?error=nonexist');
}
