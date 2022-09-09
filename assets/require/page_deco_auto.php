<?php

if (isset($session_users_id)) {

  $req = $bdd->prepare('SELECT time FROM users WHERE id= :session_users_id');
  $req->bindParam(':session_users_id', $session_users_id);
  $req->execute();
  $time = $req->fetch();

  $time = intval(implode($time));

  var_dump($time + 900 - time());

  if ($time + 900 - time() <= 0) {

    unset($_SESSION['users']);
    session_destroy();
    header('location: index.php?success=007246');
    die();
  }
}
