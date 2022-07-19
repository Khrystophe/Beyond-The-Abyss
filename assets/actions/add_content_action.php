<?php
session_start();
require('../require/co_bdd.php');



if (isset($_FILES) && !empty($_FILES)) {
  if (array_key_exists('content', $_FILES)) {
    if ($_FILES['content']['error'] == 0) {
      if (in_array($_FILES['content']['type'], ['video/mp4', 'image/png', 'image/jpeg'])) {
        if ($_FILES['content']['size'] <= 3000000) {
          $content = uniqid() . '.' . pathinfo($_FILES['content']['name'], PATHINFO_EXTENSION);
          move_uploaded_file($_FILES['content']['tmp_name'], '../contents_img/' . $content);
        } else {
          echo 'Le fichier est trop volumineux…';
        }
      } else {
        echo 'Le type mime du fichier est incorrect…';
      }
    } else {
      echo 'Le fichier n\'a pas pu être récupéré…';
    }
  }
}



if ($content == null) {
  $req = $bdd->prepare("INSERT INTO `contents`( `title`,`composer`, `level`, `category`,`price`) VALUES (?,?,?,?,?)");
  $req->execute(array(
    $_POST['title'],
    $_POST['composer'],
    $_POST['level'],
    $_POST['category'],
    $_POST['price'],

  ));
  if ($_POST['category'] == "tuto") {
    header('location: ../content.php?category=tuto&success=add_content');
  } else if ($_POST['category'] == "perf") {
    header('location: ../content.php?category=perf&success=add_content');
  } else if ($_POST['category'] == "sheet") {
    header('location: ../content.php?category=sheet&success=add_content');
  }
} else {
  $req = $bdd->prepare("INSERT INTO `contents`( `title`,`composer`, `level`, `category`,`content`, `price`) VALUES (?,?,?,?,?,?)");
  $req->execute(array(
    $_POST['title'],
    $_POST['composer'],
    $_POST['level'],
    $_POST['category'],
    $content,
    $_POST['price'],

  ));
  if ($_POST['category'] == "tuto") {
    header('location: ../../content.php?category=tuto&success=add_content');
  } else if ($_POST['category'] == "perf") {
    header('location: ./content.php?category=perf&success=add_content');
  } else if ($_POST['category'] == "sheet") {
    header('location: ./content.php?category=sheet&success=add_content');
  }
}
