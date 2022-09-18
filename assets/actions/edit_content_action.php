<?php
session_start();
require('../require/check_data.php');

if (
    (isset($files_content_name) xor !isset($check_files_name))
    && isset($post_id)
    && isset($post_id_users)
    && isset($post_title)
    && isset($post_composer)
    && isset($post_category)
    && isset($post_level)
    && isset($post_price)
    && isset($post_description)
    && isset($session_users_id)
    && isset($get_type)
    && ($check_post_reporting === true xor $check_post_reporting === null)
) {

    require('../require/co_bdd.php');
    require('../require/action_deco_auto.php');

    $req = $bdd->prepare('SELECT credits FROM users WHERE id = :id_users');
    $req->bindParam(':id_users', $post_id_users, PDO::PARAM_INT);
    $req->execute();
    $author_credits = $req->fetch();
    $author_credits = implode($author_credits);

    $req = $bdd->prepare('SELECT contents.category, contents.title, contents.composer,contents.id_users, contents.reporting, users.name, users.lastname 
    FROM contents
    INNER JOIN users
    ON users.id = contents.id_users 
    WHERE contents.id = :id');
    $req->bindParam(':id', $post_id, PDO::PARAM_INT);
    $req->execute();
    $content_informations = $req->fetch();


    if (($content_informations['reporting'] != 0 && $get_type != 'admin') ||
        ($content_informations['reporting'] != 0 && $get_type == 'admin' && $content_informations['id_users'] == $session_users_id)
    ) {

        if ($get_type == 'admin') {

            $bdd = null;
            header('location: ../../admin/contents.php?error=017128');
            die();
        } else {

            $bdd = null;
            header('location: ../../single_player_content.php?id=' . $post_id . '&error=017151');
            die();
        }
    }


    if ($content_informations['category'] == 'tutorial') {
        $author_credits -= 300;
    } else if ($content_informations['category'] == 'performance') {
        $author_credits -= 100;
    } else if ($content_informations['category'] == 'sheet_music') {
        $author_credits -= 200;
    }

    if ($post_category == 'tutorial') {
        $author_credits += 300;
    } else if ($post_category == 'performance') {
        $author_credits += 100;
    } else if ($post_category == 'sheet_music') {
        $author_credits += 200;
    }

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
    $req->bindParam(':credits', $author_credits, PDO::PARAM_INT);
    $req->bindParam(':users_id', $post_id_users, PDO::PARAM_INT);
    $req->execute();


    $req = $bdd->prepare('SELECT purchased_contents.id_contents, purchased_contents.id_users, purchased_contents.original_price, purchased_contents.buyer_repayment ,users.credits, users.name, users.lastname
    FROM purchased_contents 
    INNER JOIN users 
    ON purchased_contents.id_users = users.id 
    WHERE purchased_contents.id_contents = :id_contents');
    $req->bindParam(':id_contents', $post_id, PDO::PARAM_INT);
    $req->execute();
    $repayment_informations = $req->fetchAll();


    $new_price = $post_price;

    if ($post_price == 'Free') {
        $new_price = 0;
    }


    foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

        $original_price = $repayment_informations_foreach_buyer['original_price'];
        $buyer_repayment = $repayment_informations_foreach_buyer['buyer_repayment'];
        $old_buyer_repayment = $buyer_repayment;


        if ($original_price > $new_price) {

            $buyer_repayment = 0;
            $buyer_repayment = $original_price - $new_price;

            $new_sold_of_credits = $repayment_informations_foreach_buyer['credits'] += $buyer_repayment - $old_buyer_repayment;

            $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
            $req->bindParam(':credits', $new_sold_of_credits, PDO::PARAM_INT);
            $req->bindParam(':id', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
            $req->execute();
        } else if ($original_price == $new_price) {

            $new_sold_of_credits = $repayment_informations_foreach_buyer['credits'] -= $buyer_repayment;

            $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
            $req->bindParam(':credits', $new_sold_of_credits, PDO::PARAM_INT);
            $req->bindParam(':id', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
            $req->execute();

            $buyer_repayment = 0;
        }


        $req = $bdd->prepare('UPDATE purchased_contents SET buyer_repayment = :buyer_repayment WHERE id_users = :id_users AND id_contents = :id_contents');
        $req->bindParam(':buyer_repayment', $buyer_repayment, PDO::PARAM_INT);
        $req->bindParam(':id_users', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
        $req->bindParam(':id_contents', $post_id, PDO::PARAM_INT);
        $req->execute();


        $date = date('l jS \of F Y h:i:s A');

        if ($new_price == 0) {

            $notification = 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! 
            
            Your new sold of credits is ' . $new_sold_of_credits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' is now Free. 
            
            You have been reimbursed ';

            $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
            $req->bindParam(':notification', $notification, PDO::PARAM_STR);
            $req->bindParam(':date', $date, PDO::PARAM_STR);
            $req->bindParam(':id_users', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
            $req->execute();
        } else {

            $notification = 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! 
            
            Your new sold of credits is ' . $new_sold_of_credits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' is in a different category.';

            $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
            $req->bindParam(':notification', $notification, PDO::PARAM_STR);
            $req->bindParam(':date', $date, PDO::PARAM_STR);
            $req->bindParam(':id_users', $repayment_informations_foreach_buyer['id_users'], PDO::PARAM_INT);
            $req->execute();
        }
    }

    if (isset($files_content_name)) {

        if ($files_content_error == 0) {

            if ($files_content_size <= 128000000) {

                $content = uniqid() . '.' . pathinfo($files_content_name, PATHINFO_EXTENSION);
                move_uploaded_file($files_content_tmp_name, '../videos/' . $content);
            } else {

                if ($get_type == 'admin') {

                    $bdd = null;
                    header('location: ../../admin/contents.php?error=017129');
                    die();
                } else {

                    $bdd = null;
                    header('location: ../../single_player_content.php?id=' . $post_id . '&error=017154');
                    die();
                }
            }
        } else {

            if ($get_type == 'admin') {

                $bdd = null;
                header('location: ../../admin/contents.php?error=017130');
                die();
            } else {

                $bdd = null;
                header('location: ../../single_player_content.php?id=' . $post_id . '&error=017155');
                die();
            }
        }
    }


    if (!isset($content) && empty($content)) {

        $req = $bdd->prepare('UPDATE contents SET title = :title ,composer = :composer, level = :level, category = :category, price = :price, description = :description, reporting = :reporting  WHERE id = :id');
        $req->bindParam(':title', $post_title, PDO::PARAM_STR);
        $req->bindParam(':composer', $post_composer, PDO::PARAM_STR);
        $req->bindParam(':level', $post_level, PDO::PARAM_STR);
        $req->bindParam(':category', $post_category, PDO::PARAM_STR);
        $req->bindParam(':price', $new_price, PDO::PARAM_INT);
        $req->bindParam(':description', $post_description, PDO::PARAM_STR);
        $req->bindParam(':reporting', $_POST['reporting'], PDO::PARAM_INT);
        $req->bindParam(':id', $post_id, PDO::PARAM_INT);
        $req->execute();
    } else {

        $req = $bdd->prepare('SELECT * FROM contents WHERE id = :id');
        $req->bindParam(':id', $post_id, PDO::PARAM_INT);
        var_dump($req);
        $req->execute();
        $old_content = $req->fetch();

        unlink('../videos/' . $old_content['content']);

        $req = $bdd->prepare('UPDATE contents SET title = :title ,composer = :composer, level = :level, category = :category, price = :price, description = :description, reporting = :reporting, content = :content WHERE id = :id');
        $req->bindParam(':title', $post_title, PDO::PARAM_STR);
        $req->bindParam(':composer', $post_composer, PDO::PARAM_STR);
        $req->bindParam(':level', $post_level, PDO::PARAM_STR);
        $req->bindParam(':category', $post_category, PDO::PARAM_STR);
        $req->bindParam(':price', $new_price, PDO::PARAM_INT);
        $req->bindParam(':description', $post_description, PDO::PARAM_STR);
        $req->bindParam(':reporting', $_POST['reporting'], PDO::PARAM_INT);
        $req->bindParam(':content', $content);
        $req->bindParam(':id', $post_id, PDO::PARAM_INT);
        $req->execute();
    }


    if ($get_type == 'admin') {

        $bdd = null;
        header('location: ../../admin/contents.php?success=017231');
        die();
    } else {

        $bdd = null;
        header('location: ../../single_player_content.php?id=' . $post_id . '&success=017252');
        die();
    }
} else {

    if ($get_type == 'admin') {

        $bdd = null;
        http_response_code(400);
        header('location: ../../admin/contents.php?error=01715');
        die();
    } else {

        $bdd = null;
        http_response_code(400);
        header('location: ../../single_player_content.php?id=' . $post_id . '&error=017153');
        die();
    }
}
