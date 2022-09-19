<?php
session_start();
require('../require/check_data.php');


if (
  isset($post_message)
  && isset($session_users_id)
) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');

  $date = date('Y-m-d H:i:s');

  $req = $bdd->prepare("INSERT INTO contact( message, date, id_users) VALUES (:message, :date, :id_users)");
  $req->bindParam(':message', $post_message, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->execute();

  $req = $bdd->prepare('SELECT users.name, users.lastname FROM users WHERE id = :session_users_id');
  $req->bindParam(':session_users_id', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $user = $req->fetch();

  $notification = 'Hello ' . $user['name'] . ' ' . $user['lastname'] . ' ! 

  Your message :

  "' . $post_message . '" 
  
  has been sent successfully. 
  
  A response will be sent to you very quickly. 
  
  Thank You';

  $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
  $req->bindParam(':notification', $notification, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->execute();

  $bdd = null;
  header('location: ../../my_account.php?success=022237');
  die();
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../my_account.php?error=02215');
  die();
}
