<?php
session_start();
require('../require/check_data.php');

if ($check_email !== false && $check_password === true && $password != NULL) {

   require('../require/co_bdd.php');

   $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
   $req->bindParam(':email', $email, PDO::PARAM_STR);
   $req->execute();
   $user = $req->fetch();

   if ($user) {

      if (password_verify($password, htmlspecialchars($user['password']))) {

         $_SESSION['users']['id'] = htmlspecialchars($user['id']);
         $_SESSION['users']['type'] = htmlspecialchars($user['type']);

         header('location: ../../my_account.php?success=connected');
      } else {
         header('location: ../../login.php?error=password');
      }
   } else {
      header('location: ../../login.php?error=nonexist');
   }
} else {
   header('location: ../../login.php?error=null');
}
