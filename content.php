<?php
session_start();
require('./assets/require/check_data.php');


if (
	isset($get_category)
	&& (isset($get_id) xor !isset($check_get_id))
	&& (isset($get_name) xor !isset($check_get_name))
	&& (isset($session_users_id) xor !isset($check_session_users_id))
	&& (isset($post_title) xor !isset($check_post_title))
	&& (isset($post_composer) xor !isset($check_post_composer))
	&& (isset($post_category) xor !isset($check_post_category))
	&& (isset($post_level) xor !isset($check_post_level))
	&& (isset($get_error) xor !isset($check_get_error))
	&& (isset($get_success) xor !isset($check_get_success))
) {



	require('./assets/require/co_bdd.php');
	require('./assets/require/functions.php');


	$page = $get_category;


	if ($page == 'tutorial' || $page == 'performance' || $page == 'sheet_music') {


		$getContents = getContents($bdd, $get_category); ?>


		<?php } else if ($page == 'user_content') {


		if ($get_name == 'visitor') {


			$getIdUserFromContent = getIdUserFromContent($bdd, $get_id);


			require('./assets/require/variables.php');


			if (empty($getIdUserFromContent)) {

				$bdd = null;
				header('location: /Diplome/index.php?error=002159');
				die();
			} ?>


		<?php } else {


			$getIdUserFromContent_author_id = $session_users_id;
		}


		$getContents = getUserContent($bdd, $getIdUserFromContent_author_id);


		if (empty($getContents)) {

			$bdd = null;
			header('location: /Diplome/my_account.php?error=00211');
			die();
		} ?>


	<?php	} else if ($page == 'user_purchased_content') {


		$getContents = getUserPurchasedContent($bdd, $session_users_id);


		if (empty($getContents)) {

			$bdd = null;
			header('location: /Diplome/my_account.php?error=00212');
			die();
		} ?>


		<?php } else if ($page == 'search_results') {


		if (isset($_POST) && !empty($_POST)) {

			if (!isset($post_title)) {
				$post_title = null;
			}

			if (!isset($post_composer)) {
				$post_composer = null;
			}

			if (!isset($post_category)) {
				$post_category = null;
			}

			if (!isset($post_level)) {
				$post_level = null;
			}

			if (!isset($post_price)) {
				$post_price = null;
			}

			$getContents = getSearchResults($bdd, $post_title, $post_composer, $post_category, $post_level, $post_price);


			if (empty($getContents)) {

				$bdd = null;
				header('location: /Diplome/index.php?error=002149');
				die();
			} ?>


		<?php } else {

			$bdd = null;
			header('location: index.php?error=00214');
			die();
		} ?>


	<?php	} else {

		$bdd = null;
		header('location: index.php?error=00213');
		die();
	} ?>


	<?php if (isset($session_users_id) && !empty($session_users_id)) {

		$getUserInformations = getUserInformations($bdd, $session_users_id);

		require('./assets/require/variables.php');
	}


	require('./assets/require/head.php'); ?>


	<main class="autoAlpha" data-barba="wrapper">
		<div class="min-height" data-barba="container" data-barba-namespace="content-section">

			<div class="container">


				<?php foreach ($getContents as $getContent) {

					require('./assets/require/variables.php');

					$getUserContentInformations = getUserContentInformations($bdd, $getContent_id_user);

					require('./assets/require/variables.php');

					require('./assets/require/modals_foreach.php'); ?>


					<div class="box">
						<div class="card">
							<figure class="card__thumb">
								<video class="card_video" src="./assets/videos/<?= $getContent_video ?>" type="video/mp4"></video>


								<figcaption class="card__caption">

									<h2 class="card__title"><?= $getContent_title ?></h2>
									<h2 class="card__composer"><?= $getContent_composer ?></h2>
									<div class="card__likes"><i class="far fa-thumbs-up"> <?= $getContent_likes ?></i></div>
									<div class="card__category"><?= $getContent_category ?></div>
									<p class="card__snippet"></p>


									<?php if (isset($getUserInformations_id) && !empty($getUserInformations_id)) {


										$getIdUserFromPurchasedContent = getIdUserFromPurchasedContent($bdd, $getContent_id);

										$user_session_purchased_content = in_array($getUserInformations_id, array_column($getIdUserFromPurchasedContent, 'id_users'));



										if ($getContent_price == 0 || $getContent_id_user == $getUserInformations_id) {


											if ($getContent_price == 0 && $getContent_id_user != $getUserInformations_id) { ?>


												<div class="card__price">Free</div>


											<?php } else if ($getContent_id_user == $getUserInformations_id) { ?>


												<div class="card__price">Your content</div>


											<?php } ?>

											<div class="content_button_flex">
												<a href="single_player_content.php?id=<?= $getContent_id ?>" class="card__button link_page">Watch</a>
												<a href="content.php?id=<?= $getContent_id ?>&name=visitor&category=user_content" class="card__button link_page">By <?= $getUserContentInformations_name ?> <?= $getUserContentInformations_lastname ?></a>
											</div>


										<?php } else { ?>


											<?php if ($user_session_purchased_content == false) { ?>


												<div class="card__price"><?= $getContent_price ?> Credits</div>

												<div class="content_button_flex">
													<button class="card__button pointer" id="buy_button<?= $getContent_id ?>" onfocus="javascript: modalForeach('buy','<?= $getContent_id ?>')">Buy</button>
													<a href="content.php?id=<?= $getContent_id ?>&name=visitor&category=user_content" class="card__button link_page">By <?= $getUserContentInformations_name ?> <?= $getUserContentInformations_lastname ?></a>
												</div>

											<?php } else if ($user_session_purchased_content == true) { ?>


												<div class="card__price">Purchased</div>

												<div class="content_button_flex">
													<a href="single_player_content.php?id=<?= $getContent_id ?>" class="card__button link_page">Watch</a>
													<a href="content.php?id=<?= $getContent_id ?>&name=visitor&category=user_content" class="card__button link_page">By <?= $getUserContentInformations_name ?> <?= $getUserContentInformations_lastname ?></a>
												</div>

											<?php } ?>


										<?php } ?>


									<?php	} else { ?>


										<?php if ($getContent_price > 0) { ?>


											<div class="card__price"><?= $getContent_price ?> Credits</div>

											<div class="content_button_flex">
												<button class="card__button pointer" id="buy_button<?= $getContent_id ?>" onfocus="javascript: modalForeach('buy','<?= $getContent_id ?>')">Buy</button>
												<a href="content.php?id=<?= $getContent_id ?>&name=visitor&category=user_content" class="card__button link_page">By <?= $getUserContentInformations_name ?> <?= $getUserContentInformations_lastname ?></a>
											</div>

										<?php } else { ?>


											<div class="card__price">Free</div>

											<div class="content_button_flex">
												<a href="single_player_content.php?id=<?= $getContent_id ?>" class="card__button link_page">Watch</a>
												<a href="content.php?id=<?= $getContent_id ?>&name=visitor&category=user_content" class="card__button link_page">By <?= $getUserContentInformations_name ?> <?= $getUserContentInformations_lastname ?></a>
											</div>

										<?php } ?>


									<?php } ?>


								</figcaption>
							</figure>
						</div>
					</div>


				<?php } ?>


			</div>
		</div>
	</main>


	<?php require('./assets/require/foot.php'); ?>


<?php } else {

	$bdd = null;
	http_response_code(400);
	header('location: index.php?error=00215');
	die();
} ?>