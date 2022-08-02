<?php
session_start();
$page = 'login';
require('./assets/require/head.php');
?>

<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="login-section">

      <div>
         <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
            if ($_GET['error'] == 'password') { ?>
               <h5>Wrong password</h5>
            <?php } else if ($_GET['error'] == 'nonexist') { ?>
               <h5>This user does not exist</h5>
         <?php }
         } ?>
      </div>

      <div class="form">
         <div class="form_content">

            <div class="leftside">
               <img src="./assets/img/music-g8090509f0_1920.png" alt="" />
            </div>

            <div class="rightside">
               <form class="form_action" action="./assets/actions/login_action.php" method="post">

                  <label for="login_email"></label>
                  <input type="text" placeholder="Email" class="inputbox" id="login_email" name="email" required />

                  <label for="login_password"></label>
                  <input type="password" placeholder="Mot de passe" class="inputbox" id="login_password" name="password" required />

                  <button type="submit" class="button">Connexion</button>
               </form>
            </div>

         </div>
      </div>

   </div>
   <?php
   require('./assets/require/foot.php');
   ?>
</main>


</body>

</html>