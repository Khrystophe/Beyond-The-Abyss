<?php

if (isset($_SESSION['users']['id']) && !empty($_SESSION['users']['id'])) {

  $check_session_users_id = is_numeric($_SESSION['users']['id'])
    && preg_match("/^[0-9]+$/", $_SESSION['users']['id']);

  if ($check_session_users_id === true) {

    $session_users_id = $_SESSION['users']['id'];
  }
}


if (isset($_SESSION['users']['type']) && !empty($_SESSION['users']['type'])) {

  $check_session_users_type = is_string($_SESSION['users']['type'])
    && preg_match("/^[a-z]+$/", $_SESSION['users']['type']);

  if ($check_session_users_type === true) {

    $session_users_type = $_SESSION['users']['type'];
  }
}


if (isset($_GET['category']) && !empty($_GET['category'])) {

  $check_get_category = is_string($_GET['category'])
    && preg_match("/^[a-z_]+$/", $_GET['category']);

  if ($check_get_category === true) {

    $get_category = $_GET['category'];
  }
}


if (isset($_GET['type']) && !empty($_GET['type'])) {

  $check_get_type = is_string($_GET['type'])
    && preg_match("/^[a-z]+$/", $_GET['type']);

  if ($check_get_type === true) {

    $get_type = $_GET['type'];
  }
}


if (isset($_GET['error']) && !empty($_GET['error'])) {

  $check_get_error = is_numeric($_GET['error'])
    && preg_match("/^[0-9]+$/", $_GET['error'])
    && strlen((string)$_GET['error']) >= 5;

  if ($check_get_error === true) {

    $get_error = $_GET['error'];
  }
}


if (isset($_GET['success']) && !empty($_GET['success'])) {

  $check_get_success = is_numeric($_GET['success'])
    && preg_match("/^[0-9]+$/", $_GET['success'])
    && strlen((string)$_GET['success']) >= 5;

  if ($check_get_success === true) {

    $get_success = $_GET['success'];
  }
}


if (isset($_GET['name']) && !empty($_GET['name'])) {

  $check_get_name = is_string($_GET['name'])
    && preg_match("/^[a-z]+$/", $_GET['name']);

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


if (isset($_POST['id']) && !empty($_POST['id'])) {

  $check_post_id = is_numeric($_POST['id'])
    && preg_match("/^[0-9]+$/", $_POST['id']);

  if ($check_post_id === true) {

    $post_id = $_POST['id'];
  }
}


if (isset($_POST['id_users']) && !empty($_POST['id_users'])) {

  $check_post_id_users = is_numeric($_POST['id_users'])
    && preg_match("/^[0-9]+$/", $_POST['id_users']);

  if ($check_post_id_users === true) {

    $post_id_users = $_POST['id_users'];
  }
}


if (isset($_POST['reporting']) && !empty($_POST['reporting'])) {

  $check_post_reporting = is_numeric($_POST['reporting'])
    && preg_match("/^[0-9]+$/", $_POST['reporting']);
}


if (isset($_POST['credits']) && !empty($_POST['credits'])) {

  $check_post_credits = is_numeric($_POST['credits'])
    && preg_match("/^[0-9]+$/", $_POST['credits']);
}


if (isset($_POST['name']) && !empty($_POST['name'])) {

  $check_post_name = is_string($_POST['name'])
    && strlen($_POST['name']) <= 12
    && preg_match("/^[a-zA-Zéèêàâçù '\"-]+$/", $_POST['name']);

  if ($check_post_name === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['name']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);

    $post_name = preg_replace('/ $/', "", $sanitize_two);
  }
}


if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {

  $check_post_lastname = is_string($_POST['lastname'])
    && strlen($_POST['lastname']) <= 12
    && preg_match("/^[a-zA-Zéèêàâçù '\"-]+$/", $_POST['lastname']);

  if ($check_post_lastname === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['lastname']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);

    $post_lastname = preg_replace('/ $/', "", $sanitize_two);
  }
}


if (isset($_POST['email']) && !empty($_POST['email'])) {

  $check_post_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

  if ($check_post_email !== false) {

    $post_email = $_POST['email'];
  }
}


if (isset($_POST['type']) && !empty($_POST['type'])) {

  $check_post_type = is_string($_POST['type'])
    && preg_match("/^[a-z]+$/", $_POST['type']);

  if ($check_post_type === true) {

    $post_type = $_POST['type'];
  }
}


if (isset($_POST['password']) && !empty($_POST['password'])) {

  $check_post_password = is_string($_POST['password'])
    && strlen($_POST['password']) >= 2
    && preg_match("/^[0-9a-zA-Z]+$/", $_POST['password']);

  if ($check_post_password === true) {

    $post_password = $_POST['password'];
  }
}


if (isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) {

  $check_post_password_confirm = is_string($_POST['password_confirm'])
    && strlen($_POST['password_confirm']) >= 2
    && preg_match("/^[0-9a-zA-Z]+$/", $_POST['password_confirm']);

  if ($check_post_password_confirm === true) {

    $post_password_confirm = $_POST['password_confirm'];
  }
}


if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {

  $check_post_old_password = is_string($_POST['old_password'])
    && strlen($_POST['old_password']) >= 2
    && preg_match("/^[0-9a-zA-Z]+$/", $_POST['old_password']);

  if ($check_post_old_password === true) {

    $post_old_password = $_POST['old_password'];
  }
}


if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {

  $check_post_new_password = is_string($_POST['new_password'])
    && strlen($_POST['new_password']) >= 2
    && preg_match("/^[0-9a-zA-Z]+$/", $_POST['new_password']);

  if ($check_post_new_password === true) {

    $post_new_password = $_POST['new_password'];
  }
}


