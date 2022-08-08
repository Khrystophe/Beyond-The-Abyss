<?php
require('../require/co_bdd.php');

if (isset($_FILES) && !empty($_FILES)) {
    if (array_key_exists('media', $_FILES)) {
        if ($_FILES['media']['error'] == 0) {
            if (in_array($_FILES['media']['type'], ['image/png', 'image/jpeg'])) {
                if ($_FILES['media']['size'] <= 3000000) {
                    $media = uniqid() . '.' . pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['media']['tmp_name'], '../media/' . $media);
                } else {
                    echo 'Le fichier est trop volumineux…';
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
    $req = $bdd->prepare('UPDATE tutos SET titre = ?,compositeur= ?, niveau = ?, categorie = ? WHERE id = ?');
    $req->execute(array(
        $_POST['titre'],
        $_POST['compositeur'],
        $_POST['niveau'],
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
