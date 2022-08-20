<?php

require('../php/co_bdd.php');


$req = $bdd->prepare('DELETE FROM users WHERE id= ?');
$req->execute(array(
    $_GET['id'],
));
header('location: ../../clients.php');
