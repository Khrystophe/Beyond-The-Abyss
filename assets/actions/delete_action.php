<?php
require('../require/co_bdd.php');

$requete = $bdd->prepare('SELECT * FROM contents WHERE id = ?');
$requete->execute(array(
    $_GET['id'],
));
$content = $requete->fetch();

$req = $bdd->prepare('DELETE FROM contents WHERE id = ?');
$req->execute(array(
    $_GET['id'],
));
unlink('../contents_img/' . $content['content']);

header('location: ./../../index.php?success=content_deleted');
