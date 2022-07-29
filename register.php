<?php
session_start();
$page = "register";
require('./assets/require/head.php');
?>

<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="register-section">

      <div>
         <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
            if ($_GET['error'] == 'vide') { ?>
               <h5>Veuillez remplir tous les champs</h5>
            <?php } else if ($_GET['error'] == 'invalidPassword') { ?>
               <h5>Confirmation de mot de passe incorrecte</h5>
            <?php  } else if ($_GET['error'] == 'adressexistante') { ?>
               <h5>Adresse email déjà utilisée</h5>
         <?php }
         } ?>
      </div>

      <div class="wrapp">
         <div class="col2 hero">
            <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
            <div class="miror">
               <h1 class="abyss"><span>Au delà de l'abîme</span><br>S'inscrire aux profondeurs</h1>
            </div>
         </div>
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

                  <label for="register_confirm_password"></label>
                  <input type="password" class="inputbox" placeholder="Confirmez votre mot de passe" id="register_confirm_password" name="confirm_password" required />

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