<?php
session_start();
require('../require/co_bdd.php');


$req = $bdd->prepare('UPDATE users SET name = :name, lastname = :lastname WHERE id=' . $_SESSION['users']['id']);
$req->execute(array(
  ':name' => $_POST['name'],
  ':lastname' => $_POST['lastname'],
));

header('location: ../../my_account.php');
