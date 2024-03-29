<?php
session_start();
require('../require/check_data.php');

if (
   isset($post_name)
   && isset($post_lastname)
   && isset($post_email)
   && isset($post_password)
   && isset($post_password_confirm)
) {

   require('../require/co_bdd.php');

   $req = $bdd->prepare('SELECT email FROM users WHERE email = :email');
   $req->bindParam(':email', $post_email, PDO::PARAM_STR);
   $req->execute();
   $email_exist = $req->fetchColumn();

   if (!$email_exist) {

      if ($post_password == $post_password_confirm) {

         $password = password_hash($post_password, PASSWORD_BCRYPT);
         $time = time();

         $req = $bdd->prepare("INSERT INTO users(name, lastname, email, password, time) VALUES (:name, :lastname, :email, :password, :time)");
         $req->bindParam(':name', $post_name, PDO::PARAM_STR);
         $req->bindParam(':lastname', $post_lastname, PDO::PARAM_STR);
         $req->bindParam(':email', $post_email, PDO::PARAM_STR);
         $req->bindParam(':password', $password, PDO::PARAM_STR);
         $req->bindParam(':time', $time);
         $success = $req->execute();

         if ($success) {

            $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
            $req->bindParam(':email', $post_email);
            $req->execute();
            $user = $req->fetch();

            $_SESSION['users']['id'] = htmlspecialchars($user['id']);
            $_SESSION['users']['type'] = htmlspecialchars($user['type']);

            $bdd = null;
            header('location: ../../my_account.php?success=010212');
            die();
         } else {

            $bdd = null;
            header('location: ../../register.php?error=010113');
            die();
         }
      } else {

         $bdd = null;
         header('location: ../../register.php?error=010114');
         die();
      }
   } else {

      $bdd = null;
      header('location: ../../register.php?error=010115');
      die();
   }
} else {

   $bdd = null;
   http_response_code(400);
   header('location: ../../register.php?error=01015');
   die();
}
