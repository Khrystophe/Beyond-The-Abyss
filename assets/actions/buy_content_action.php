<?php
session_start();
require('../require/check_data.php');


if (
  isset($get_id)
  && isset($session_users_id)
) {

  require('../require/co_bdd.php');
  require('../require/action_deco_auto.php');

  if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {

    $req = $bdd->prepare('SELECT price FROM contents WHERE id = :id');
    $req->bindParam(':id', $get_id, PDO::PARAM_INT);
    $req->execute();
    $content_price = $req->fetch();
    $price = implode($content_price);

    $req = $bdd->prepare('SELECT credits FROM users WHERE id = :id');
    $req->bindParam(':id', $session_users_id, PDO::PARAM_INT);
    $req->execute();
    $number_of_credits = $req->fetch();
    $credits = implode($number_of_credits);

    if ($credits >= $price) {

      $credits -= $price;

      $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id= :users_id');
      $req->bindParam(':credits', $credits, PDO::PARAM_INT);
      $req->bindParam(':users_id', $session_users_id, PDO::PARAM_INT);
      $req->execute();

      $req = $bdd->prepare('INSERT INTO purchased_contents(id_contents, id_users, original_price) VALUES (:id_contents, :id_users, :original_price)');
      $req->bindParam(':id_contents', $get_id, PDO::PARAM_INT);
      $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
      $req->bindParam(':original_price', $price, PDO::PARAM_INT);
      $req->execute();

      $req = $bdd->prepare('SELECT users.credits, users.id 
      FROM users
      INNER JOIN contents
      ON users.id = contents.id_users 
      WHERE contents.id = :id');
      $req->bindParam(':id', $get_id, PDO::PARAM_INT);
      $req->execute();
      $number_of_credits = $req->fetch();

      $author_credits = $number_of_credits['credits'];
      $author_credits += 3;

      $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
      $req->bindParam(':credits', $author_credits, PDO::PARAM_INT);
      $req->bindParam(':users_id', $number_of_credits['id'], PDO::PARAM_INT);
      $req->execute();

      $bdd = null;
      header('location: ../../single_player_content.php?success=content_buy&id=' . $get_id);
      die();
    } else {

      $bdd = null;
      header('location: ../../my_account.php?error=insuffisant_credits');
      die();
    }
  } else {

    $bdd = null;
    header('location: ../../login.php?error=notConnected');
    die();
  }
} else {

  $bdd = null;
  http_response_code(400);
  header('location: ../../my_account.php?error=processing_bad_or_malformed_request');
  die();
}
