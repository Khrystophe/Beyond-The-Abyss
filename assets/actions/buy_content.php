<?php
session_start();
require('../require/co_bdd.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {

  $req = $bdd->prepare('SELECT price FROM contents WHERE id = :id');
  $req->execute(array(
    ':id' => $_GET['id']
  ));
  $contentPrice = $req->fetch();
  $price = implode($contentPrice);

  $req = $bdd->prepare('SELECT credits FROM users WHERE id = :id');
  $req->execute(array(
    ':id' => $_SESSION['users']['id']
  ));
  $nbrOfCredits = $req->fetch();
  $credits = implode($nbrOfCredits);

  if ($credits >= $price) {

    $credits -= $price;

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id= :users_id');
    $req->execute(array(
      ':credits' => $credits,
      ':users_id' => $_SESSION['users']['id']
    ));

    $req = $bdd->prepare('INSERT INTO purchased_contents(id_contents, id_users) VALUES (:id_contents, :id_users)');
    $req->execute(array(
      ':id_contents' => $_GET['id'],
      ':id_users' => $_SESSION['users']['id']
    ));

    header('location: ../../single_player_content.php?success=contentBuy&id=' . $_GET['id']);
  } else {

    header('location: ../../index.php?error=insuffisantCredits');
  }
} else {

  header('location: ../../index.php?error=notConnected');
}
