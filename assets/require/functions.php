<?php

function getRandomTuto(PDO $bdd)
{
  $tutorial = 'Tutorial';
  $req = $bdd->prepare("SELECT * FROM contents WHERE category = :category ORDER BY RAND() LIMIT 1 ");
  $req->bindParam(':category', $tutorial, PDO::PARAM_STR);
  $req->execute();
  $random_tuto = $req->fetch();
  return $random_tuto;
}

function getRandomPerf(PDO $bdd)
{
  $performance = 'Performance';
  $req = $bdd->prepare("SELECT * FROM contents WHERE category = :category ORDER BY RAND() LIMIT 1 ");
  $req->bindParam(':category', $performance, PDO::PARAM_STR);
  $req->execute();
  $random_perf = $req->fetch();
  return $random_perf;
}

function getRandomSheet(PDO $bdd)
{
  $sheet_music = 'Sheet Music';
  $req = $bdd->prepare("SELECT * FROM contents WHERE category = :category ORDER BY RAND() LIMIT 1 ");
  $req->bindParam(':category', $sheet_music, PDO::PARAM_STR);
  $req->execute();
  $random_sheet = $req->fetch();
  return $random_sheet;
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
  $user_content_information = $req->fetch();
  return $user_content_information;
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
  $req = $bdd->prepare('SELECT id, name, lastname, email, type, credits FROM users WHERE id= :id');
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
