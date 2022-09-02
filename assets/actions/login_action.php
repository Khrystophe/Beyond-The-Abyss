<?php
session_start();
require('../require/check_data.php');

if (
   isset($post_email)
   && isset($post_password)
   && $post_password != NULL
) {

   require('../require/co_bdd.php');

   $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
   $req->bindParam(':email', $post_email, PDO::PARAM_STR);
   $req->execute();
   $user = $req->fetch();

   if ($user) {

      if (password_verify($post_password, htmlspecialchars($user['password']))) {

         $_SESSION['users']['id'] = htmlspecialchars($user['id']);
         $_SESSION['users']['type'] = htmlspecialchars($user['type']);

         $bdd = null;
         header('location: ../../my_account.php?success=connected');
      } else {

         $bdd = null;
         header('location: ../../login.php?error=password');
         die();
      }
   } else {

      $bdd = null;
      header('location: ../../login.php?error=none_exist');
      die();
   }
} else {

   $bdd = null;
   http_response_code(400);
   header('location: ../../login.php?error=null_password_or_processing_bad_or_malformed_request');
   die();
}
