<?php

function getAllContents(PDO $bdd)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM contents ORDER BY category");
    $req->execute();
    $getAllContents = $req->fetchAll();
    return $getAllContents;
}

function getUsers(PDO $bdd)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM users ORDER BY name');
    $req->execute();
    $users = $req->fetchAll();
    return $users;
}

function getPurchased_contents(PDO $bdd)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM purchased_contents ORDER BY id_users');
    $req->execute();
    $purchased_contents = $req->fetchAll();
    return $purchased_contents;
}

function getComments(PDO $bdd)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM comments ORDER BY id_contents');
    $req->execute();
    $comments =  $req->fetchAll();
    return $comments;
}


function getNotifications(PDO $bdd)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM notifications ORDER BY date');
    $req->execute();
    $notifications =  $req->fetchAll();
    return $notifications;
}


function getContact(PDO $bdd)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM contact ORDER BY date');
    $req->execute();
    $contact =  $req->fetchAll();
    return $contact;
}
