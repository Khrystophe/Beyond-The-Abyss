<?php
session_start();
require('../require/co_bdd.php');


if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) {

   $req = $bdd->prepare('SELECT email FROM users WHERE email = :email');
   $req->execute(array(
      ':email' => $_POST['email']
   ));
   $email = $req->fetchColumn();

   if (!$email) {

      if ($_POST['password'] == $_POST['password_confirm']) {

         $req = $bdd->prepare("INSERT INTO users(name,lastname,email,password) VALUES (:name, :lastname, :email, :password)");
         $success = $req->execute(array(
            ':name' => $_POST['name'],
            ':lastname' => $_POST['lastname'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
         ));
         if ($success) {
            $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
            $req->execute(array(
               ':email' => $_POST['email']
            ));
            $user = $req->fetch();

            $_SESSION['users']['id'] = $user['id'];
            $_SESSION['users']['email'] = $user['email'];
            $_SESSION['users']['name'] = $user['name'];
            $_SESSION['users']['lastname'] = $user['lastname'];
            $_SESSION['users']['type'] = $user['type'];
         } else {

            header('location: ../../register.php?error=contact_admin');
         }

         header('location: ../../my_account.php?success=creation');
      } else {

         header('location: ../../register.php?error=confirm_false');
      }
   } else {

      header('location: ../../register.php?error=email_exist');
   }
}
