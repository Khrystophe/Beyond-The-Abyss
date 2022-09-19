<?php
session_start();
require('../require/check_data.php');

if (
  isset($session_users_id)
  && (isset($session_users_type) && $session_users_type == 'admin')
  && isset($post_id)
  && isset($post_message)
  && isset($post_notification)
  && isset($post_name)
  && isset($post_lastname)
) {

  var_dump($post_id);
  var_dump($post_notification);
  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');

  $date = date('Y-m-d H:i:s');

  $notification = 'In reply to your message :
    
    "' . $post_message . '"  
    
    Here is our answer as promised :

    Hello ' . $post_name . " " . $post_lastname . ' ! 
    
    ' . $post_notification . '
    
    Have a good day';

  $req = $bdd->prepare('INSERT INTO notifications (id_users, notification, date) VALUES (:id_users, :notification, :date) ');
  $req->bindParam(':id_users', $post_id, PDO::PARAM_INT);
  $req->bindParam(':notification', $notification, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->execute();

  $bdd = null;
  header('location: ../../contacts.php?success=032241');
  die();
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../contacts.php?error=03215');
  die();
}
