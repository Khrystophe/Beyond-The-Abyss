<?php
require('../php/co_bdd.php');

var_dump($_FILES);
var_dump($_FILES['image']['error']);


if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['contenu']) && !empty($_POST['contenu']) && isset($_POST['prix']) && !empty($_POST['prix']) && isset($_FILES['image']) && !empty($_FILES['image']) && isset($_POST['id_categorie']) && !empty($_POST['id_categorie'])) {

    if (array_key_exists('image', $_FILES)) {

        if ($_FILES['image']['error'] == 0) {
            if ($_FILES['image']['size'] <= 3000000000000) {
                $imageFileName = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $taille = getimagesize($_FILES['image']['tmp_name']);

                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $imageFileName);

                $req = $bdd->prepare('INSERT INTO produits(nom, contenu, image, prix, id_categorie) VALUES (?,?,?,?,?)');
                $req->execute(array(
                    $_POST['nom'],
                    $_POST['contenu'],
                    $imageFileName,
                    $_POST['prix'],
                    $_POST['id_categorie']
                ));
                header('location: ../../products.php');
            } else {
                header('location: ../products.php?error=fichierVolumineux');
            }
        } else {
            echo 'Le fichier n\'a pas pu être récupéré…';
        }
    }
}
