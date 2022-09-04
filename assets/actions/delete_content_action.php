<?php
session_start();
require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT contents.category, contents.title, contents.composer, users.name, users.lastname 
FROM contents
INNER JOIN users
ON users.id = contents.id_users 
WHERE contents.id = :id');
$req->execute(array(
    ':id' => $_GET['id']
));
$content_informations = $req->fetch();

$req = $bdd->prepare('SELECT purchased_contents.id_contents, purchased_contents.id_users, purchased_contents.original_price, purchased_contents.buyer_repayment ,users.credits, users.name, users.lastname
FROM purchased_contents 
INNER JOIN users 
ON purchased_contents.id_users = users.id 
WHERE purchased_contents.id_contents = :id_contents');
$req->execute(array(
    ':id_contents' => $_GET['id']
));
$repayment_informations = $req->fetchAll();

foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

    $new_sold_of_credits = $repayment_informations_foreach_buyer['credits'] += $repayment_informations_foreach_buyer['original_price'] - $repayment_informations_foreach_buyer['buyer_repayment'];

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
    $req->execute(array(
        ':credits' => $new_sold_of_credits,
        ':id' => $repayment_informations_foreach_buyer['id_users']
    ));

    $date = date('l jS \of F Y h:i:s A');

    $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
    $req->execute(array(
        ':notification' => 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! Your new sold of credits is ' . $new_sold_of_credits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' has been deleted. You have been reimbursed. ',
        ':date' => $date,
        ':id_users' => $repayment_informations_foreach_buyer['id_users']
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

if ($_GET['type'] == 'admin') {
    header('location: ../../admin/contents.php');
    die();
} else {
    header('location: ./../../index.php?success=content_deleted');
    die();
}
