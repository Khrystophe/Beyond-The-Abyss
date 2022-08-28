<?php
require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT * FROM contents WHERE id = :id');
$req->execute(array(
    ':id' => $_GET['id'],
));
$content = $req->fetch();

$req = $bdd->prepare('DELETE FROM contents WHERE id = :id');
$req->execute(array(
    ':id' => $_GET['id'],
));
unlink('../contents_img/' . $content['content']);

$req = $bdd->prepare('DELETE FROM purchased_contents WHERE id_contents = :id_contents');
$req->execute(array(
    ':id_contents' => $_GET['id'],
));

if ($_GET['type'] == 'admin') {
    header('location: ../../admin/contents.php');
} else {
    header('location: ./../../index.php?success=content_deleted');
}
