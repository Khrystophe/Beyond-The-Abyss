<?php
require('../require/co_bdd.php');

$req = $bdd->query('SELECT email FROM users');
$email = $req->fetchAll();

if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) {

   if (in_array($_POST['email'], array_column($email, 'email'), TRUE) == false) {

      if ($_POST['password'] == $_POST['password_confirm']) {

         $req = $bdd->prepare("INSERT INTO users(name,lastname,email,password) VALUES (:name, :lastname, :email, :password)");
         $req->execute(array(
            ':name' => $_POST['name'],
            ':lastname' => $_POST['lastname'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
         ));

         header('location: ../../index.php?success=creation');
      } else {

         header('location: ../../register.php?error=invalid_confirm');
      }
   } else {
      header('location: ../../register.php?error=email_exist');
   }
}
