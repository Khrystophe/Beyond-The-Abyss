<?php
session_start();
$old_session = session_id();

if (session_status() == PHP_SESSION_ACTIVE) {

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
