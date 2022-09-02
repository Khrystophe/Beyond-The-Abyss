<?php


if (isset($_SESSION['users']['id']) && !empty($_SESSION['users']['id'])) {


  $check_session_users_id = is_numeric($_SESSION['users']['id'])
    && preg_match("/^[0-9]+$/", $_SESSION['users']['id']);

  if ($check_session_users_id === true) {

    $session_users_id = $_SESSION['users']['id'];
  }
}


if (isset($_GET['category']) && !empty($_GET['category'])) {

  $check_get_category = is_string($_GET['category'])
    && preg_match("/^[a-z_]+$/", $_GET['category']);

  if ($check_get_category === true) {

    $get_category = $_GET['category'];
  }
}


if (isset($_GET['error']) && !empty($_GET['error'])) {

  $check_get_error = is_string($_GET['error'])
    && preg_match("/^[a-z_]+$/", $_GET['error']);

  if ($check_get_error === true) {

    $get_error = $_GET['error'];
  }
}


if (isset($_GET['success']) && !empty($_GET['success'])) {


  $check_get_success = is_string($_GET['success'])
    && preg_match("/^[a-z_]+$/", $_GET['success']);

  if ($check_get_success === true) {

    $get_success = $_GET['success'];
  }
}


if (isset($_GET['name']) && !empty($_GET['name'])) {

  $check_get_name = is_string($_GET['name'])
    && preg_match("/^[a-z_]+$/", $_GET['name']);

  if ($check_get_name === true) {

    $get_name = $_GET['name'];
  }
}


if (isset($_GET['id_comment']) && !empty($_GET['id_comment'])) {

  $check_get_id_comment = is_numeric($_GET['id_comment'])
    && preg_match("/^[0-9]+$/", $_GET['id_comment']);

  if ($check_get_id_comment === true) {

    $get_id_comment = $_GET['id_comment'];
  }
}


if (isset($_GET['id']) && !empty($_GET['id'])) {

  $check_get_id = is_numeric($_GET['id'])
    && preg_match("/^[0-9]+$/", $_GET['id']);

  if ($check_get_id === true) {

    $get_id = $_GET['id'];
  }
}


if (isset($_POST['name']) && !empty($_POST['name'])) {

  $check_post_name = is_string($_POST['name'])
    && strlen($_POST['name']) <= 20
    && preg_match("/^[A-Za-z '-]+$/", $_POST['name']);

  if ($check_post_name === true) {

    $post_name = $_POST['name'];
  }
}


if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {

  $check_post_lastname = is_string($_POST['lastname'])
    && strlen($_POST['lastname']) <= 20
    && preg_match("/^[A-Za-z '-]+$/", $_POST['lastname']);

  if ($check_post_lastname === true) {

    $post_lastname = $_POST['lastname'];
  }
}


if (isset($_POST['email']) && !empty($_POST['email'])) {


  $check_post_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

  if ($check_post_email !== false) {

    $post_email = $_POST['email'];
  }
}


if (isset($_FILES) && !empty($_FILES)) {
  if (array_key_exists('content', $_FILES)) {

    $allowed_mime_types = ["video/webm", "video/mp4", "video/ogv"];

    $check_files_mime_type = mime_content_type($_FILES['content']['tmp_name']);

    if (in_array($check_files_mime_type, $allowed_mime_types)) {

      $files_content_name = $_FILES['content']['name'];
      $files_content_type = $_FILES['content']['type'];
      $files_content_tmp_name = $_FILES['content']['tmp_name'];
      $files_content_error = $_FILES['content']['error'];
      $files_content_size = $_FILES['content']['size'];
    }
  }
}


if (isset($_POST['password']) && !empty($_POST['password'])) {

  $check_post_password = is_string($_POST['password'])
    && strlen($_POST['password']) >= 1
    && preg_match("/^[0-9]+$/", $_POST['password']);

  if ($check_post_password === true) {

    $post_password = $_POST['password'];
  }
}


if (isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) {

  $check_post_password_confirm = is_string($_POST['password_confirm'])
    && strlen($_POST['password_confirm']) >= 1
    && preg_match("/^[0-9]+$/", $_POST['password_confirm']);

  if ($check_post_password_confirm === true) {

    $post_password_confirm = $_POST['password_confirm'];
  }
}


if (isset($_POST['title']) && !empty($_POST['title'])) {

  $check_post_title = strlen($_POST['title']) <= 20
    && is_string($_POST['title'])
    && preg_match("/^[A-Za-z '-]+$/", $_POST['title']);

  if ($check_post_title === true) {

    $post_title = $_POST['title'];
  }
}


if (isset($_POST['composer']) && !empty($_POST['composer'])) {


  $check_post_composer = strlen($_POST['composer']) <= 20
    && is_string($_POST['composer'])
    && preg_match("/^[A-Za-z '-]+$/", $_POST['composer']);

  if ($check_post_composer === true) {

    $post_composer = $_POST['composer'];
  }
}


if (isset($_POST['category']) && !empty($_POST['category'])) {


  $check_post_category =  is_string($_POST['category'])
    && preg_match("/^[a-z_]+$/", $_POST['category']);

  if ($check_post_category === true) {

    $post_category = $_POST['category'];
  }
}


if (isset($_POST['level']) && !empty($_POST['level'])) {

  $check_post_level =  is_string($_POST['level'])
    && preg_match("/^[a-z-]+$/", $_POST['level']);

  if ($check_post_level === true) {

    $post_level = $_POST['level'];
  }
}
