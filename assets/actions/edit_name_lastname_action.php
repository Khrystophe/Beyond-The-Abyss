<?php
session_start();
require('../require/check_data.php');


if (
  isset($post_name)
  && isset($post_lastname)
  && isset($session_users_id)
) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');


  $req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname WHERE id=' . $_SESSION['users']['id']);
  $req->bindParam(':name', $post_name, PDO::PARAM_STR);
  $req->bindParam(':lastname', $post_lastname, PDO::PARAM_STR);
  $req->execute();

  $bdd = null;
  header('location: ../../my_account.php');
  die();
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../my_account.php?error=processing_bad_or_malformed_request');
  die();
}
