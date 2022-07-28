<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arapey&family=Inria+Serif&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700">
  <link rel="stylesheet" href="./assets/css/style.css" />


</head>

<body>
  <div class="loading-container">
    <div class="loading-screen"><img class="logo_transition" src="./assets/img/musicgrise.png" alt=""></div>
  </div>
  <header>
    <nav>
      <div class="toggle">
        <i class="fas fa-bars ouvrir"></i>
        <i class="fas fa-times fermer"></i>
      </div>

      <div class="menu">
        <div class="menu__left">
          <div class="menu__left__inner">
            <div class="menu__left__inner__item">
              <?php if ($page != 'index') { ?>
                <a class="link" href="index.php">Page d'accueil<span class="menu__left__inner__item__small">#</span></a>
              <?php } ?>
            </div>
            <div class="menu__left__inner__item">
              <?php if ($page != 'contentTuto') { ?>
                <a class="link" href="content.php?category=tuto">Tutoriels<span class="menu__left__inner__item__small">#</span></a>
              <?php } ?>
            </div>
            <div class="menu__left__inner__item">
              <?php if ($page != 'contentPerf') { ?>
                <a class="link" href="content.php?category=perf">Performances<span class="menu__left__inner__item__small">#</span></a>
              <?php } ?>
            </div>
            <div class="menu__left__inner__item">
              <?php if ($page != 'contentSheet') { ?>
                <a class="link" href="content.php?category=sheet">Partitions<span class="menu__left__inner__item__small">#</span></a>
              <?php } ?>
            </div>
            <div class="menu__left__inner__item">
              <?php
              if (!isset($_SESSION['users']) && empty($_SESSION['users'])) {
                if ($page != 'login') { ?>
                  <a class="link" href="login.php">Connexion<span class="menu__left__inner__item__small">#</span></a>
                <?php } ?>
            </div>
            <div class="menu__left__inner__item">
              <?php if ($page != 'register') { ?>
                <a class="link" href="register.php">S'inscrire<span class="menu__left__inner__item__small">#</span></a>
            <?php }
              } ?>
            </div>
            <div class="menu__left__inner__item">
              <?php
              if (isset($_SESSION['users']) && !empty($_SESSION['users'])) { ?>
                <a class="link" href="/Diplome/assets/actions/logout_action.php">Déconnexion<span class="menu__left__inner__item__small">#</span></a>
            </div>
            <div class="menu__left__inner__item">
              <?php if ($page != 'my_account') { ?>
                <a class="link" href="my_account.php">Mon compte<span class="menu__left__inner__item__small">#</span></a>
              <?php }
              ?>
            </div>
            <div class="menu__left__inner__item">
              <?php if ($page != 'add_content') { ?>
                <a class="link" href="add_content.php">Ajouter du contenu<span class="menu__left__inner__item__small">#</span></a>
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
                  <a class="link" href="mailto:contact@website.com">contact@website.com</a>
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