<?php
session_start();
require('../require/check_data.php');


if (
  isset($post_comment)
  && isset($post_id)
  && isset($session_users_id)
) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');

  $date = date('Y-m-d H:i:s');

  $req = $bdd->prepare("INSERT INTO comments( comment, date , id_contents, id_users) VALUES (:comment, :date, :id_contents, :id_users)");
  $req->bindParam(':comment', $post_comment, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->bindParam(':id_contents', $post_id, PDO::PARAM_INT);
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->execute();

  $bdd = null;
  header('location: ../../single_player_content.php?id=' . $post_id . '&success=011216');
  die();
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../single_player_content.php?id=' . $post_id . '&error=01115');
  die();
}
