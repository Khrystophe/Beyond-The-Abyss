<?php
require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT purchased_contents.id_users, purchased_contents.original_price,users.credits FROM purchased_contents INNER JOIN users ON purchased_contents.id_users = users.id WHERE purchased_contents.id_contents = :id_contents');
$req->execute(array(
    ':id_contents' => $_GET['id']
));
$repayment_informations = $req->fetchAll();

foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
    $req->execute(array(
        ':credits' => $repayment_informations_foreach_buyer['credits'] += $repayment_informations_foreach_buyer['original_price'],
        ':id' => $repayment_informations_foreach_buyer['id_users']
    ));
}

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
