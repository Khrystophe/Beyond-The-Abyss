<?php
session_start();
$page = "register";
require('./assets/require/head.php');
?>

<main class="autoAlpha" data-barba="wrapper">
   <div class="min-height" data-barba="container" data-barba-namespace="register-section">

      <?php
      if (isset($_GET['error']) && !empty($_GET['error'])) {
         if ($_GET['error'] == 'confirm_false') { ?>
            <script>
               alert('Wrong password confirmation')
            </script>
         <?php
         } else if ($_GET['error'] == 'email_exist') { ?>
            <script>
               alert('This email already exists ')
            </script>
         <?php
         } else if ($_GET['error'] == 'contact_admin') { ?>
            <script>
               alert('Contact an administrator')
            </script>
      <?php
         }
      } ?>

      <div class="form">
         <div class="form_content">

            <div class="leftside">
               <img src="./assets/img/musicgrise.png" alt="" />
            </div>

            <div class="rightside">
               <form class="form_action" action="./assets/actions/register_action.php" method="post" enctype="multipart/form-data">

                  <label for="register_name"></label>
                  <input type="text" class="inputbox" placeholder="Name" id="register_name" name="name" required />

                  <label for="register_lastname"></label>
                  <input type="text" class="inputbox" placeholder="Lastname" id="register_lastname" name="lastname" required />

                  <label for="register_email"></label>
                  <input type="text" class="inputbox" placeholder="Email" id="register_email" name="email" required />

                  <label for="register_password"></label>
                  <input type="password" class="inputbox" placeholder="Password" id="register_password" name="password" required />

                  <label for="register_password_confirm"></label>
                  <input type="password" class="inputbox" placeholder="Confirm your password" id="register_password_confirm" name="password_confirm" required />

                  <button type="submit" class="button">Register</button>
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