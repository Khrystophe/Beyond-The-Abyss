<?php
session_start();
require('../require/check_data.php');

if ($check_name === true && $check_lastname === true && $check_email !== false && $check_password === true && $check_password_confirm === true) {

   require('../require/co_bdd.php');

   $req = $bdd->prepare('SELECT email FROM users WHERE email = :email');
   $req->bindParam(':email', $email, PDO::PARAM_STR);
   $req->execute();
   $email_exist = $req->fetchColumn();

   if (!$email_exist) {

      if ($_POST['password'] == $_POST['password_confirm']) {

         $req = $bdd->prepare("INSERT INTO users(name, lastname, email, password) VALUES (:name, :lastname, :email, :password)");
         $req->bindParam(':name', $name, PDO::PARAM_STR);
         $req->bindParam(':lastname', $lastname, PDO::PARAM_STR);
         $req->bindParam(':email', $email, PDO::PARAM_STR);
         $req->bindParam(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_INT);
         $success = $req->execute();

         if ($success) {

            $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
            $req->bindParam(':email', $email);
            $req->execute();
            $user = $req->fetch();

            $_SESSION['users']['id'] = htmlspecialchars($user['id']);
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
} else {

   http_response_code(400);
   die('Error processing bad or malformed request');
}
