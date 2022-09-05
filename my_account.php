<?php
session_start();
require('./assets/require/check_data.php');

if (isset($session_users_id)) {

   if (
      (isset($get_error) xor !isset($check_get_error))
      &&
      (isset($get_success) xor !isset($check_get_success))
   ) {

      $page = 'my_account';
      require('./assets/require/co_bdd.php');
      require('./assets/require/functions.php');
      require('./assets/require/head.php');

      $get_user_informations = getUserInformations($bdd, $session_users_id);

      $get_user_id = htmlspecialchars($get_user_informations['id']);
      $get_user_name = htmlspecialchars($get_user_informations['name']);
      $get_user_lastname = htmlspecialchars($get_user_informations['lastname']);
      $get_user_email = htmlspecialchars($get_user_informations['email']);
      $get_user_type = htmlspecialchars($get_user_informations['type']);
      $get_user_credits = htmlspecialchars($get_user_informations['credits']);

      $notifications = getNotifications($bdd, $session_users_id);

?>


      <main class="autoAlpha" data-barba="wrapper">
         <div class="min-height" data-barba="container" data-barba-namespace="my_account-section">

            <?php

            if (isset($_GET['success']) && !empty($_GET['success'])) {
               if ($_GET['success'] == 'change_ok') { ?>

                  <script>
                     alert('Password changed successfully')
                  </script>

               <?php } else  if ($_GET['success'] == 'creation') { ?>

                  <script>
                     alert('The creation of your account is a success')
                  </script>

               <?php } else   if ($_GET['success'] == 'connected') { ?>

                  <script>
                     alert("Welcome <?= $get_user_name . ' ' . $get_user_lastname ?> !")
                  </script>

               <?php

               }
            }

            if (isset($_GET['error']) && !empty($_GET['error'])) {
               if ($_GET['error'] == 'confirm_false') { ?>

                  <script>
                     alert('Wrong password confirmation')
                  </script>

               <?php } else if ($_GET['error'] == 'invalid_password') { ?>

                  <script>
                     alert('Wrong password')
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

                     <h2 type="text" class="form_title">Hello <?= $get_user_name . " " . $get_user_lastname ?> </h2>

                     <h2 type="text" class="form_title">Your Email : <?= $get_user_email ?> </h2>

                     <div class="margin"></div>

                     <form data-barba-prevent class="form_action" action="./assets/actions/edit_name_lastname_action.php" method="post">
                        <label for="my_account_name"></label>
                        <input type="text" class="inputbox" placeholder="Your current name : <?= $get_user_name ?> " id="my_account_name" name="name" required />

                        <label for="my_account_lastname"></label>
                        <input type="text" class="inputbox" placeholder="Your current last name : <?= $get_user_lastname  ?> " id="my_account_lastname" name="lastname" required />

                        <button type="submit" class="button">Edit</button>
                     </form>

                     <div class="margin"></div>

                     <form data-barba-prevent class="form_action" action="./assets/actions/edit_password_action.php" method="post">
                        <label for="my_account_old_password"></label>
                        <input type="password" placeholder=" Old password " class="inputbox" id="my_account_old_password" name="old_password" required />

                        <label for="my_account_new_password"></label>
                        <input type="password" placeholder=" New password " class="inputbox" id="my_account_new_password" name="new_password" required />

                        <label for="my_account_new_password_confirm"></label>
                        <input type="password" class="inputbox" placeholder="Confirm your new password" id="my_account_new_password_confirm" name="new_password_confirm" required />

                        <button type="submit" class="button">Edit</button>

                        <div class="margin"></div>
                     </form>

                     <h2 type="text" class="form_title">Add Content</h2>

                     <div class="margin"></div>

                     <form class="form_action" action="./assets/actions/add_content_action.php?type=user" method="post" enctype="multipart/form-data">
                        <label for="my_account_title"></label>
                        <input type="text" class="inputbox" placeholder="Title" id="my_account_title" name="title" required />

                        <label for="my_account_composer"></label>
                        <input type="text" class="inputbox" placeholder="Composer" id="my_account_composer" name="composer" required />

                        <label for="my_account_description"></label>
                        <textarea class="inputbox" placeholder="Description" id="my_account_description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>

                        <label for="my_account_category"></label>
                        <select class="inputbox" id="my_account_category" name="category" required>
                           <option value="">--Category--</option>
                           <option value="tutorial">Tutorial</option>
                           <option value="performance">Performances</option>
                           <option value="sheet_music">Sheet Music</option>
                        </select>

                        <label for="my_account_level"></label>
                        <select class="inputbox" id="my_account_level" name="level" required>
                           <option value="">--Level--</option>
                           <option value="easy">Easy</option>
                           <option value="medium">Medium</option>
                           <option value="hard">Hard</option>
                           <option value="very-hard">Very Hard</option>
                        </select>

                        <label for="my_account_content"></label>
                        <input type="file" class="inputbox" id="my_account_content" name="content" onchange="javascript: return validContent('my_account')" required />

                        <label for="my_account_price">Price</label>
                        <input type="text" class="inputbox" id="my_account_price" name="price" required />

                        <button type="submit" class="button">Add Content</button>
                     </form>

                     <div class="margin"></div>

                     <div class="form_action">
                        <button class="btn_content"><a class="button link_page" href="content.php?category=user_content">Your content</a></button>
                     </div>

                     <div class="form_action">
                        <button class="btn_content"><a class="button link_page" href="content.php?category=user_purchased_content">Your purchased content</a></button>
                     </div>

                     <div class="form_action">
                        <button class="btn_content"><a data-barba-prevent class="button delete" href="/Diplome/assets/actions/delete_users_action.php?id=<?= $get_user_id ?>" onclick="javascript:return deleteAccountAlert()">Delete my account</a></button>
                     </div>
                  </div>
               </div>
            </div>

            <?php foreach ($notifications as $notification) {

               $notification_id = htmlspecialchars($notification['id']);
               $notification_text = htmlspecialchars($notification['notification']);
               $notification_date = htmlspecialchars($notification['date']);

            ?>


               <div class='deck'>
                  <div class='single_player_card'>
                     <div class='cardHeader'>
                        <span class='cardHeader_date'><?= $notification_date ?></span>
                     </div>

                     <div class='cardBody'>
                        <p class='cardText'><?= $notification_text ?></p>
                     </div>

                     <div class="form_action">
                        <button class="btn_content"><a data-barba-prevent class="button link_page" href="/Diplome/assets/actions/delete_notification_action.php?id=<?= $notification_id ?>">Delete notification</a></button>
                     </div>
                  </div>
               </div>
            <?php } ?>
         </div>
      </main>

<?php require('./assets/require/foot.php');
   } else {

      http_response_code(400);
      header('location: index.php?error=processing_bad_or_malformed_request');
      die();
   }
} else {

   http_response_code(400);
   header('location: index.php?error=processing_bad_or_malformed_request_or_not_connected');
   die();
}
?>