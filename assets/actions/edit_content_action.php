<?php
session_start();
require('../require/co_bdd.php');

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

$req = $bdd->prepare('SELECT credits FROM users WHERE users.id = :users_id');
$req->execute(array(
    ':users_id' => $_SESSION['users']['id']
));
$nbrOfCredits = $req->fetch();
$credits = implode($nbrOfCredits);

$req = $bdd->prepare('SELECT category FROM contents WHERE id = :id');
$req->execute(array(
    ':id' => $_POST['id']
));
$contentCategory = $req->fetch();
$category = implode($contentCategory);

if ($category == 'Tutorial') {
    $credits -= 30;
} else if ($category == 'Performance') {
    $credits -= 10;
} else if ($category == 'Sheet Music') {
    $credits -= 20;
}

$free_content = $_POST['free_content'];

if (!isset($free_content)) {
    if ($_POST['category'] == 'Tutorial') {
        $price = 15;
    } else if ($_POST['category'] == 'Performance') {
        $price = 5;
    } else if ($_POST['category'] == 'Sheet Music') {
        $price = 10;
    }
} else {
    $price = 0;
}


if (!isset($content) && empty($content)) {
    $req = $bdd->prepare('UPDATE contents SET title = :title ,composer= :composer, level = :level, category = :category, price= :price, description = :description  WHERE id = :id');
    $req->execute(array(
        ':title' => $_POST['title'],
        ':composer' => $_POST['composer'],
        ':level' => $_POST['level'],
        'category' => $_POST['category'],
        ':price' => $price,
        ':description' => $_POST['description'],
        ':id' => $_POST['id']
    ));

    if ($_POST['category'] == 'Tutorial') {
        $credits += 30;
    } else if ($_POST['category'] == 'Performance') {
        $credits += 10;
    } else if ($_POST['category'] == 'Sheet Music') {
        $credits += 20;
    }

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
    $req->execute(array(
        ':credits' => $credits,
        ':users_id' => $_SESSION['users']['id']
    ));

    header('location: ../../single_player_content.php?id=' . $_POST['id']);
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
        ':price' => $price,
        ':content' => $content,
        ':id' => $_POST['id']
    ));


    if ($_POST['category'] == 'Tutorial') {
        $credits += 30;
    } else if ($_POST['category'] == 'Performance') {
        $credits += 10;
    } else if ($_POST['category'] == 'Sheet Music') {
        $credits += 20;
    }

    $req = $bdd->prepare('UPDATE users SET credits = :credits WHERE users.id = :users_id');
    $req->execute(array(
        ':credits' => $credits,
        ':users_id' => $_SESSION['users']['id']
    ));

    header('location: ../../single_player_content.php?id=' . $_POST['id']);
}
