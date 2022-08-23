<?php

require('../require/co_bdd.php');


$req = $bdd->prepare('DELETE FROM users WHERE id= :id');
$req->execute(array(
    ':id' => $_GET['id'],
));
header('location: ../../users.php');
