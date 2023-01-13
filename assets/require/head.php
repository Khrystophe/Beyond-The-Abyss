<?php
require('page_deco_auto.php');
require('session_regenerate.php');

if (isset($session_users_id)) {

	$getUserSessionInformations = getUserSessionInformations($bdd, $session_users_id);

	require('variables.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Beyond The Abyss</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./assets/scss/style.css" />
</head>

<body>


	<?php
	require('errors_success_modal.php');
	require('modals.php');
	require('search.php'); ?>


	<div class="loading-container">

		<div class="loading-screen">
			<img class="logo_transition" src="./assets/img/musicgrise.png" alt="">
			<div class="transition_circle"></div>
		</div>

	</div>

	<header>

		<nav>

			<a href="#">
				<div class="little_logo scroll_nav">
					<img class="little_main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
					<div class="little_main_logo_disc"></div>
				</div>
			</a>

			<div class="nav_bar scroll_nav">


				<a role="button" tabindex="1" class="nav_search gray" id="search_button" onfocus="javascript:modal('search')"><i class="far fa-search"></i></a>


				<?php if (isset($session_users_id)) { ?>

					<div class="user_nav">
						<div class="name_nav"><?= $getUserSessionInformations_name ?> <?= $getUserSessionInformations_lastname ?></div>
						<div class="credits_nav">Crédits : <?= $getUserSessionInformations_credits ?></div>
					</div>

				<?php } ?>


			</div>

			<div class="toggle scroll_nav">
				<div class="ouvrir"><i class="fas fa-bars"></i></div>
				<div class="fermer"><i class="far fa-minus"></i></div>
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

							<?php if ($page != 'performance') { ?>

								<a class="link_menu" href="content.php?category=performance">Performances</a>

							<?php } ?>

						</div>


						<div class="menu__left__inner__item">

							<?php if ($page != 'tutorial') { ?>

								<a class="link_menu" href="content.php?category=tutorial">Tutorials</a>

							<?php } ?>

						</div>


						<div class="menu__left__inner__item">

							<?php if ($page != 'sheet_music') { ?>

								<a class="link_menu" href="content.php?category=sheet_music">Sheet Music</a>

							<?php } ?>

						</div>


						<?php if (!isset($_SESSION['users']) && empty($_SESSION['users'])) { ?>


							<div class="menu__left__inner__item">

								<?php if ($page != 'login') { ?>

									<a class="link_menu" href="login.php">Login</a>

								<?php } ?>

							</div>


							<div class="menu__left__inner__item">

								<?php if ($page != 'register') { ?>
									<a class="link_menu" href="register.php">Register</a>
								<?php } ?>

							</div>


						<?php } else { ?>


							<div class="menu__left__inner__item">

								<a data-barba-prevent class="link_menu" href="./assets/actions/logout_action.php">Logout</a>

							</div>


							<div class="menu__left__inner__item">

								<?php if ($page != 'my_account') { ?>

									<a class="link_menu" href="my_account.php">My Account</a>

								<?php } ?>

							</div>


						<?php } ?>

						<div class="menu_left_responsive">

							<div class="menu__left__inner__item">
								<div class="menu__left__inner__item__title">Contact</div>

								<ul>
									<li>
										<a role="button" tabindex="1"  class="contact_button" onfocus="javascript:contact()">Administrator</a>
									</li>
									<li>
										<a class="lost_password_button">Lost Password</a>
									</li>
								</ul>

							</div>

							<div class="menu__left__inner__item">
								<div class="menu__left__inner__item__title">Socials</div>

								<ul>

									<li>
										<a href="https://fr-fr.facebook.com/" target="_blank">Facebook</a>
									</li>

									<li>
										<a href="https://www.instagram.com/?hl=fr" target="_blank">Instagram</a>
									</li>

									<li>
										<a href="https://www.youtube.com/" target="_blank">Youtube</a>
									</li>

									<li>
										<a href="https://twitter.com/?lang=fr" target="_blank">Twitter</a>
									</li>

								</ul>

							</div>


						</div>

					</div>
				</div>


				<div class="menu__right">
					<div class="menu__right__inner">

						<div class="menu__right__inner__item">
							<div class="menu__right__inner__item__title">Contact</div>

							<ul>
								<li>
									<a role="button" tabindex="1"  class="contact_button" onfocus="javascript:contact()">Administrator</a>
								</li>
								<li>
									<a class="lost_password_button">Lost Password</a>
								</li>
							</ul>

						</div>


						<div class="menu__right__inner__item">
							<div class="menu__right__inner__item__title">Socials</div>

							<ul>

								<li>
									<a href="https://fr-fr.facebook.com/" target="_blank">Facebook</a>
								</li>

								<li>
									<a href="https://www.instagram.com/?hl=fr" target="_blank">Instagram</a>
								</li>

								<li>
									<a href="https://www.youtube.com/" target="_blank">Youtube</a>
								</li>

								<li>
									<a href="https://twitter.com/?lang=fr" target="_blank">Twitter</a>
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