<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="./assets/css/style.css" />


</head>

<body>

   <div class="loading-container">
      <div class="loading-screen"><img class="logo_transition" src="./assets/img/musicgrise.png" alt="">
         <div class="transition_circle"></div>
      </div>
   </div>

   <header>

      <nav>

         <div class="toggle">
            <div class="ouvrir"></div>
            <div class="fermer"></div>
         </div>

         <div class="menu">
            <div class="menu__left">
               <div class="menu__left__inner">


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'index') { ?>
                        <a class="link" href="index.php">Home</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'tuto_content') { ?>
                        <a class="link" href="content.php?category=tuto">Tutorials</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'perf_content') { ?>
                        <a class="link" href="content.php?category=perf">Performances</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'sheet_content') { ?>
                        <a class="link" href="content.php?category=sheet">Sheet Music</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php
                     if (!isset($_SESSION['users']) && empty($_SESSION['users'])) {

                        if ($page != 'login') { ?>
                           <a class="link" href="login.php">Login</a>
                        <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'register') { ?>
                        <a class="link" href="register.php">Register</a>
                  <?php }
                     } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php
                     if (isset($_SESSION['users']) && !empty($_SESSION['users'])) { ?>
                        <a data-barba-prevent class="link" href="./assets/actions/logout_action.php">Logout</a>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'my_account') { ?>
                        <a class="link" href="my_account.php">My Account</a>
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
                        <a class="link" href="index.php">contact@website.com</a>
                     </li>
                  </ul>
               </div>


               <div class="menu__right__inner__item">
                  <div class="menu__right__inner__item__title">
                     Socials
                  </div>
                  <ul>
                     <li>
                        <a class="link" href="#">Facebook</a>
                     </li>
                     <li>
                        <a class="link" href="#">Instagram</a>
                     </li>
                     <li>
                        <a class="link" href="#">Youtube</a>
                     </li>
                     <li>
                        <a class="link" href="#">Twitter</a>
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


   <div class="wrapp">
      <div class="col2 hero">
         <div class="miror">

            <?php if ($page == 'index') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Music from the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'tuto_content') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Tutorials from the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'perf_content') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Performances from the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'sheet_content') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Sheet music from the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'user_content') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Your content from the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'user_purchased_content') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Your purchased content from the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'register') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Register to the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'login') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Connect to the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'add_content') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Add content to the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } else if ($page == 'my_account') { ?>
               <h1 class="abyss"><span>Beyond the abyss</span><br>Your account of the depths
                  <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                  <div class="ringOfNotes_circle"></div>
               </h1>
            <?php } ?>
         </div>
      </div>
   </div>

   <div class="separators">
      <div class="separator one"></div>
      <div class="separator two"></div>
      <div class="separator three"></div>
   </div>