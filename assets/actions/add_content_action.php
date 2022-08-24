<?php
session_start();
require('../require/co_bdd.php');



if (isset($_FILES) && !empty($_FILES)) {
   if (array_key_exists('content', $_FILES)) {
      if ($_FILES['content']['error'] == 0) {
         if (in_array($_FILES['content']['type'], ['video/mp4', 'image/png', 'image/jpeg'])) {
            if ($_FILES['content']['size'] <= 128000000) {
               $content = uniqid() . '.' . pathinfo($_FILES['content']['name'], PATHINFO_EXTENSION);
               move_uploaded_file($_FILES['content']['tmp_name'], '../contents_img/' . $content);
            } else {
               var_dump('Le fichier est trop volumineux…');
               exit;
            }
         } else {
            echo 'Le type mime du fichier est incorrect…';
         }
      } else {
         echo 'Le fichier n\'a pas pu être récupéré…';
      }
   }
}

$free_content = $_POST['free_content'];

if (!isset($free_content)) {
   if ($_POST['category'] == 'Tutorial') {
      $price = 15;
   } else if ($_POST['category'] == 'Performance') {
      $price = 5;
   } else if ($_POST['category'] == 'Sheet Music') {
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

if ($_POST['category'] == 'Tutorial') {
   $credits += 30;
} else if ($_POST['category'] == 'Performance') {
   $credits += 10;
} else if ($_POST['category'] == 'Sheet Music') {
   $credits += 20;
}

$req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
$req->execute(array(
   ':credits' => $credits,
   ':users_id' => $_SESSION['users']['id']
));


if ($_GET['type'] == 'admin') {
   header('location: ../../admin/contents.php');
} else {
   if ($_POST['category'] == "Tutorial") {
      header('location: ../../content.php?category=Tutorial&success=add_content');
   } else if ($_POST['category'] == "Performance") {
      header('location: ../../content.php?category=Performance&success=add_content');
   } else if ($_POST['category'] == "Sheet Music") {
      header('location: ../../content.php?category=Sheet Music&success=add_content');
   }
}
