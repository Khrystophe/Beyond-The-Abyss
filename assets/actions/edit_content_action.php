<?php
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

if ($_POST['category'] == 'Tutorial') {
    $price = 30;
} else if ($_POST['category'] == 'Performance') {
    $price = 10;
} else if ($_POST['category'] == 'Sheet Music') {
    $price = 20;
}

if (!isset($content) && empty($content)) {
    $req = $bdd->prepare('UPDATE contents SET title = :title ,composer= :composer, level = :level, category = :category, price= :price WHERE id = :id');
    $req->execute(array(
        ':title' => $_POST['title'],
        ':composer' => $_POST['composer'],
        ':level' => $_POST['level'],
        'category' => $_POST['category'],
        ':price' => $price,
        ':id' => $_POST['id']

    ));

    header('location: ../../single_player_content.php?id=' . $_POST['id']);
} else {
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

    header('location: ../../single_player_content.php?id=' . $_POST['id']);
}
