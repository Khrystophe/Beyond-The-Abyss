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

   if ($files_content_error == 0) {
      if ($files_content_size <= 128000000) {
         $content = uniqid() . '.' . pathinfo($files_content_name, PATHINFO_EXTENSION);
         move_uploaded_file($files_content_tmp_name, '../contents_img/' . $content);
      } else {

         echo 'Le fichier est trop volumineux…';
      }
   } else {

      echo 'Le fichier n\'a pas pu être récupéré…';
   }

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
   $nbrOfCredits = $req->fetch();
   $credits = implode($nbrOfCredits);

   if ($post_category == 'tutorial') {
      $credits += 30;
   } else if ($post_category == 'performance') {
      $credits += 10;
   } else if ($post_category == 'sheet_music') {
      $credits += 20;
   }

   $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
   $req->bindParam(':credits', $credits, PDO::PARAM_INT);
   $req->bindParam(':users_id', $session_users_id, PDO::PARAM_INT);
   $req->execute();

   if ($get_type == 'admin') {

      $bdd = null;
      header('location: ../../admin/contents.php');
      die();
   } else {
      if ($post_category == "tutorial") {

         $bdd = null;
         header('location: ../../content.php?category=tutorial&success=add_content');
         die();
      } else if ($post_category == "performance") {

         $bdd = null;
         header('location: ../../content.php?category=performance&success=add_content');
         die();
      } else if ($post_category == "sheet_music") {

         $bdd = null;
         header('location: ../../content.php?category=sheet_music&success=add_content');
         die();
      }
   }
} else {

   $bdd = null;
   http_response_code(400);
   header('location: ../../my_account.php?error=processing_bad_or_malformed_request');
   die();
}
