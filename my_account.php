<?php
session_start();
$page = 'my_account';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');

$req = $bdd->prepare('SELECT * FROM users WHERE id= :id');
$req->execute(array(
   ':id' => $_SESSION['users']['id']
));
$account = $req->fetchAll();

$req2 = $bdd->prepare('SELECT * FROM contents WHERE id_users= :id_users');
$req2->execute(array(
   ':id_users' => $_SESSION['users']['id']
));
$contents = $req2->fetchAll();
?>

<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="my_account-section">


      <?php if (isset($_GET['success']) && !empty($_GET['success'])) {
         if ($_GET['success'] == 'change_ok') { ?>
            <h5>Password changed successfully</h5>
         <?php
         }
      }
      if (isset($_GET['error']) && !empty($_GET['error'])) {
         if ($_GET['error'] == 'confirm_false') { ?>
            <h5>Wrong password confirmation</h5>
         <?php
         }
         if ($_GET['error'] == 'invalid_password') { ?>
            <h5>Wrong password</h5>
      <?php
         }
      } ?>


      <div class="form">
         <div class="form_content">

            <div class="leftside">
               <img src="./assets/img/music-g8090509f0_1920.png" alt="" />
            </div>

            <div class="rightside">


               <?php foreach ($account as $acc) { ?>

                  <h2 type="text" class="form_title">Hello <?= htmlspecialchars($acc['name']) . " " . htmlspecialchars($acc['lastname']); ?> </h2>

                  <h2 type="text" class="form_title">Your Email : <?= htmlspecialchars($acc['email']); ?> </h2>

                  <div class="margin"></div>

                  <form data-barba-prevent class="form_action" action="./assets/actions/edit_name_lastname_action.php" method="post">


                     <label for="name"></label>
                     <input type="text" class="inputbox" placeholder="Your current name : <?= htmlspecialchars($acc['name']);  ?> " id="name" name="name" />

                     <label for="lastname"></label>
                     <input type="text" class="inputbox" placeholder="Your current last name : <?= htmlspecialchars($acc['lastname']);  ?> " id="lastname" name="lastname" />

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
                     <input type="text" class="inputbox" placeholder="Titre" id="title" name="title" required />

                     <label for="composer"></label>
                     <input type="text" class="inputbox" placeholder="Compositeur" id="composer" name="composer" required />

                     <label for="category"></label>
                     <select class="inputbox" id="category" name="category" required>
                        <option value="">--Category--</option>
                        <option value="tuto">Tutorial</option>
                        <option value="perf">Performances</option>
                        <option value="sheet">Sheet Music</option>
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

                     <button type="submit" class="button">Add</button>
                  </form>

                  <div class="margin"></div>

                  <div class="form_action">
                     <button class="button"><a href="content.php?category=user_content">Your content</a></button>
                  </div>

                  <div class="margin"></div>

                  <div class="form_action">
                     <button class="button"><a href="content.php?category=user_purchased_content">Your purchased content</a></button>
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