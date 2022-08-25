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
