<?php
session_start();
require('./assets/require/check_data.php');

if (!isset($_SESSION['users']) && empty($_SESSION['users'])) {

   if (isset($get_error) xor !isset($check_get_error)) {

      $page = 'login';
      require('./assets/require/head.php');

?>

      <main class="autoAlpha" data-barba="wrapper">
         <div class="min-height" data-barba="container" data-barba-namespace="login-section">

            <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
               if ($_GET['error'] == 'password') { ?>

                  <script>
                     alert('Wrong password')
                  </script>

               <?php } else if ($_GET['error'] == 'none_exist') { ?>

                  <script>
                     alert('This user does not exist')
                  </script>

            <?php

               }
            }

            ?>

            <div class="form">
               <div class="form_content">

                  <div class="leftside">
                     <img src="./assets/img/musicgrise.png" alt="" />
                  </div>

                  <div class="rightside">
                     <form class="form_action" action="./assets/actions/login_action.php" method="post">

                        <label for="login_email"></label>
                        <input type="text" placeholder="Email" class="inputbox" id="login_email" name="email" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" />

                        <label for="login_password"></label>
                        <input type="password" placeholder="password" class="inputbox" id="login_password" name="password" required pattern="^([1-9][0-9])+$" minlength="2" />

                        <button type="submit" class="button">Login</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </main>

<?php require('./assets/require/foot.php');
   } else {

      http_response_code(400);
      header('location: index.php?error=processing_bad_or_malformed_request');
      die();
   }
} else {

   header('location: my_account.php');
   die();
}
?>