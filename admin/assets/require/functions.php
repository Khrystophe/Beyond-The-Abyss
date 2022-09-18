<?php

function getAllContents(PDO $bdd)
{
    $req = $bdd->prepare("SELECT * FROM contents ORDER BY category");
    $req->execute();
    $getAllContents = $req->fetchAll();
    return $getAllContents;
}

function getContentInformations(PDO $bdd, $id_contents)
{
    $req = $bdd->prepare('SELECT title, composer FROM contents WHERE id = :id_contents');
    $req->bindParam(':id_contents', $id_contents, PDO::PARAM_INT);
    $req->execute();
    $user = $req->fetch();
    return $user;
}

function getUsers(PDO $bdd)
{
    $req = $bdd->prepare('SELECT * FROM users ORDER BY name');
    $req->execute();
    $users = $req->fetchAll();
    return $users;
}

function getUserInformations(PDO $bdd, $id_users)
{
    $req = $bdd->prepare('SELECT name, lastname, email FROM users WHERE id = :id_users');
    $req->bindParam(':id_users', $id_users, PDO::PARAM_INT);
    $req->execute();
    $user = $req->fetch();
    return $user;
}

function getPurchased_contents(PDO $bdd)
{
    $req = $bdd->prepare('SELECT * FROM purchased_contents ORDER BY id_users');
    $req->execute();
    $purchased_contents = $req->fetchAll();
    return $purchased_contents;
}

function getComments(PDO $bdd)
{
    $req = $bdd->prepare('SELECT * FROM comments ORDER BY id_contents');
    $req->execute();
    $comments =  $req->fetchAll();
    return $comments;
}


function getNotifications(PDO $bdd)
{
    $req = $bdd->prepare('SELECT * FROM notifications ORDER BY date');
    $req->execute();
    $notifications =  $req->fetchAll();
    return $notifications;
}


function getContact(PDO $bdd)
{
    $req = $bdd->prepare('SELECT * FROM contact ORDER BY date');
    $req->execute();
    $contact =  $req->fetchAll();
    return $contact;
}


function getReporting(PDO $bdd)
{
    $req = $bdd->prepare('SELECT * FROM reporting ORDER BY date');
    $req->execute();
    $reporting =  $req->fetchAll();
    return $reporting;
}
