<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/co_bdd.php');
    require('./assets/require/head.php');

    require('./assets/require/foot.php');
  } else {

    $bdd = null;
    header('location: /Diplome/index.php?error=028140');
    die();
  }
}
