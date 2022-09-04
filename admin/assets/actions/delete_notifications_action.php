<?php

require('../require/co_bdd.php');


$req = $bdd->prepare('DELETE FROM notifications WHERE id= :id');
$req->execute(array(
  ':id' => $_GET['id'],
));
header('location: ../../notifications.php');
