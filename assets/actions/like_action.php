<?php
session_start();
require('../require/co_bdd.php');

if ($_GET['name'] == 'content') {

  $req = $bdd->prepare('SELECT id_users FROM likes WHERE id_contents = :contents_id');
  $req->execute(array(
    ':contents_id' => $_GET['id']
  ));
  $user_like = $req->fetch();


  if (!$user_like) {

    $req = $bdd->prepare('INSERT INTO likes (id_users, id_contents) VALUES (:users_id, :contents_id) ');
    $req->execute(array(
      ':users_id' => $_SESSION['users']['id'],
      ':contents_id' => $_GET['id']
    ));

    $req = $bdd->prepare('SELECT likes FROM contents WHERE contents.id = :contents_id');
    $req->execute(array(
      ':contents_id' => $_GET['id']
    ));
    $nbrOfLikes = $req->fetch();

    $likes = implode($nbrOfLikes);
    $likes++;

    $req = $bdd->prepare('UPDATE contents SET likes = :likes WHERE contents.id = :contents_id');
    $req->execute(array(
      ':likes' => $likes,
      ':contents_id' => $_GET['id']
    ));

    header('location: ../../single_player_content.php?id=' . $_GET['id']);
  } else {

    header('location: ../../single_player_content.php?error=alreadyLiked&id=' . $_GET['id']);
  }
} else if ($_GET['name'] == 'comment') {

  $req = $bdd->prepare('SELECT id_users FROM likes WHERE id_comments = :comments_id');
  $req->execute(array(
    ':comments_id' => $_GET['id_comment']
  ));
  $user_like = $req->fetchAll();

  if (!$user_like) {

    $req = $bdd->prepare('INSERT INTO likes (id_users, id_comments) VALUES (:users_id, :comments_id) ');
    $req->execute(array(
      ':users_id' => $_SESSION['users']['id'],
      ':comments_id' => $_GET['id_comment']
    ));

    $req = $bdd->prepare('SELECT likes FROM comments WHERE comments.id = :comments_id');
    $req->execute(array(
      ':comments_id' => $_GET['id_comment']
    ));
    $nbrOfLikes = $req->fetch();

    $likes = implode($nbrOfLikes);
    $likes++;

    $req = $bdd->prepare('UPDATE comments SET likes = :likes WHERE comments.id = :comments_id');
    $req->execute(array(
      ':likes' => $likes,
      ':comments_id' => $_GET['id_comment']
    ));

    header('location: ../../single_player_content.php?id=' . $_GET['id']);
  } else {

    header('location: ../../single_player_content.php?error=alreadyLiked&id=' . $_GET['id']);
  }
}
