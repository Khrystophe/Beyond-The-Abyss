<?php
session_start();
require('../require/check_data.php');

if (
    isset($get_id)
    && isset($get_type)
    && isset($session_users_id)
    && isset($session_users_type)
) {


    if (($session_users_id == $get_id && $session_users_type == 'user') xor ($session_users_id != $get_id && $session_users_type == 'admin')) {

        require('../require/co_bdd.php');
        require('../require/action_deco_auto.php');

        $req = $bdd->prepare('SELECT name, lastname FROM users WHERE id= :id');
        $req->bindParam(':id', $get_id, PDO::PARAM_INT);
        $req->execute();
        $user = $req->fetch();

        $req = $bdd->prepare('SELECT purchased_contents.id_users as purchased_contents_id_users, purchased_contents.original_price, users.credits, users.name, users.lastname, purchased_contents.buyer_repayment 
        FROM contents 
        INNER JOIN purchased_contents
        ON purchased_contents.id_contents = contents.id 
        INNER JOIN users 
        ON purchased_contents.id_users = users.id 
        WHERE contents.id_users = :id');
        $req->bindParam(':id', $get_id, PDO::PARAM_INT);
        $req->execute();
        $repayment_informations = $req->fetchAll();


        foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

            $req = $bdd->prepare('SELECT SUM(original_price) FROM purchased_contents WHERE id_users = :id_users');
            $req->bindParam(':id_users', $repayment_informations_foreach_buyer['purchased_contents_id_users'], PDO::PARAM_INT);
            $req->execute();
            $total_price = $req->fetchAll();
            $total_price = implode($total_price[0]);

            $req = $bdd->prepare('SELECT SUM(buyer_repayment) FROM purchased_contents WHERE id_users = :id_users');
            $req->bindParam(':id_users', $repayment_informations_foreach_buyer['purchased_contents_id_users'], PDO::PARAM_INT);
            $req->execute();
            $total_repayment = $req->fetchAll();
            $total_repayment = implode($total_repayment[0]);

            $new_sold_of_credits = $repayment_informations_foreach_buyer['credits'] += $total_price - $total_repayment;

            $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
            $req->bindParam(':credits', $new_sold_of_credits, PDO::PARAM_INT);
            $req->bindParam(':id', $repayment_informations_foreach_buyer['purchased_contents_id_users'], PDO::PARAM_INT);
            $req->execute();


            $date = date('Y-m-d H:i:s');

            $notification = 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! 
            
            Your new sold of credits is ' . $new_sold_of_credits . ' because ' .  $user['name'] . ' ' . $user['lastname'] . ' have deleted his account. 
            
            You have been reimbursed of all your purchased content.';


            $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
            $req->bindParam(':notification', $notification, PDO::PARAM_STR);
            $req->bindParam(':date', $date, PDO::PARAM_STR);
            $req->bindParam(':id_users', $repayment_informations_foreach_buyer['purchased_contents_id_users'], PDO::PARAM_INT);
            $req->execute();
        }


        $req = $bdd->prepare('SELECT * FROM contents WHERE id_users = :id');
        $req->bindParam(':id', $get_id, PDO::PARAM_INT);
        $req->execute();
        $contents = $req->fetchAll();


        foreach ($contents as $content) {

            unlink('../videos/' . $content['content']);

            $image = explode('.', $content['content']);

            unlink('../images/' . $image[0] . '.jpg');
        }


        $req = $bdd->prepare('DELETE FROM users WHERE id= :id');
        $req->bindParam(':id', $get_id, PDO::PARAM_INT);
        $req->execute();

        if ($get_type == 'admin') {

            $bdd = null;
            header('location: ../../admin/users.php?success=019233');
            die();
        } else {

            $bdd = null;
            unset($_SESSION['users']);
            session_destroy();
            header('location: ./../../index.php?success=019248');
            die();
        }
    } else {

        $bdd = null;
        header('location: ../../admin/users.php?error=019134');
        die();
    }
} else {

    if ($get_type == 'admin') {

        $bdd = null;
        http_response_code(400);
        header('location: ../../admin/users.php?error=01915');
        die();
    } else {

        $bdd = null;
        http_response_code(400);
        header('location: ../../my_account.php?error=019153');
        die();
    }
}
