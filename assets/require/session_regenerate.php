<?php
if (isset($session_users_id)) {

  var_dump(session_id());

  $old_session = session_id();

  $req = $bdd->prepare('SELECT time FROM time WHERE id_users= :session_users_id');
  $req->bindParam(':session_users_id', $session_users_id);
  $req->execute();
  $time = $req->fetch();

  $time = intval(implode($time));

  var_dump($time + 30 - time());

  if ($time + 30 - time() <= 0) {

    $time = time();

    $req = $bdd->prepare('UPDATE time SET time = :time WHERE id_users= :session_users_id');
    $req->bindParam(':time', $time);
    $req->bindParam(':session_users_id', $session_users_id);
    $req->execute();

    if (session_status() === PHP_SESSION_ACTIVE) {

      session_regenerate_id();
      $new_session = session_id();

      if (isset($new_session)) {

        session_write_close();
        session_id($new_session);
      } else {

        session_write_close();
        session_id($old_session);
      }
    }
  }

  var_dump(session_id());
}
