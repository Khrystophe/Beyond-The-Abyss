<?php

require('../require/co_bdd.php');


$req = $bdd->prepare('DELETE FROM likes WHERE id= :id');
$req->execute(array(
  ':id' => $_GET['id'],
));
header('location: ../../likes.php');
