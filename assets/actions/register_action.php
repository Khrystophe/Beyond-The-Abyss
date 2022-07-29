<?php
require('../require/co_bdd.php');

$req = $bdd->query('SELECT email FROM users');
$email = $req->fetchAll();

if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {

   if (in_array($_POST['email'], array_column($email, 'email'), TRUE) == false) {

      if ($_POST['password'] == $_POST['confirm_password']) {

         $req = $bdd->prepare("INSERT INTO users(name,lastname,email,password) VALUES (?,?,?,?)");
         $req->execute(array(
            $_POST['name'],
            $_POST['lastname'],
            $_POST['email'],
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
