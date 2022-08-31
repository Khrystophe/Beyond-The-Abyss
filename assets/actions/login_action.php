<?php
session_start();
require('../require/co_bdd.php');

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && $_POST['password'] != NULL) {

   $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
   $req->execute(array(
      ':email' => $_POST['email']
   ));
   $user = $req->fetch();

   if ($user) {

      if (password_verify($_POST['password'], $user['password'])) {

         $_SESSION['users']['id'] = $user['id'];
         $_SESSION['users']['name'] = $user['name'];
         $_SESSION['users']['lastname'] = $user['lastname'];
         $_SESSION['users']['email'] = $user['email'];
         $_SESSION['users']['type'] = $user['type'];
         $_SESSION['users']['credits'] = $user['credits'];

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
