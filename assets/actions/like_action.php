<?php
session_start();
require('../require/check_data.php');


if (
  isset($get_id)
  && isset($get_name)
  && (isset($get_id_comment) xor !isset($check_get_id_comment))
  && isset($session_users_id)
) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');


  if ($get_name == 'content') {

    $req = $bdd->prepare('SELECT id_users FROM likes WHERE id_contents = :contents_id');
    $req->bindParam(':contents_id', $get_id, PDO::PARAM_INT);
    $req->execute();
    $user_like = $req->fetchAll();

    if (in_array($session_users_id, array_column($user_like, 'id_users')) == false) {

      $req = $bdd->prepare('INSERT INTO likes (id_users, id_contents) VALUES (:users_id, :contents_id) ');
      $req->bindParam(':users_id', $session_users_id, PDO::PARAM_INT);
      $req->bindParam(':contents_id', $get_id, PDO::PARAM_INT);
      $req->execute();

      $req = $bdd->prepare('SELECT likes FROM contents WHERE contents.id = :contents_id');
      $req->bindParam(':contents_id', $get_id, PDO::PARAM_INT);
      $req->execute();
      $likes = $req->fetch();
      $likes = implode($likes);
      $likes++;

      $req = $bdd->prepare('UPDATE contents SET likes = :likes WHERE contents.id = :contents_id');
      $req->bindParam(':likes', $likes, PDO::PARAM_INT);
      $req->bindParam(':contents_id', $get_id, PDO::PARAM_INT);
      $req->execute();

      $req = $bdd->prepare('SELECT users.credits, users.id 
      FROM users
      INNER JOIN contents
      ON users.id = contents.id_users 
      WHERE contents.id = :id');
      $req->bindParam(':id', $get_id, PDO::PARAM_INT);
      $req->execute();
      $user = $req->fetch();

      $author_credits = $user['credits'];
      $author_credits++;

      $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
      $req->bindParam(':credits', $author_credits, PDO::PARAM_INT);
      $req->bindParam(':users_id', $user['id'], PDO::PARAM_INT);
      $req->execute();

      $bdd = null;
      header('location: ../../single_player_content.php?id=' . $get_id . '&success=014221');
      die();
    } else {

      $bdd = null;
      header('location: ../../single_player_content.php?id=' . $get_id . '&error=014122');
      die();
    }
  } else if ($get_name == 'comment') {

    $req = $bdd->prepare('SELECT id_users FROM likes WHERE id_comments = :comments_id');
    $req->bindParam(':comments_id', $get_id_comment, PDO::PARAM_INT);
    $req->execute();
    $user_like = $req->fetchAll();


    if (in_array($session_users_id, array_column($user_like, 'id_users')) == false) {

      $req = $bdd->prepare('INSERT INTO likes (id_users, id_comments) VALUES (:users_id, :comments_id) ');
      $req->bindParam(':users_id', $session_users_id, PDO::PARAM_INT);
      $req->bindParam(':comments_id', $get_id_comment, PDO::PARAM_INT);
      $req->execute();

      $req = $bdd->prepare('SELECT likes FROM comments WHERE comments.id = :comments_id');
      $req->bindParam(':comments_id', $get_id_comment, PDO::PARAM_INT);
      $req->execute();
      $likes = $req->fetch();
      $likes = implode($likes);
      $likes++;

      $req = $bdd->prepare('UPDATE comments SET likes = :likes WHERE comments.id = :comments_id');
      $req->bindParam(':likes', $likes, PDO::PARAM_INT);
      $req->bindParam(':comments_id', $get_id_comment, PDO::PARAM_INT);
      $req->execute();

      $bdd = null;
      header('location: ../../single_player_content.php?id=' . $get_id . '&success=014223');
      die();
    } else {

      $bdd = null;
      header('location: ../../single_player_content.php?id=' . $get_id . '&error=014124');
      die();
    }
  }
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../single_player_content.php?error=01415');
  die();
}
