<?php

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {

   $req = $bdd->prepare('SELECT name, lastname, credits FROM users WHERE id = :id');
   $req->execute(array(
      ':id' => $_SESSION['users']['id']
   ));
   $user = $req->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
   <link rel="stylesheet" href="./assets/css/style.css" />


</head>

<body>

   <div class="loading-container">
      <div class="loading-screen">
         <img class="logo_transition" src="./assets/img/musicgrise.png" alt="">
         <div class="transition_circle"></div>
      </div>
   </div>

   <header>

      <nav>
         <div id="search_modal" class="modal">

            <div class="modal-content">
               <div class="modal_form">
                  <div class="modal_form_content">

                     <span class="search_close">&times;</span>
                     <form class="form_action" action="/Diplome/content.php?category=search_results" method="post">

                        <label for="search_title"></label>
                        <input type="text" class="inputbox" placeholder="Title" id="search_title" name="title" />

                        <label for="search_composer"></label>
                        <input type="text" class="inputbox" placeholder="Composer" id="search_composer" name="composer" />

                        <label for="search_category"></label>
                        <select class="inputbox" id="search_category" name="category">
                           <option value="">--Category--</option>
                           <option value="Tutorial">Tutorial</option>
                           <option value="Performance">Performances</option>
                           <option value="Sheet Music">Sheet Music</option>
                        </select>

                        <label for="search_level"></label>
                        <select class="inputbox" id="search_level" name="level">
                           <option value="">--Level--</option>
                           <option value="easy">Easy</option>
                           <option value="medium">Medium</option>
                           <option value="hard">Hard</option>
                           <option value="very-hard">Very Hard</option>
                        </select>

                        <button type="submit" class="button">Search</button>
                     </form>
                  </div>
               </div>
            </div>

         </div>

         <div class="little_logo">
            <img class="little_main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
            <div class="little_main_logo_disc"></div>
         </div>

         <div class="nav_bar">

            <?php
            if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
               echo 'Hello' . " " . htmlspecialchars($user['name']);
            }
            ?>
            <button class="dropbtn" id="search_button"><i class="fas fa-search fa-2x"></i></button>

            <?php
            if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
               echo 'Your credits :' . " " . htmlspecialchars($user['credits']);
            }
            ?>



         </div>
         <div class="toggle">
            <div class="ouvrir"></div>
            <div class="fermer"></div>
         </div>

         <div class="menu">
            <div class="menu__left">
               <div class="menu__left__inner">


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'index') { ?>
                        <a class="link_menu" href="index.php">Home</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'tuto_content') { ?>
                        <a class="link_menu" href="content.php?category=Tutorial">Tutorials</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'perf_content') { ?>
                        <a class="link_menu" href="content.php?category=Performance">Performances</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'sheet_content') { ?>
                        <a class="link_menu" href="content.php?category=Sheet Music">Sheet Music</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php
                     if (!isset($_SESSION['users']) && empty($_SESSION['users'])) {

                        if ($page != 'login') { ?>
                           <a class="link_menu" href="login.php">Login</a>
                        <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'register') { ?>
                        <a class="link_menu" href="register.php">Register</a>
                     <?php }
                     ?>
                  </div>
               <?php } ?>


               <div class="menu__left__inner__item">
                  <?php
                  if (isset($_SESSION['users']) && !empty($_SESSION['users'])) { ?>
                     <a data-barba-prevent class="link_menu" href="./assets/actions/logout_action.php">Logout</a>
               </div>


               <div class="menu__left__inner__item">
                  <?php if ($page != 'my_account') { ?>
                     <a class="link_menu" href="my_account.php">My Account</a>
                  <?php }
                  ?>
               </div>
            <?php } ?>
               </div>

            </div>
         </div>



         <div class="menu__right">
            <div class="menu__right__inner">
               <div class="menu__right__inner__item">


                  <div class="menu__right__inner__item__title">
                     Contact
                  </div>
                  <ul>
                     <li>
                        <a class="link_menu" href="index.php">contact@website.com</a>
                     </li>
                  </ul>
               </div>


               <div class="menu__right__inner__item">
                  <div class="menu__right__inner__item__title">
                     Socials
                  </div>
                  <ul>
                     <li>
                        <a class="link_menu" href="#">Facebook</a>
                     </li>
                     <li>
                        <a class="link_menu" href="#">Instagram</a>
                     </li>
                     <li>
                        <a class="link_menu" href="#">Youtube</a>
                     </li>
                     <li>
                        <a class="link_menu" href="#">Twitter</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>


         <div class="sep"></div>
         <div class="sep__icon"><img class="logo" src="./assets/img/music-g8090509f0_1920.png" alt=""></div>


         </div>
      </nav>
   </header>