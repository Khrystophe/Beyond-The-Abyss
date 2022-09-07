<?php

function getAllContents()
{
    global $bdd;
    $req = $bdd->query("SELECT * FROM contents ORDER BY category");
    $getAllContents = $req->fetchAll();
    return $getAllContents;
}

function getUsers()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM users ORDER BY name');
    $users = $req->fetchAll();
    return $users;
}

function getPurchased_contents()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM purchased_contents ORDER BY id_users');
    $purchased_contents = $req->fetchAll();
    return $purchased_contents;
}

function getComments()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM comments ORDER BY id_contents');
    $comments =  $req->fetchAll();
    return $comments;
}

function getLikes()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM likes ORDER BY id_contents');
    $likes =  $req->fetchAll();
    return $likes;
}

function getNotifications()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM notifications ORDER BY date');
    $notifications =  $req->fetchAll();
    return $notifications;
}


function getContact()
{
    global $bdd;
    $req = $bdd->query('SELECT * FROM contact ORDER BY date');
    $contact =  $req->fetchAll();
    return $contact;
}
