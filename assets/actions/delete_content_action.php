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


    $req = $bdd->prepare('SELECT contents.category, contents.title, contents.composer,contents.id_users, contents.reporting, users.name, users.lastname 
    FROM contents
    INNER JOIN users
    ON users.id = contents.id_users 
    WHERE contents.id = :id');
    $req->bindParam(':id', $get_id, PDO::PARAM_INT);
    $req->execute();
    $content_informations = $req->fetch();

    if (($content_informations['reporting'] != 0 && $get_type != 'admin') ||
        ($content_informations['reporting'] != 0 && $get_type == 'admin' && $content_informations['id_users'] == $session_users_id)
    ) {

        if ($get_type == 'admin') {

            $bdd = null;
            header('location: ../../admin/contents.php?id=error=content_reported');
            die();
        } else {

            $bdd = null;
            header('location: ../../single_player_content.php?id=' . $get_id . '&error=content_reported');
            die();
        }
    }

    $req = $bdd->prepare('SELECT credits FROM users WHERE id = :id_users');
    $req->bindParam(':id_users', $content_informations['id_users'], PDO::PARAM_INT);
    $req->execute();
    $author_credits = $req->fetch();
    $author_credits = implode($author_credits);

    if ($content_informations['category'] == 'tutorial') {
        $author_credits -= 30;
    } else if ($content_informations['category'] == 'performance') {
        $author_credits -= 10;
    } else if ($content_informations['category'] == 'sheet_music') {
        $author_credits -= 20;
    }

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
    $req->bindParam(':credits', $author_credits, PDO::PARAM_INT);
    $req->bindParam(':users_id', $content_informations['id_users'], PDO::PARAM_INT);
    $req->execute();

    $date = date('l jS \of F Y h:i:s A');

    $notification = 'Hello ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' ! 
    
    Your new sold of credits is ' . $author_credits . ' because you have deleted ' . $content_informations['title'] . " of " . $content_informations['composer'] . '.   ';

    $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
    $req->bindParam(':notification', $notification, PDO::PARAM_STR);
    $req->bindParam(':date', $date, PDO::PARAM_STR);
    $req->bindParam(':id_users', $content_informations['id_users'], PDO::PARAM_INT);
    $req->execute();

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

        $notification = 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! 
        
        Your new sold of credits is ' . $new_sold_of_credits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' has been deleted. 
        
        You have been reimbursed. ';

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

    unlink('../videos/' . $content['content']);

    if ($get_type == 'admin') {

        $bdd = null;
        header('location: ../../admin/contents.php');
        die();
    } else {

        $bdd = null;
        header('location: ./../../my_account.php?success=content_deleted');
        die();
    }
} else {

    if ($get_type == 'admin') {

        $bdd = null;
        http_response_code(400);
        header('location: ../../admin/contents.php?error=processing_bad_or_malformed_request');
        die();
    } else {

        $bdd = null;
        http_response_code(400);
        header('location: ../../single_player_content.php?error=processing_bad_or_malformed_request');
        die();
    }
}
