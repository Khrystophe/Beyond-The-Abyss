<?php

function getRandomTuto(PDO $bdd)
{
  $req = $bdd->query("SELECT * FROM contents WHERE category = 'Tutorial' ORDER BY RAND() LIMIT 1 ");
  $random_tuto = $req->fetch();
  return $random_tuto;
}

function getRandomPerf(PDO $bdd)
{
  $req = $bdd->query("SELECT * FROM contents WHERE category = 'Performance' ORDER BY RAND() LIMIT 1 ");
  $random_perf = $req->fetch();
  return $random_perf;
}

function getRandomSheet(PDO $bdd)
{
  $req = $bdd->query("SELECT * FROM contents WHERE category = 'Sheet Music' ORDER BY RAND() LIMIT 1 ");
  $random_sheet = $req->fetch();
  return $random_sheet;
}

function getContents(PDO $bdd)
{
  $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
  $req->execute(array(
    ':category' => $_GET['category']
  ));
  $contents = $req->fetchAll();
  return $contents;
}

function getUsersContentsInformations(PDO $bdd)
{
  $req = $bdd->query('SELECT users.id, users.name, users.lastname
  FROM users
  INNER JOIN contents
  ON users.id = contents.id_users');
  $get_users_contents_informations = $req->fetchAll();
  return $get_users_contents_informations;
}

function getUserContent(PDO $bdd)
{
  $req = $bdd->prepare('SELECT * FROM contents WHERE id_users = :id_users ');
  $req->execute(array(
    ':id_users' => $_SESSION['users']['id']
  ));
  $contents = $req->fetchAll();
  return $contents;
}

function getUserPurchasedContent(PDO $bdd)
{
  $req = $bdd->prepare('SELECT purchased_contents.id_contents, contents.title , contents.composer, contents.category, contents.content, contents.price, contents.id, contents.description, contents.id_users, contents.likes, contents.level
  FROM purchased_contents 
  INNER JOIN contents
  ON purchased_contents.id_contents = contents.id
  WHERE purchased_contents.id_users = :id_users ');
  $req->execute(array(
    ':id_users' => $_SESSION['users']['id']
  ));
  $contents = $req->fetchAll();
  return $contents;
}

function getSearchResults(PDO $bdd)
{
  $title = $_POST['title'];
  $titleSplit = str_split($title, 3);
  $titleImplode = implode("%' OR title LIKE '%", $titleSplit);

  $composer = $_POST['composer'];
  $composerSplit = str_split($composer, 3);
  $composerImplode = implode("%' OR composer LIKE '%", $composerSplit);

  $category = $_POST['category'];

  $level = $_POST['level'];

  if ((isset($level) && !empty($level)) && (isset($category) && !empty($category))) {

    $req = $bdd->query("SELECT * FROM contents WHERE level = '$level' AND category = '$category' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
    $contents = $req->fetchAll();
  } else if (isset($level) && !empty($level)) {

    $req = $bdd->query("SELECT * FROM contents WHERE level = '$level' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
    $contents = $req->fetchAll();
  } else if (isset($category) && !empty($category)) {

    $req = $bdd->query("SELECT * FROM contents WHERE category = '$category' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
    $contents = $req->fetchAll();
  } else {

    $req = $bdd->query("SELECT * FROM contents WHERE (title LIKE '%" . $titleImplode . "%') AND (composer LIKE '%" . $composerImplode . "%')");
    $contents = $req->fetchAll();
  }
  return $contents;
}

function getUserInformations(PDO $bdd)
{
  $req = $bdd->prepare('SELECT * FROM users WHERE id= :id');
  $req->execute(array(
    ':id' => $_SESSION['users']['id']
  ));
  $get_user_informations = $req->fetch();
  return $get_user_informations;
}

function getContentAndUserInformations(PDO $bdd)
{
  $req = $bdd->prepare('SELECT users.name, users.lastname, contents.id, contents.title, contents.composer, contents.category, contents.level, contents.content, contents.price, contents.description, contents.likes, contents.id_users
  FROM users
  INNER JOIN contents
  ON users.id = contents.id_users WHERE contents.id = :contents_id ');
  $req->execute(array(
    ':contents_id' => $_GET['id']
  ));
  $content_author = $req->fetch();
  return $content_author;
}

function getComments(PDO $bdd)
{
  $req = $bdd->prepare('SELECT  users.name, users.lastname, comments.comment, comments.id,comments.id_users, comments.date, comments.likes
  FROM comments
  INNER JOIN contents
  ON comments.id_contents = contents.id
  INNER JOIN users
  ON comments.id_users = users.id
  WHERE comments.id_contents  = :contents_id ORDER BY comments.id');
  $req->execute(array(
    ':contents_id' => $_GET['id']
  ));
  $comments = $req->fetchAll();
  return $comments;
}

function getNotifications(PDO $bdd)
{
  $req = $bdd->prepare('SELECT id, notification, date FROM notifications WHERE id_users = :id ORDER BY id');
  $req->execute(array(
    ':id' => $_SESSION['users']['id']
  ));
  $notifications = $req->fetchAll();
  return $notifications;
}
