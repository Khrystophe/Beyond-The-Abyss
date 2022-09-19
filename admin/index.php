<?php
session_start();
require('./assets/require/check_data.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    if (
      (isset($get_error) xor !isset($check_get_error))
      &&
      (isset($get_success) xor !isset($check_get_success))
    ) {

      require('./assets/require/co_bdd.php');
      require('./assets/require/errors_success_modal.php');
      require('./assets/require/head.php');


      require('./assets/require/foot.php'); ?>

    <?php } else {

      $bdd = null;
      http_response_code(400);
      header('location: /Diplome/index.php?error=02815');
      die();
    } ?>


<?php  } else {

    $bdd = null;
    header('location: /Diplome/index.php?error=028140');
    die();
  }
}
?>