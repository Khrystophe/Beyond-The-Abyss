<?php

function getRandomTuto()
{
  global $bdd;
  $req = $bdd->query("SELECT * FROM contents WHERE category = 'Tutorial' ORDER BY RAND() LIMIT 1 ");
  $randomTuto = $req->fetch();
  return $randomTuto;
}

function getRandomPerf()
{
  global $bdd;
  $req = $bdd->query("SELECT * FROM contents WHERE category = 'Performance' ORDER BY RAND() LIMIT 1 ");
  $randomPerf = $req->fetch();
  return $randomPerf;
}

function getRandomSheet()
{
  global $bdd;
  $req = $bdd->query("SELECT * FROM contents WHERE category = 'Sheet Music' ORDER BY RAND() LIMIT 1 ");
  $randomSheet = $req->fetch();
  return $randomSheet;
}

function getContents()
{
  global $bdd;
  $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
  $req->execute(array(
    ':category' => $_GET['category']
  ));
  $contents = $req->fetchAll();
  return $contents;
}

function getUserContent()
{
  global $bdd;
  $req = $bdd->prepare('SELECT * FROM contents WHERE id_users = :id_users ');
  $req->execute(array(
    ':id_users' => $_SESSION['users']['id']
  ));
  $contents = $req->fetchAll();
  return $contents;
}

function getUserPurchasedContent()
{
  global $bdd;
  $req = $bdd->prepare('SELECT purchased_contents.id_contents, contents.title , contents.composer, contents.category, contents.content, contents.price, contents.id, contents.description, contents.id_users
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

function getSearchResults()
{
  global $bdd;
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

function getUserInformations()
{
  global $bdd;
  $req = $bdd->prepare('SELECT * FROM users WHERE id= :id');
  $req->execute(array(
    ':id' => $_SESSION['users']['id']
  ));
  $get_user_informations = $req->fetchAll();
  return $get_user_informations;
}

function getContent()
{
  global $bdd;
  $req = $bdd->prepare('SELECT * FROM contents WHERE id = :id ');
  $req->execute(array(
    ':id' => $_GET['id']
  ));
  $content = $req->fetch();
  return $content;
}

function getContentAuthorInformations()
{
  global $bdd;
  $req = $bdd->prepare('SELECT  users.name, users.lastname
  FROM users
  INNER JOIN contents
  ON users.id = contents.id_users WHERE contents.id = :contents_id ');
  $req->execute(array(
    ':contents_id' => $_GET['id']
  ));
  $content_author = $req->fetch();
  return $content_author;
}

function getComments()
{
  global $bdd;
  $req = $bdd->prepare('SELECT  users.name, users.lastname, comments.comment, comments.id,comments.id_users, comments.date, comments.likes
  FROM comments
  INNER JOIN contents
  ON comments.id_contents = contents.id
  INNER JOIN users
  ON comments.id_users = users.id
  WHERE comments.id_contents  = :contents_id ');
  $req->execute(array(
    ':contents_id' => $_GET['id']
  ));
  $comments = $req->fetchAll();
  return $comments;
}