if (isset($_POST['new_password_confirm']) && !empty($_POST['new_password_confirm'])) {

  $check_post_new_password_confirm = is_string($_POST['new_password_confirm'])
    && strlen($_POST['new_password_confirm']) >= 2
    && preg_match("/^[0-9a-zA-Z]+$/", $_POST['new_password_confirm']);

  if ($check_post_new_password_confirm === true) {

    $post_new_password_confirm = $_POST['new_password_confirm'];
  }
}


if (isset($_POST['title']) && !empty($_POST['title'])) {

  $check_post_title = strlen($_POST['title']) <= 22
    && is_string($_POST['title'])
    && preg_match("/^[0-9a-zA-Zéèêàâçù '\"!?°-]+$/", $_POST['title']);

  if ($check_post_title === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['title']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);

    $post_title = preg_replace('/ $/', "", $sanitize_two);
  }
}


if (isset($_POST['composer']) && !empty($_POST['composer'])) {

  $check_post_composer = strlen($_POST['composer']) <= 22
    && is_string($_POST['composer'])
    && preg_match("/^[0-9a-zA-Zéèêàâçù -]+$/", $_POST['composer']);

  if ($check_post_composer === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['composer']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);

    $post_composer = preg_replace('/ $/', "", $sanitize_two);
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


if (isset($_POST['price']) && !empty($_POST['price'])) {

  $check_post_price = is_string($_POST['price'])
    && strlen($_POST['price']) >= 1
    && preg_match("/^([1-9]|[1-9][0-9]|[1-4][0-9][0-9]|500|Free)$/", $_POST['price']);

  if ($check_post_price === true) {

    $post_price = $_POST['price'];
  }
}


if (isset($_POST['description']) && !empty($_POST['description'])) {

  $check_post_description =  is_string($_POST['description'])
    && preg_match("/^[\\s0-9a-zA-Zéèêàâçù# ()'\".!?,;:°-]+$/", $_POST['description'])
    && strlen($_POST['description']) <= 1502;

  if ($check_post_description === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['description']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);
    $sanitize_three = preg_replace('/ $/', "", $sanitize_two);

    $regex = '/(\r\n|\n|\t|\r){3,}/';
    $replacement = "\r\n\r\n";

    $post_description = preg_replace($regex, $replacement, $sanitize_three);
  }
}


if (isset($_POST['comment']) && !empty($_POST['comment'])) {

  $check_post_comment =  is_string($_POST['comment'])
    && preg_match("/^[\\s0-9a-zA-Zéèêàâçù# ()'\".!?,;:°-]+$/", $_POST['comment'])
    && strlen($_POST['comment']) <= 10002;;

  if ($check_post_comment === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['comment']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);
    $sanitize_three = preg_replace('/ $/', "", $sanitize_two);

    $regex = '/(\r\n|\n|\t|\r){3,}/';
    $replacement = "\r\n\r\n";

    $post_comment = preg_replace($regex, $replacement, $sanitize_three);
  }
}


if (isset($_POST['message']) && !empty($_POST['message'])) {

  $check_post_message =  is_string($_POST['message'])
    && preg_match("/^[\\s0-9a-zA-Zéèêàâçù# ()'\".!?,;:°-]+$/", $_POST['message'])
    && strlen($_POST['message']) <= 10002;;

  if ($check_post_message === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['message']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);
    $sanitize_three = preg_replace('/ $/', "", $sanitize_two);

    $regex = '/(\r\n|\n|\t|\r){3,}/';
    $replacement = "\r\n\r\n";

    $post_message = preg_replace($regex, $replacement, $sanitize_three);
  }
}


if (isset($_POST['notification']) && !empty($_POST['notification'])) {

  $check_post_notification =  is_string($_POST['notification'])
    && preg_match("/^[\\s0-9a-zA-Zéèêàçù# ()'\".!?,;:°-]+$/", $_POST['notification']);

  if ($check_post_notification === true) {

    $sanitize_one = preg_replace('/ +/', " ", $_POST['notification']);
    $sanitize_two = preg_replace('/^ /', "", $sanitize_one);
    $sanitize_three = preg_replace('/ $/', "", $sanitize_two);

    $regex = '/(\r\n|\n|\t|\r){3,}/';
    $replacement = "\r\n\r\n";

    $post_notification = preg_replace($regex, $replacement, $sanitize_three);
  }
}


if (isset($_FILES) && !empty($_FILES)) {
  if (array_key_exists('content', $_FILES)) {

    $explode_files_name = explode('.', $_FILES['content']['name']);
    $explode_files_tmp_name = explode('.', $_FILES['content']['tmp_name']);

    if (
      count($explode_files_name) == 2
      && count($explode_files_tmp_name) == 2
    ) {

      $allowed_extensions = ["webm", "mp4", "ogv"];
      $allowed_mime_types = ["video/webm", "video/mp4", "video/ogv"];

      $check_files_name = is_string($explode_files_name['0'])
        && preg_match("/^[0-9a-zA-Zéèêàâçù# ()'!,;°-]+$/", $explode_files_name['0']);

      $check_files_extension = in_array(strtolower(end($explode_files_name)), $allowed_extensions);

      $check_files_mime_type = in_array((strtolower(finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['content']['tmp_name']))), $allowed_mime_types);

      if (
        $check_files_name === true
        && $check_files_extension === true
        && $check_files_mime_type === true
      ) {

        $files_content_name = $_FILES['content']['name'];
        $files_content_type = $_FILES['content']['type'];
        $files_content_tmp_name = $_FILES['content']['tmp_name'];
        $files_content_error = $_FILES['content']['error'];
        $files_content_size = $_FILES['content']['size'];
      }
    }
  }
}
