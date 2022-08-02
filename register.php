<?php
session_start();
$page = "register";
require('./assets/require/head.php');
?>

<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="register-section">

      <div>
         <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
            if ($_GET['error'] == 'invalid_confirm') { ?>
               <h5>Wrong password confirmation</h5>
            <?php  } else if ($_GET['error'] == 'email_exist') { ?>
               <h5>Email already exist</h5>
         <?php }
         } ?>
      </div>

      <div class="form">
         <div class="form_content">

            <div class="leftside">
               <img src="./assets/img/music-g8090509f0_1920.png" alt="" />
            </div>

            <div class="rightside">
               <form class="form_action" action="./assets/actions/register_action.php" method="post" enctype="multipart/form-data">

                  <label for="register_name"></label>
                  <input type="text" class="inputbox" placeholder="Nom" id="register_name" name="name" required />

                  <label for="register_lastname"></label>
                  <input type="text" class="inputbox" placeholder="Prénom" id="register_lastname" name="lastname" required />

                  <label for="register_email"></label>
                  <input type="text" class="inputbox" placeholder="Email" id="register_email" name="email" required />

                  <label for="register_password"></label>
                  <input type="password" class="inputbox" placeholder="Mot de passe" id="register_password" name="password" required />

                  <label for="register_password_confirm"></label>
                  <input type="password" class="inputbox" placeholder="Confirmez votre mot de passe" id="register_password_confirm" name="password_confirm" required />

                  <button type="submit" class="button">Ajouter</button>
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