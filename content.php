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
			$getContents = getUserContent($bdd, $session_users_id);


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
									<p class="card__snippet"></p>


									<?php if (isset($user_session_id) && !empty($user_session_id)) {


										$getIdUserFromPurchasedContent = getIdUserFromPurchasedContent($bdd, $content_id);

										$user_session_purchased_content = in_array($user_session_id, array_column($getIdUserFromPurchasedContent, 'id_users'));



										if ($content_price == 0 || $content_id_user == $user_session_id) {


											if ($content_price == 0 && $content_id_user != $user_session_id) { ?>


												<span class="content_likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price">Free</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>


											<?php } else if ($content_id_user == $user_session_id) { ?>


												<span class="content_likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price">Your content</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>


											<?php } ?>


											<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>


										<?php } else { ?>


											<?php if ($user_session_purchased_content == false) { ?>


												<span class="content_likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price"><?= $content_price ?> Credits</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>
												<div class="card__button pointer" id="buy_button<?= $content_id ?>" onclick="javascript: buy('<?= $content_id ?>')">Buy</div>


											<?php } else if ($user_session_purchased_content == true) { ?>


												<span class="content_likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price">Purchased</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>
												<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>


											<?php } ?>


										<?php } ?>


									<?php	} else { ?>


										<?php if ($content_price > 0) { ?>


											<span class="content_likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></span>
											<div class="content_category"><?= $content_category ?></div>
											<div class="content_price"><?= $content_price ?> Credits</div>
											<div class="content_user name">By <?= $user_content_name ?></div>
											<div class="content_user lastname"><?= $user_content_lastname ?></div>
											<div class="card__button pointer" id="buy_button<?= $content_id ?>" onclick="javascript: buy('<?= $content_id ?>')">Buy</div>


										<?php } else { ?>


											<span class="content_likes"><i class="far fa-thumbs-up"> <?= $content_likes ?></i></span>
											<div class="content_category"><?= $content_category ?></div>
											<div class="content_price">Free</div>
											<div class="content_user name">By <?= $user_content_name ?></div>
											<div class="content_user lastname"><?= $user_content_lastname ?></div>
											<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>


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