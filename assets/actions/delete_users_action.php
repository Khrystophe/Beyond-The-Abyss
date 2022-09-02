<?php
session_start();
require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT purchased_contents.id_users as purchased_contents_id_users, purchased_contents.original_price, users.credits, purchased_contents.buyer_repayment 
FROM contents 
INNER JOIN purchased_contents
ON purchased_contents.id_contents = contents.id 
INNER JOIN users 
ON purchased_contents.id_users = users.id 
WHERE contents.id_users = :id');
$req->execute(array(
    ':id' => $_GET['id']
));
$repayment_informations = $req->fetchAll();


foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
    $req->execute(array(
        ':credits' => $repayment_informations_foreach_buyer['credits'] += $repayment_informations_foreach_buyer['original_price'] - $repayment_informations_foreach_buyer['buyer_repayment'],
        ':id' => $repayment_informations_foreach_buyer['purchased_contents_id_users']
    ));
}

$req = $bdd->prepare('SELECT * FROM contents WHERE id_users = :id');
$req->execute(array(
    ':id' => $_GET['id'],
));
$contents = $req->fetchAll();

foreach ($contents as $content) {

    unlink('../contents_img/' . $content['content']);
}

$req = $bdd->prepare('DELETE FROM users WHERE id= :id');
$req->execute(array(
    ':id' => $_GET['id'],
));

if ($_GET['type'] == 'admin') {
    header('location: ../../admin/users.php');
} else {

    unset($_SESSION['users']);
    session_destroy();
    header('location: ./../../index.php?success=user_deleted');
}
