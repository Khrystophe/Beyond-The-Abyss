<?php
session_start();
require('../require/check_data.php');

if (
  isset($post_message)
  && isset($session_users_id)
  && isset($post_id)
) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');

  $date = date('Y-m-d H:i:s');

  $req = $bdd->prepare("INSERT INTO reporting( message, date, id_users, id_contents) VALUES (:message, :date, :id_users, :id_contents)");
  $req->bindParam(':message', $post_message, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->bindParam(':id_contents', $post_id, PDO::PARAM_INT);
  $req->execute();

  $req = $bdd->prepare('SELECT users.name, users.lastname FROM users WHERE id = :session_users_id');
  $req->bindParam(':session_users_id', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $user = $req->fetch();

  $notification = 'Hello ' . $user['name'] . ' ' . $user['lastname'] . ' ! 

  Your reporting :

  "' . $post_message . '" 
  
  has been sent successfully. 
  
  We will analyze it as soon as possible. 
  
  Thank You';

  $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
  $req->bindParam(':notification', $notification, PDO::PARAM_STR);
  $req->bindParam(':date', $date, PDO::PARAM_STR);
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->execute();

  $req = $bdd->prepare('SELECT reporting FROM contents WHERE id = :post_id');
  $req->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $req->execute();
  $reporting = $req->fetch();
  $reporting = implode($reporting);
  $reporting++;

  $req = $bdd->prepare('UPDATE contents SET reporting = :reporting  WHERE id = :post_id');
  $req->bindParam(':reporting', $reporting, PDO::PARAM_INT);
  $req->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $req->execute();

  $bdd = null;
  header('location: ../../single_player_content.php?id=' . $post_id . '&success=009211');
  die();
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../single_player_content.php?error=00915');
  die();
}
