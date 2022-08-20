<?php


require('../php/co_bdd.php');


$requete = $bdd->prepare('SELECT * FROM contents WHERE id = :id');
$requete->execute(array(
    ':id' => $_GET['id']
));
$user = $requete->fetch();

unlink('../uploads/' . $user['image']);

$req = $bdd->prepare('DELETE FROM contents WHERE id= :id');
$req->execute(array(
    ':id' => $_GET['id']
));
header('location: ../../contents.php');
