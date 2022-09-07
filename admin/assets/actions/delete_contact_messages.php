<?php

require('../require/co_bdd.php');


$req = $bdd->prepare('DELETE FROM contact WHERE id= :id');
$req->execute(array(
    ':id' => $_GET['id'],
));
header('location: ../../contact.php');
