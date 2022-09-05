<?php
session_start();
require('../require/check_data.php');


if (
  isset($get_id)
  && isset($session_users_id)
) {

  require('../require/co_bdd.php');

  $req = $bdd->prepare('DELETE FROM notifications WHERE id = :id');
  $req->bindParam(':id', $get_id, PDO::PARAM_INT);
  $req->execute();

  $bdd = null;
  header('location: ../../my_account.php?success=notification_deleted');
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../my_account.php?error=processing_bad_or_malformed_request');
  die();
}
