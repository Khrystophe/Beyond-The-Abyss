<?php
session_start();
require('../require/co_bdd.php');

$req = $bdd->prepare('SELECT credits FROM users WHERE id = :id');
$req->execute(array(
    ':id' => $_POST['id_users']
));
$nbrOfCredits = $req->fetch();
$author_credits = implode($nbrOfCredits);


$req = $bdd->prepare('SELECT contents.price, contents.title, contents.composer, users.name, users.lastname 
FROM contents
INNER JOIN users
ON users.id = contents.id_users 
WHERE contents.id = :id');
$req->execute(array(
    ':id' => $_POST['id']
));
$content_informations = $req->fetch();

$oldPrice = $content_informations['price'];
$author_credits -= $oldPrice * 2;


if (isset($_POST['free_content']) && !empty($_POST['free_content'])) {
    $free_content = $_POST['free_content'];
}

if (!isset($free_content)) {
    if ($_POST['category'] == 'Tutorial') {
        $newPrice = 15;
        $author_credits += 30;
    } else if ($_POST['category'] == 'Performance') {
        $newPrice = 5;
        $author_credits += 10;
    } else if ($_POST['category'] == 'Sheet Music') {
        $newPrice = 10;
        $author_credits += 20;
    }
} else {
    if ($_POST['category'] == 'Tutorial') {
        $newPrice = 0;
        $author_credits += 30;
    } else if ($_POST['category'] == 'Performance') {
        $newPrice = 0;
        $author_credits += 10;
    } else if ($_POST['category'] == 'Sheet Music') {
        $newPrice = 0;
        $author_credits += 20;
    }
}

$req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
$req->execute(array(
    ':credits' => $author_credits,
    ':users_id' => $_POST['id_users']
));

$req = $bdd->prepare('SELECT purchased_contents.id_contents, purchased_contents.id_users, purchased_contents.original_price, purchased_contents.buyer_repayment ,users.credits, users.name, users.lastname
FROM purchased_contents 
INNER JOIN users 
ON purchased_contents.id_users = users.id 
WHERE purchased_contents.id_contents = :id_contents');
$req->execute(array(
    ':id_contents' => $_POST['id']
));
$repayment_informations = $req->fetchAll();


foreach ($repayment_informations as $repayment_informations_foreach_buyer) {

    $original_price = $repayment_informations_foreach_buyer['original_price'];
    $buyer_repayment = $repayment_informations_foreach_buyer['buyer_repayment'];
    $old_buyer_repayment = $buyer_repayment;

    if ($original_price > $newPrice) {

        $buyer_repayment = 0;
        $buyer_repayment = $original_price - $newPrice;

        $newSoldOfCredits = $repayment_informations_foreach_buyer['credits'] += $buyer_repayment - $old_buyer_repayment;

        $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
        $req->execute(array(
            ':credits' => $newSoldOfCredits,
            ':id' => $repayment_informations_foreach_buyer['id_users']
        ));
    } else if ($original_price == $newPrice) {

        $newSoldOfCredits = $repayment_informations_foreach_buyer['credits'] -= $buyer_repayment;

        $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE id = :id');
        $req->execute(array(
            ':credits' => $newSoldOfCredits,
            ':id' => $repayment_informations_foreach_buyer['id_users']
        ));

        $buyer_repayment = 0;
    }

    $req = $bdd->prepare('UPDATE purchased_contents SET buyer_repayment = :buyer_repayment WHERE id_users = :id_users AND id_contents = :id_contents');
    $req->execute(array(
        ':buyer_repayment' => $buyer_repayment,
        ':id_users' => $repayment_informations_foreach_buyer['id_users'],
        ':id_contents' => $_POST['id']
    ));

    $date = date('l jS \of F Y h:i:s A');

    if ($newPrice == 0) {

        $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
        $req->execute(array(
            ':notification' => 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! Your new sold of credits is ' . $newSoldOfCredits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' is now Free. You have been reimbursed ',
            ':date' => $date,
            ':id_users' => $repayment_informations_foreach_buyer['id_users']
        ));
    } else {

        $req = $bdd->prepare('INSERT INTO notifications (notification, date, id_users) VALUES (:notification, :date, :id_users) ');
        $req->execute(array(
            ':notification' => 'Hello ' . $repayment_informations_foreach_buyer['name'] . ' ' . $repayment_informations_foreach_buyer['lastname'] . ' ! Your new sold of credits is ' . $newSoldOfCredits . ' because ' . $content_informations['title'] . " of " . $content_informations['composer'] . ' by ' . $content_informations['name'] . ' ' . $content_informations['lastname'] . ' is in a different category.',
            ':date' => $date,
            ':id_users' => $repayment_informations_foreach_buyer['id_users']
        ));
    }
}

if ($newPrice == 0) {

    $req = $bdd->prepare('DELETE FROM purchased_contents WHERE id_contents = :id_contents');
    $req->execute(array(
        ':id_contents' => $_POST['id']
    ));
}

if (isset($_FILES) && !empty($_FILES)) {
    if (array_key_exists('content', $_FILES)) {
        if ($_FILES['content']['error'] == 0) {
            if (in_array($_FILES['content']['type'], ['video/mp4', 'image/png', 'image/jpeg'])) {
                if ($_FILES['content']['size'] <= 128000000) {
                    $content = uniqid() . '.' . pathinfo($_FILES['content']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['content']['tmp_name'], '../contents_img/' . $content);
                } else {
                    var_dump('Le fichier est trop volumineux…');
                    exit;
                }
            } else {
                echo 'Le type mime du fichier est incorrect…';
            }
        } else {
            echo 'Le fichier n\'a pas pu être récupéré…';
        }
    }
}

if (!isset($content) && empty($content)) {

    $req = $bdd->prepare('UPDATE contents SET title = :title ,composer= :composer, level = :level, category = :category, price= :price, description = :description  WHERE id = :id');
    $req->execute(array(
        ':title' => $_POST['title'],
        ':composer' => $_POST['composer'],
        ':level' => $_POST['level'],
        'category' => $_POST['category'],
        ':price' => $newPrice,
        ':description' => $_POST['description'],
        ':id' => $_POST['id']
    ));
} else {

    $requete = $bdd->prepare('SELECT * FROM contents WHERE id = :id');
    $requete->execute(array(
        ':id' => $_POST['id'],
    ));
    $oldContent = $requete->fetch();
    unlink('../contents_img/' . $oldContent['content']);

    $req = $bdd->prepare('UPDATE contents SET title = :title ,composer= :composer, level = :level, category = :category, price= :price, content= :content WHERE id = :id');
    $req->execute(array(
        ':title' => $_POST['title'],
        ':composer' => $_POST['composer'],
        ':level' => $_POST['level'],
        'category' => $_POST['category'],
        ':price' => $newPrice,
        ':content' => $content,
        ':id' => $_POST['id']
    ));
}

if ($_GET['type'] == 'admin') {
    header('location: ../../admin/contents.php');
} else {
    header('location: ../../single_player_content.php?id=' . $_POST['id']);
}
