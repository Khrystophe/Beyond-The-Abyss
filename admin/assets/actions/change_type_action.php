<?php

require('../require/co_bdd.php');


$req = $bdd->prepare('UPDATE users SET type = :type WHERE id= :id');
$req->execute(array(
    ':type' => $_POST['type'],
    ':id' => $_GET['id']
));
$type = $req->fetchAll();




header('location: ../../users.php');
