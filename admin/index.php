<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/head.php');

    require('./assets/require/foot.php');
  } else {

    header('location: /Diplome/index.php');
  }
}
