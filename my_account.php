<?php
session_start();
$page = 'my_account';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');
require('./assets/actions/functions.php');

$get_user_informations = getUserInformations();
?>

<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="my_account-section">

      <?php if (isset($_GET['success']) && !empty($_GET['success'])) {
         if ($_GET['success'] == 'change_ok') { ?>
            <script>
               alert('Password changed successfully')
            </script>
         <?php
         } else  if ($_GET['success'] == 'creation') { ?>
            <script>
               alert('The creation of your account is a success')
            </script>
         <?php } else   if ($_GET['success'] == 'connected') { ?>
            <script>
               alert("Welcome <?= $_SESSION['users']['name'] . ' ' . $_SESSION['users']['lastname'] ?> !")
            </script>
         <?php
         }
      }
      if (isset($_GET['error']) && !empty($_GET['error'])) {
         if ($_GET['error'] == 'confirm_false') { ?>
            <script>
               alert('Wrong password confirmation')
            </script>
         <?php
         } else if ($_GET['error'] == 'invalid_password') { ?>
            <script>
               alert('Wrong password')
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


               <?php
               foreach ($get_user_informations as $user_informations) { ?>

                  <h2 type="text" class="form_title">Hello <?= htmlspecialchars($user_informations['name']) . " " . htmlspecialchars($user_informations['lastname']); ?> </h2>

                  <h2 type="text" class="form_title">Your Email : <?= htmlspecialchars($user_informations['email']); ?> </h2>

                  <div class="margin"></div>

                  <form data-barba-prevent class="form_action" action="./assets/actions/edit_name_lastname_action.php" method="post">


                     <label for="name"></label>
                     <input type="text" class="inputbox" placeholder="Your current name : <?= htmlspecialchars($user_informations['name']);  ?> " id="name" name="name" required />

                     <label for="lastname"></label>
                     <input type="text" class="inputbox" placeholder="Your current last name : <?= htmlspecialchars($user_informations['lastname']);  ?> " id="lastname" name="lastname" required />

                     <button type="submit" class="button">Edit</button>

                  </form>

                  <div class="margin"></div>

                  <form data-barba-prevent class="form_action" action="./assets/actions/edit_password_action.php" method="post">

                     <label for="old_password"></label>
                     <input type="password" placeholder=" Old password " class="inputbox" id="old_password" name="old_password" required />

                     <label for="new_password"></label>
                     <input type="password" placeholder=" New password " class="inputbox" id="new_password" name="new_password" required />

                     <label for="new_password_confirm"></label>
                     <input type="password" class="inputbox" placeholder="Confirm your new password" id="new_password_confirm" name="new_password_confirm" required />


                     <button type="submit" class="button">Edit</button>

                     <div class="margin"></div>

                  </form>

                  <h2 type="text" class="form_title">Add Content</h2>

                  <div class="margin"></div>

                  <form class="form_action" action="./assets/actions/add_content_action.php" method="post" enctype="multipart/form-data">

                     <label for="title"></label>
                     <input type="text" class="inputbox" placeholder="Title" id="title" name="title" required />

                     <label for="composer"></label>
                     <input type="text" class="inputbox" placeholder="Composer" id="composer" name="composer" required />

                     <label for="description"></label>
                     <textarea class="inputbox" placeholder="Description" id="description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>

                     <label for="category"></label>
                     <select class="inputbox" id="category" name="category" required>
                        <option value="">--Category--</option>
                        <option value="Tutorial">Tutorial</option>
                        <option value="Performance">Performances</option>
                        <option value="Sheet Music">Sheet Music</option>
                     </select>

                     <label for="level"></label>
                     <select class="inputbox" id="level" name="level" required>
                        <option value="">--Level--</option>
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                        <option value="very-hard">Very Hard</option>
                     </select>

                     <label for="content"></label>
                     <input type="file" class="inputbox" id="content" name="content" required />

                     <label for="my_account_free_content">Free Content</label>
                     <input type="checkbox" class="inputbox" id="my_account_free_content" name="free_content" />

                     <button type="submit" class="button">Add</button>
                  </form>

                  <div class="margin"></div>

                  <div class="form_action">
                     <button class="btn_content"><a class="button link_page" href="content.php?category=user_content">Your content</a></button>
                  </div>

                  <div class="form_action">
                     <button class="btn_content"><a class="button link_page" href="content.php?category=user_purchased_content">Your purchased content</a></button>
                  </div>

               <?php } ?>
            </div>


         </div>
      </div>




   </div>
</main>

<?php
require('./assets/require/foot.php');
?>

</body>

</html>