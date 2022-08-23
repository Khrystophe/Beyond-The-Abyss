<?php


require('../require/co_bdd.php');


$req = $bdd->prepare('DELETE FROM purchased_contents WHERE id= :id');
$req->execute(array(
    ':id' => $_GET['id']
));
header('location: ../../purchased_contents.php');
