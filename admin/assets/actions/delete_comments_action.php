<?php

require('../require/co_bdd.php');


$req = $bdd->prepare('DELETE FROM comments WHERE id= :id');
$req->execute(array(
    ':id' => $_GET['id'],
));
header('location: ../../comments.php');
