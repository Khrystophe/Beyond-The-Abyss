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

if ($media == null) {
    $req = $bdd->prepare('UPDATE contents SET title = :title ,composer= :comoser, level = :level, category = :category WHERE id = :id');
    $req->execute(array(
        ':title' => $_POST['title'],
        ':composer' => $_POST['composer'],
        ':level' => $_POST['level'],
        'category' => $_POST['category'],
        ':content' => $content,
        ':price' => $price,
        ':id' => $_POST['id']

    ));
    if ($_POST['categorie'] == "tuto") {
        header('location: ../contenu.php?categorie=tuto&success=modification');
    } else if ($_POST['categorie'] == "interpretation") {
        header('location: ../contenu.php?categorie=interpretation&success=modification');
    } else if ($_POST['categorie'] == "partition") {
        header('location: ../contenu.php?categorie=partition&success=modification');
    }
} else {
    $req = $bdd->prepare('UPDATE tutos SET titre = ?,compositeur= ?, niveau = ?, media = ?, categorie =?  WHERE id = ?');
    $req->execute(array(
        $_POST['titre'],
        $_POST['compositeur'],
        $_POST['niveau'],
        $media,
        $_POST['categorie'],
        $_POST['id']
    ));
    if ($_POST['categorie'] == "tuto") {
        header('location: ../contenu.php?categorie=tuto&success=modification');
    } else if ($_POST['categorie'] == "interpretation") {
        header('location: ../contenu.php?categorie=interpretation&success=modification');
    } else if ($_POST['categorie'] == "partition") {
        header('location: ../contenu.php?categorie=partition&success=modification');
    }
}
