<?php
session_start();
require('../require/check_data.php');


if (
   isset($files_content_name)
   && isset($post_title)
   && isset($post_composer)
   && isset($post_category)
   && isset($post_level)
   && isset($post_price)
   && isset($post_description)
   && isset($session_users_id)
   && isset($get_type)
) {

   require('../require/co_bdd.php');
   require('../require/action_deco_auto.php');

   if (isset($files_content_name)) {

      if ($files_content_error == 0) {

         if ($files_content_size <= 128000000) {

            $content = uniqid() . '.' . pathinfo($files_content_name, PATHINFO_EXTENSION);
            move_uploaded_file($files_content_tmp_name, '../videos/' . $content);
         } else {

            if ($get_type == 'admin') {

               $bdd = null;
               header('location: ../../admin/contents.php?error=024129');
               die();
            } else {

               $bdd = null;
               header('location: ../../my_account.php?error=024154');
               die();
            }
         }
      } else {

         if ($get_type == 'admin') {

            $bdd = null;
            header('location: ../../admin/contents.php?error=024130');
            die();
         } else {

            $bdd = null;
            header('location: ../../my_account.php?error=024155');
            die();
         }
      }
   }

   require('../require/frame.php');

   if ($post_price == 'Free') {
      $post_price = 0;
   }

   $req = $bdd->prepare("INSERT INTO contents( title, composer, level, category, content, price, description, id_users) VALUES (:title, :composer, :level, :category, :content, :price, :description, :id_users)");
   $req->bindParam(':title', $post_title, PDO::PARAM_STR);
   $req->bindParam(':composer', $post_composer, PDO::PARAM_STR);
   $req->bindParam(':category', $post_category, PDO::PARAM_STR);
   $req->bindParam(':level', $post_level, PDO::PARAM_STR);
   $req->bindParam(':price', $post_price, PDO::PARAM_INT);
   $req->bindParam(':description', $post_description, PDO::PARAM_STR);
   $req->bindParam(':content', $content);
   $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
   $req->execute();

   $req = $bdd->prepare('SELECT credits FROM users WHERE users.id = :users_id');
   $req->bindParam(':users_id', $session_users_id, PDO::PARAM_INT);
   $req->execute();
   $credits = $req->fetch();
   $credits = implode($credits);

   if ($post_category == 'tutorial') {
      $credits += 300;
   } else if ($post_category == 'performance') {
      $credits += 100;
   } else if ($post_category == 'sheet_music') {
      $credits += 200;
   }

   $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
   $req->bindParam(':credits', $credits, PDO::PARAM_INT);
   $req->bindParam(':users_id', $session_users_id, PDO::PARAM_INT);
   $req->execute();

   if ($get_type == 'admin') {

      $bdd = null;
      header('location: ../../admin/contents.php?success=024257');
      die();
   } else {


      $bdd = null;
      header('location: ../../content.php?name=user&category=user_content&success=024258');
      die();
   }
} else {

   if ($get_type == 'admin') {

      $bdd = null;
      http_response_code(400);
      header('location: ../../admin/contents.php?error=02415');
      die();
   } else {

      $bdd = null;
      http_response_code(400);
      header('location: ../../my_account.php?error=024153');
      die();
   }
}
