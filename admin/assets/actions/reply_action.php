<?php
session_start();
require('../require/check_data.php');

if (
  isset($session_users_id)
  && isset($post_id)
  && isset($_POST['message'])
  && isset($_POST['notification'])
  && isset($_POST['name'])
  && isset($_POST['lastname'])
) {

  var_dump($post_id);
  var_dump($_POST['notification']);
  require('../require/co_bdd.php');

  $date = date('l jS \of F Y h:i:s A');

  $notification = 'In reply to your message :
    
    " ' . $_POST['message'] . ' "  
    
    Here is our answer as promised :

    Hello ' . $_POST['name'] . " " . $_POST['lastname'] . ' ! 
    
    ' . $_POST['notification'] . '
    
    Have a good day';

  $req = $bdd->prepare('INSERT INTO notifications (id_users, notification, date) VALUES (:id_users, :notification, :date) ');
  $req->bindParam(':id_users', $post_id, PDO::PARAM_INT);
  $req->bindParam(':notification', $notification, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->execute();

  $bdd = null;
  header('location: ../../contact.php?success=reply_ok');
  die();
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../contact.php?error=processing_bad_or_malformed_request');
  die();
}
