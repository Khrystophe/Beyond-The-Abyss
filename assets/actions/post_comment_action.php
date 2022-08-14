<?php
session_start();
require('../require/co_bdd.php');

$date = date('l jS \of F Y h:i:s A');

$req = $bdd->prepare("INSERT INTO comments( comment, date ,id_contents, id_users) VALUES (:comment,:date, :id_contents,:id_users)");
$req->execute(array(
  ':comment' => $_POST['comment'],
  ':date' => $date,
  ':id_contents' => $_POST['id'],
  ':id_users' => $_SESSION['users']['id'],
));

header('location: ../../single_player_content.php?id=' . $_POST['id']);
