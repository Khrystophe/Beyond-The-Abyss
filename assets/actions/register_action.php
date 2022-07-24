<?php
require('../require/co_bdd.php');

$req = $bdd->query('SELECT email FROM users');
$email = $req->fetchAll();

if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['address']) && !empty($_POST['address']) && isset($_POST['postalCode']) && !empty($_POST['postalCode']) && isset($_POST['city']) && !empty($_POST['city']) && isset($_POST['country']) && !empty($_POST['country']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword'])) {

    if (in_array($_POST['email'], array_column($email, 'email'), TRUE) == false) {

        if ($_POST['password'] == $_POST['confirmPassword']) {

            $req = $bdd->prepare("INSERT INTO users(name,lastname,email,address,postalCode,city,country,password) VALUES (?,?,?,?,?,?,?,?)");
            $req->execute(array(
                $_POST['name'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['address'],
                $_POST['postalCode'],
                $_POST['city'],
                $_POST['country'],
                password_hash($_POST['password'], PASSWORD_BCRYPT),
            ));

            header('location: ../../index.php?success=creation');
        } else {

            header('location: ../../register.php?error=invalidPassword');
        }
    } else {
        header('location: ../../register.php?error=adressexistante');
    }
} else {

    header('location: ../../register.php?error=vide');
}
