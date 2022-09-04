<?php
session_start();
require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT name, lastname FROM users WHERE id= :id');
$req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$req->execute();
$user = $req->fetch();

$req = $bdd->prepare('SELECT purchased_contents.id_users as purchased_contents_id_users, purchased_contents.original_price, users.credits, users.name, users.lastname, purchased_contents.buyer_repayment 
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

    $req = $bdd->prepare('SELECT SUM(original_price), SUM(buyer_repayment) FROM purchased_contents WHERE id_users = :id_users');
    $req->bindParam(':id_users', $repayment_informations_foreach_buyer['purchased_contents_id_users']);
    $req->execute();
    $total_of_original_price = $req->fetchAll();
    $total_price = implode($total_of_original_price[0][0]);
    $total_repayment = implode($total_of_original_price[0][1]);
    var_dump($total_price);
    var_dump($total_repayment);
    exit;
    $req = $bdd->prepare('SELECT SUM(buyer_repayment) FROM purchased_contents WHERE id_users = :id_users');
    $req->bindParam(':id_users', $repayment_informations_foreach_buyer['purchased_contents_id_users']);
    $req->execute();
    $total_of_buyer_repayment = $req->fetchAll();
    $total_repayment = implode($total_of_buyer_repayment[0]);

    $new_sold_of_credits = $repayment_informations_foreach_buyer['credits'] += $total_price - $total_repayment;

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
    $req->execute(array(
        ':credits' => $new_sold_of_credits,
        ':id' => $repayment_informations_foreach_buyer['purchased_contents_id_users']
    ));

    $date = date('l jS \of F Y h:i:s A');

    $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
    $req->execute(array(
        ':notification' => 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! Your new sold of credits is ' . $new_sold_of_credits . ' because ' .  $user['name'] . ' ' . $user['lastname'] . ' have deleted his account. You have been reimbursed of all your purchased content.',
        ':date' => $date,
        ':id_users' => $repayment_informations_foreach_buyer['purchased_contents_id_users']
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
