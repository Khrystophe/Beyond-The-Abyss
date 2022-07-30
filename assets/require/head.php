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
      <div class="loading-screen"><img class="logo_transition" src="./assets/img/musicgrise.png" alt=""></div>
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
                        <a class="link" href="index.php">Page d'accueil</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'contentTuto') { ?>
                        <a class="link" href="content.php?category=tuto">Tutoriels</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'contentPerf') { ?>
                        <a class="link" href="content.php?category=perf">Performances</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'contentSheet') { ?>
                        <a class="link" href="content.php?category=sheet">Partitions</a>
                     <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php
                     if (!isset($_SESSION['users']) && empty($_SESSION['users'])) {

                        if ($page != 'login') { ?>
                           <a class="link" href="login.php">Connexion</a>
                        <?php } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'register') { ?>
                        <a class="link" href="register.php">S'inscrire</a>
                  <?php }
                     } ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php
                     if (isset($_SESSION['users']) && !empty($_SESSION['users'])) { ?>

                        <a class="link" href="/Diplome/assets/actions/logout_action.php">Déconnexion</a>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'my_account') { ?>
                        <a class="link" href="my_account.php">Mon compte</a>
                     <?php }
                     ?>
                  </div>


                  <div class="menu__left__inner__item">
                     <?php if ($page != 'add_content') { ?>
                        <a class="link" href="add_content.php">Ajouter du contenu</a>
                  <?php }
                     } ?>
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