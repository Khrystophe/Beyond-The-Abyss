<?php
session_start();
require('../require/check_data.php');


if (
   isset($files_content_name)
) {

   require('../require/co_bdd.php');

   if ($files_content_error == 0) {
      if ($files_content_size <= 128000000) {
         $content = uniqid() . '.' . pathinfo($files_content_name, PATHINFO_EXTENSION);
         move_uploaded_file($files_content_tmp_name, '../contents_img/' . $content);
      } else {
         var_dump('Le fichier est trop volumineux…');
         exit;
      }
   } else {
      echo 'Le fichier n\'a pas pu être récupéré…';
   }


   if (isset($_POST['free_content']) && !empty($_POST['free_content'])) {
      $free_content = $_POST['free_content'];
   }


   if (!isset($free_content)) {
      if ($_POST['category'] == 'tutorial') {
         $price = 15;
      } else if ($_POST['category'] == 'performance') {
         $price = 5;
      } else if ($_POST['category'] == 'sheet_music') {
         $price = 10;
      }
   } else {
      $price = 0;
   }

   $req = $bdd->prepare("INSERT INTO contents( title, composer, level, category, content, price, description, id_users) VALUES (:title, :composer, :level, :category, :content, :price, :description, :id_users)");
   $req->execute(array(
      ':title' => $_POST['title'],
      ':composer' => $_POST['composer'],
      ':level' => $_POST['level'],
      'category' => $_POST['category'],
      ':content' => $content,
      ':price' => $price,
      ':description' => nl2br($_POST['description']),
      ':id_users' => $_SESSION['users']['id'],
   ));


   $req = $bdd->prepare('SELECT credits FROM users WHERE users.id = :users_id');
   $req->execute(array(
      ':users_id' => $_SESSION['users']['id']
   ));
   $nbrOfCredits = $req->fetch();
   $credits = implode($nbrOfCredits);

   if ($_POST['category'] == 'tutorial') {
      $credits += 30;
   } else if ($_POST['category'] == 'performance') {
      $credits += 10;
   } else if ($_POST['category'] == 'sheet_music') {
      $credits += 20;
   }

   $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
   $req->execute(array(
      ':credits' => $credits,
      ':users_id' => $_SESSION['users']['id']
   ));


   if ($_GET['type'] == 'admin') {

      header('location: ../../admin/contents.php');
      die();
   } else {
      if ($_POST['category'] == "tutorial") {

         header('location: ../../content.php?category=tutorial&success=add_content');
         die();
      } else if ($_POST['category'] == "performance") {

         header('location: ../../content.php?category=performance&success=add_content');
         die();
      } else if ($_POST['category'] == "sheet_music") {

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
