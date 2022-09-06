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

         $req = $bdd->prepare("INSERT INTO users(name, lastname, email, password) VALUES (:name, :lastname, :email, :password)");
         $req->bindParam(':name', $post_name, PDO::PARAM_STR);
         $req->bindParam(':lastname', $post_lastname, PDO::PARAM_STR);
         $req->bindParam(':email', $post_email, PDO::PARAM_STR);
         $req->bindParam(':password', $password, PDO::PARAM_STR);
         $success = $req->execute();

         if ($success) {

            $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
            $req->bindParam(':email', $post_email);
            $req->execute();
            $user = $req->fetch();

            $_SESSION['users']['id'] = htmlspecialchars($user['id']);
            $_SESSION['users']['type'] = htmlspecialchars($user['type']);

            $time = time();

            $req = $bdd->prepare('INSERT INTO time (time, id_users) VALUES (:time, :id_users)');
            $req->bindParam(':time', $time);
            $req->bindParam(':id_users', $_SESSION['users']['id']);
            $req->execute();

            $bdd = null;
            header('location: ../../my_account.php?success=creation');
            die();
         } else {

            $bdd = null;
            header('location: ../../register.php?error=contact_admin');
            die();
         }
      } else {

         $bdd = null;
         header('location: ../../register.php?error=confirm_false');
         die();
      }
   } else {

      $bdd = null;
      header('location: ../../register.php?error=email_exist');
      die();
   }
} else {

   $bdd = null;
   http_response_code(400);
   header('location: ../../register.php?error=processing_bad_or_malformed_request');
   die();
}
