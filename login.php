<?php
session_start();
if (!isset($_SESSION['users']) && empty($_SESSION['users'])) {

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

            <?php } else if ($_GET['error'] == 'nonexist') { ?>

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
                     <input type="text" placeholder="Email" class="inputbox" id="login_email" name="email" required pattern="^[A-Za-z]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$" />

                     <label for="login_password"></label>
                     <input type="password" placeholder="password" class="inputbox" id="login_password" name="password" required pattern="^[0-9]+$" minlength="1" />

                     <button type="submit" class="button">Login</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </main>

<?php require('./assets/require/foot.php');
} else {

   header('location: index.php');
}
?>