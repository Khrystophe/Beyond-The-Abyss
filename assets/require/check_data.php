<?php

if (isset($_POST['name']) && !empty($_POST['name'])) {
  $name = $_POST['name'];
  $check_name = strlen($name) <= 20 && preg_match("/^[A-Za-z '-]+$/", $name);
}

if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
  $lastname = $_POST['lastname'];
  $check_lastname = strlen($lastname) <= 20 && preg_match("/^[A-Za-z '-]+$/", $lastname);
}

if (isset($_POST['email']) && !empty($_POST['email'])) {
  $email = $_POST['email'];
  $check_email = filter_var($email, FILTER_VALIDATE_EMAIL);
}

if (isset($_POST['password']) && !empty($_POST['password'])) {
  $password = $_POST['password'];
  $check_password = strlen($password) >= 1 && preg_match("/^[0-9]+$/", $password);
}

if (isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) {
  $password_confirm = $_POST['password_confirm'];
  $check_password_confirm = strlen($password_confirm) >= 1 && preg_match("/^[0-9]+$/", $password);
}

if (isset($_GET['category']) && !empty($_GET['category'])) {
  $get_category = $_GET['category'];
  $check_get_category = is_string($get_category) && preg_match("/^[a-z_]+$/", $get_category);
}

if (isset($_SESSION['users']['id']) && !empty($_SESSION['users']['id'])) {
  $session_users_id = $_SESSION['users']['id'];
  $check_session_users_id = is_numeric($session_users_id) && preg_match("/^[0-9]+$/", $session_users_id);
}

if (isset($_POST['title']) && !empty($_POST['title'])) {
  $post_title = $_POST['title'];
  $check_post_title = strlen($post_title) <= 20 && is_string($post_title) && preg_match("/^[A-Za-z '-]+$/", $post_title);
}

if (isset($_POST['composer']) && !empty($_POST['composer'])) {
  $post_composer = $_POST['composer'];
  $check_post_composer = strlen($post_composer) <= 20 && is_string($post_composer) && preg_match("/^[A-Za-z '-]+$/", $post_composer);
}

if (isset($_POST['category']) && !empty($_POST['category'])) {
  $post_category = $_POST['category'];
  $check_post_category = strlen($post_category) <= 20 && is_string($post_category) && preg_match("/^[A-Za-z '-]+$/", $post_category);
}

if (isset($_POST['level']) && !empty($_POST['level'])) {
  $post_level = $_POST['level'];
  $check_post_level = strlen($post_level) <= 20 && is_string($post_level) && preg_match("/^[A-Za-z '-]+$/", $post_level);
}
