<?php
session_start();
require('../require/check_data.php');


if (
  isset($post_id)
  && isset($get_id)
  && isset($post_comment)
  && isset($session_users_id)

) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');

  $req = $bdd->prepare('UPDATE comments SET comment = :comment WHERE id = :id');
  $req->bindParam(':comment', $post_comment, PDO::PARAM_STR);
  $req->bindParam(':id', $post_id, PDO::PARAM_INT);
  $req->execute();

  header('location: ../../single_player_content.php?id=' . $get_id . '&success=comment_edited');
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../single_player_content.php?error=processing_bad_or_malformed_request');
  die();
}
