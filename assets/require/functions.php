<?php

function getUserSessionInformations(PDO $bdd, $session_users_id)
{
  $req = $bdd->prepare('SELECT  name, lastname, credits FROM users WHERE id= :id');
  $req->bindParam(':id', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $user = $req->fetch();
  return $user;
}

function getRandomTuto(PDO $bdd)
{
  $tutorial = 'tutorial';
  $req = $bdd->prepare("SELECT * FROM contents WHERE category = :category ORDER BY RAND() LIMIT 1 ");
  $req->bindParam(':category', $tutorial, PDO::PARAM_STR);
  $req->execute();
  $content = $req->fetch();
  return $content;
}

function getRandomPerf(PDO $bdd)
{
  $performance = 'performance';
  $req = $bdd->prepare("SELECT * FROM contents WHERE category = :category ORDER BY RAND() LIMIT 1 ");
  $req->bindParam(':category', $performance, PDO::PARAM_STR);
  $req->execute();
  $content = $req->fetch();
  return $content;
}

function getRandomSheet(PDO $bdd)
{
  $sheet_music = 'sheet_music';
  $req = $bdd->prepare("SELECT * FROM contents WHERE category = :category ORDER BY RAND() LIMIT 1 ");
  $req->bindParam(':category', $sheet_music, PDO::PARAM_STR);
  $req->execute();
  $content = $req->fetch();
  return $content;
}

function getContents(PDO $bdd, $get_category)
{
  $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
  $req->bindParam(':category', $get_category, PDO::PARAM_STR);
  $req->execute();
  $contents = $req->fetchAll();
  return $contents;
}

function getUserContentInformations(PDO $bdd, $content_id_user)
{
  $req = $bdd->prepare('SELECT users.id, users.name, users.lastname
  FROM users
  INNER JOIN contents
  ON users.id = contents.id_users
  WHERE contents.id_users = :id_users');
  $req->bindParam(':id_users', $content_id_user, PDO::PARAM_INT);
  $req->execute();
  $user = $req->fetch();
  return $user;
}

function getUserContent(PDO $bdd, $session_users_id)
{
  $req = $bdd->prepare('SELECT * FROM contents WHERE id_users = :id_users ');
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $contents = $req->fetchAll();
  return $contents;
}

function getUserPurchasedContent(PDO $bdd, $session_users_id)
{
  $req = $bdd->prepare('SELECT purchased_contents.id_contents, contents.title , contents.composer, contents.category, contents.content, contents.price, contents.id, contents.description, contents.id_users, contents.likes, contents.level
  FROM purchased_contents 
  INNER JOIN contents
  ON purchased_contents.id_contents = contents.id
  WHERE purchased_contents.id_users = :id_users ');
  $req->bindParam(':id_users', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $contents = $req->fetchAll();
  return $contents;
}

function getIdUserFromPurchasedContent(PDO $bdd, $content_id)
{
  $req = $bdd->prepare('SELECT id_users FROM purchased_contents WHERE id_contents = :contents_id');
  $req->bindParam(':contents_id', $content_id, PDO::PARAM_INT);
  $req->execute();
  $users = $req->fetchAll();
  return $users;
}

function getSearchResults(PDO $bdd, $post_title, $post_composer, $post_category, $post_level)
{
  $title =  $post_title . '%';
  $composer = $post_composer . '%';
  $category = '%' . $post_category . '%';
  $level = '%' . $post_level . '%';

  $req = $bdd->prepare("SELECT * FROM contents WHERE level LIKE :level AND category LIKE :category AND composer LIKE :composer AND title LIKE :title");
  $req->bindParam(':level', $level, PDO::PARAM_STR);
  $req->bindParam(':category', $category, PDO::PARAM_STR);
  $req->bindParam(':composer',  $composer, PDO::PARAM_STR);
  $req->bindParam(':title', $title, PDO::PARAM_STR);
  $req->execute();
  $contents = $req->fetchAll();
  return $contents;
}

function getUserInformations(PDO $bdd, $session_users_id)
{
  $req = $bdd->prepare('SELECT id, name, lastname, email, type, credits FROM users WHERE id= :id');
  $req->bindParam(':id', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $user = $req->fetch();
  return $user;
}

function getContentAndUserInformations(PDO $bdd, $get_id)
{
  $req = $bdd->prepare('SELECT users.name, users.lastname, contents.id, contents.title, contents.composer, contents.category, contents.level, contents.content, contents.price, contents.description, contents.likes, contents.id_users
  FROM users
  INNER JOIN contents
  ON users.id = contents.id_users WHERE contents.id = :contents_id ');
  $req->bindParam(':contents_id', $get_id, PDO::PARAM_INT);
  $req->execute();
  $content = $req->fetch();
  return $content;
}

function getComments(PDO $bdd, $get_id)
{
  $req = $bdd->prepare('SELECT  users.name, users.lastname, comments.comment, comments.id,comments.id_users, comments.date, comments.likes
  FROM comments
  INNER JOIN contents
  ON comments.id_contents = contents.id
  INNER JOIN users
  ON comments.id_users = users.id
  WHERE comments.id_contents  = :contents_id ORDER BY comments.id');
  $req->bindParam(':contents_id', $get_id, PDO::PARAM_INT);
  $req->execute();
  $comments = $req->fetchAll();
  return $comments;
}

function getNotifications(PDO $bdd, $session_users_id)
{
  $req = $bdd->prepare('SELECT id, notification, date FROM notifications WHERE id_users = :id ORDER BY id');
  $req->bindParam(':id', $session_users_id, PDO::PARAM_INT);
  $req->execute();
  $notifications = $req->fetchAll();
  return $notifications;
}
