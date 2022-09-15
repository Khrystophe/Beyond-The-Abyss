<?php
session_start();
require('./assets/require/check_data.php');


if (
	isset($get_category)
	&& (isset($session_users_id) xor !isset($session_users_id))
	&& (isset($post_title) xor !isset($post_title))
	&& (isset($post_composer) xor !isset($post_composer))
	&& (isset($post_category) xor !isset($post_category))
	&& (isset($post_level) xor !isset($post_level))
) {

	if (
		(isset($get_error) xor !isset($check_get_error))
		&&
		(isset($get_success) xor !isset($check_get_success))
	) {

		require('./assets/require/co_bdd.php');
		require('./assets/require/functions.php');

		if ($get_category != 'search_results') {


			if ($get_category == 'tutorial') {

				$page = 'tuto_content';
				$getContents = getContents($bdd, $get_category); ?>


			<?php } else if ($get_category == 'performance') {

				$page = 'perf_content';
				$getContents = getContents($bdd, $get_category); ?>


			<?php } else if ($get_category == 'sheet_music') {

				$page = 'sheet_content';
				$getContents = getContents($bdd, $get_category); ?>


			<?php } else if ($get_category == 'user_content') {

				$page = 'user_content';
				$getContents = getUserContent($bdd, $get_id);


				if (empty($getContents)) {

					$bdd = null;
					header('location: /Diplome/my_account.php?error=00211');
					die();
				} ?>


			<?php	} else if ($get_category == 'user_purchased_content') {

				$page = 'user_purchased_content';
				$getContents = getUserPurchasedContent($bdd, $session_users_id);


				if (empty($getContents)) {

					$bdd = null;
					header('location: /Diplome/my_account.php?error=00212');
					die();
				} ?>


			<?php	} else {

				$bdd = null;
				header('location: index.php?error=00213');
				die();
			} ?>


		<?php	} else { ?>


			<?php if (isset($_POST) && !empty($_POST)) {

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

				$page = 'search_results';
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

		<?php } ?>


		<?php if (isset($session_users_id) && !empty($session_users_id)) {

			$getUserInformations = getUserInformations($bdd, $session_users_id);

			require('./assets/require/variables.php');
		}


		require('./assets/require/head.php'); ?>


		<main class="autoAlpha" data-barba="wrapper">
			<div class="min-height" data-barba="container" data-barba-namespace="content-section">

				<div class="container">


					<?php foreach ($getContents as $getContentOfPageContent) {

						require('./assets/require/variables.php');

						$getUserContentInformations = getUserContentInformations($bdd, $content_id_user);

						require('./assets/require/variables.php');

						require('./assets/require/modals_foreach.php'); ?>


						<div class="box">
							<div class="card">
								<figure class="card__thumb">
									<video class="card_video" src="./assets/videos/<?= $content_video ?>" type="video/mp4"></video>


									<figcaption class="card__caption">

										<h2 class="card__title"><?= $content_title ?></h2>
										<h2 class="card__composer"><?= $content_composer ?></h2>
										<div class="card__likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></div>
										<div class="card__category"><?= $content_category ?></div>
										<p class="card__snippet"></p>


										<?php if (isset($user_session_id) && !empty($user_session_id)) {


											$getIdUserFromPurchasedContent = getIdUserFromPurchasedContent($bdd, $content_id);

											$user_session_purchased_content = in_array($user_session_id, array_column($getIdUserFromPurchasedContent, 'id_users'));



											if ($content_price == 0 || $content_id_user == $user_session_id) {


												if ($content_price == 0 && $content_id_user != $user_session_id) { ?>


													<div class="card__price">Free</div>


												<?php } else if ($content_id_user == $user_session_id) { ?>


													<div class="card__price">Your content</div>


												<?php } ?>

												<div class="content_button_flex">
													<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>
													<a href="content.php?id=<?= $content_id_user ?>&category=user_content" class="card__button link_page">By <?= $user_content_name ?> <?= $user_content_lastname ?></a>
												</div>


											<?php } else { ?>


												<?php if ($user_session_purchased_content == false) { ?>


													<div class="card__price"><?= $content_price ?> Credits</div>

													<div class="content_button_flex">
														<div class="card__button pointer" id="buy_button<?= $content_id ?>" onclick="javascript: buy('<?= $content_id ?>')">Buy</div>
														<a href="content.php?id=<?= $content_id_user ?>&category=user_content" class="card__button link_page">By <?= $user_content_name ?> <?= $user_content_lastname ?></a>
													</div>

												<?php } else if ($user_session_purchased_content == true) { ?>


													<div class="card__price">Purchased</div>

													<div class="content_button_flex">
														<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>
														<a href="content.php?id=<?= $content_id_user ?>&category=user_content" class="card__button link_page">By <?= $user_content_name ?> <?= $user_content_lastname ?></a>
													</div>

												<?php } ?>


											<?php } ?>


										<?php	} else { ?>


											<?php if ($content_price > 0) { ?>


												<div class="card__price"><?= $content_price ?> Credits</div>

												<div class="content_button_flex">
													<div class="card__button pointer" id="buy_button<?= $content_id ?>" onclick="javascript: buy('<?= $content_id ?>')">Buy</div>
													<a href="content.php?id=<?= $content_id_user ?>&category=user_content" class="card__button link_page">By <?= $user_content_name ?> <?= $user_content_lastname ?></a>
												</div>

											<?php } else { ?>


												<div class="card__price">Free</div>

												<div class="content_button_flex">
													<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>
													<a href="content.php?id=<?= $content_id_user ?>&category=user_content" class="card__button link_page">By <?= $user_content_name ?> <?= $user_content_lastname ?></a>
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


<?php } else {

	$bdd = null;
	http_response_code(400);
	header('location: index.php?error=002150');
	die();
} ?>