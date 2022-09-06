<?php
session_start();
require('../require/check_data.php');


if (
    isset($get_id)
    && isset($session_users_id)
    && isset($get_type)
) {

    require('../require/co_bdd.php');
    require('../require/action_deco_auto.php');

    $req = $bdd->prepare('SELECT contents.category, contents.title, contents.composer, users.name, users.lastname 
    FROM contents
    INNER JOIN users
    ON users.id = contents.id_users 
    WHERE contents.id = :id');
    $req->bindParam(':id', $get_id, PDO::PARAM_INT);
    $req->execute();
    $content_informations = $req->fetch();

    $req = $bdd->prepare('SELECT purchased_contents.id_contents, purchased_contents.id_users, purchased_contents.original_price, purchased_contents.buyer_repayment ,users.credits, users.name, users.lastname
    FROM purchased_contents 
    INNER JOIN users 
    ON purchased_contents.id_users = users.id 
    WHERE purchased_contents.id_contents = :id_contents');
    $req->bindParam(':id_contents', $get_id, PDO::PARAM_INT);
    $req->execute();
    $repayment_informations = $req->fetchAll();

    foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

        $new_sold_of_credits = $repayment_informations_foreach_buyer['credits'] += $repayment_informations_foreach_buyer['original_price'] - $repayment_informations_foreach_buyer['buyer_repayment'];

        $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
        $req->bindParam(':credits', $new_sold_of_credits, PDO::PARAM_INT);
        $req->bindParam(':id', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
        $req->execute();

        $date = date('l jS \of F Y h:i:s A');

        $notification = 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! Your new sold of credits is ' . $new_sold_of_credits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' has been deleted. You have been reimbursed. ';

        $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
        $req->bindParam(':notification', $notification, PDO::PARAM_STR);
        $req->bindParam(':date', $date, PDO::PARAM_STR);
        $req->bindParam(':id_users', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
        $req->execute();
    }


    $req = $bdd->prepare('SELECT * FROM contents WHERE id = :id');
    $req->bindParam(':id', $get_id, PDO::PARAM_INT);
    $req->execute();
    $content = $req->fetch();

    $req = $bdd->prepare('DELETE FROM contents WHERE id = :id');
    $req->bindParam(':id', $get_id, PDO::PARAM_INT);
    $req->execute();

    unlink('../contents_img/' . $content['content']);

    if ($get_type == 'admin') {

        $bdd = null;
        header('location: ../../admin/contents.php');
        die();
    } else {

        $bdd = null;
        header('location: ./../../index.php?success=content_deleted');
        die();
    }
} else {

    $bdd = null;
    http_response_code(400);
    header('location: ../../my_account.php?error=processing_bad_or_malformed_request');
    die();
}
