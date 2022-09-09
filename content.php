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
			$contents = getContents($bdd, $get_category);
		} else if ($get_category == 'performance') {

			$page = 'perf_content';
			$contents = getContents($bdd, $get_category);
		} else if ($get_category == 'sheet_music') {

			$page = 'sheet_content';
			$contents = getContents($bdd, $get_category);
		} else if ($get_category == 'user_content') {

			$page = 'user_content';
			$contents = getUserContent($bdd, $session_users_id);

			if (empty($contents)) {

				$bdd = null;
				header('location: /Diplome/my_account.php?error=00211');
				die();
			}
		} else if ($get_category == 'user_purchased_content') {

			$page = 'user_purchased_content';
			$contents = getUserPurchasedContent($bdd, $session_users_id);

			if (empty($contents)) {

				$bdd = null;
				header('location: /Diplome/my_account.php?error=00212');
				die();
			}
		} else {

			$bdd = null;
			header('location: index.php?error=00213');
			die();
		}
	} else {

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

			$page = 'search_results';
			$contents = getSearchResults($bdd, $post_title, $post_composer, $post_category, $post_level);

			if (empty($contents)) {

				$bdd = null;
				header('location: /Diplome/index.php?error=002149');
				die();
			}
		} else {

			$bdd = null;
			header('location: index.php?error=00214');
			die();
		}
	}

	if (isset($session_users_id) && !empty($session_users_id)) {

		$user_session = getUserInformations($bdd, $session_users_id);

		$user_session_id = htmlspecialchars($user_session['id']);
		$user_session_credits = htmlspecialchars($user_session['credits']);
	}

	require('./assets/require/head.php'); ?>


	<main class="autoAlpha" data-barba="wrapper">
		<div class="min-height" data-barba="container" data-barba-namespace="content-section">

			<div class="container">


				<?php foreach ($contents as $content) {

					$content_id = htmlspecialchars($content['id']);
					$content_title = htmlspecialchars($content['title']);
					$content_composer = htmlspecialchars($content['composer']);
					$content_category = htmlspecialchars($content['category']);
					$content_level = htmlspecialchars($content['level']);
					$content_video = htmlspecialchars($content['content']);
					$content_price = htmlspecialchars($content['price']);
					$content_description = htmlspecialchars($content['description']);
					$content_likes = htmlspecialchars($content['likes']);
					$content_id_user = htmlspecialchars($content['id_users']);

					if ($content_category == 'tutorial') {
						$content_category = 'Tutorial';
					} else if ($content_category == 'performance') {
						$content_category = 'Performance';
					} else if ($content_category == 'sheet_music') {
						$content_category = 'Sheet Music';
					}

					$user_content_information = getUserContentInformations($bdd, $content_id_user);

					$user_content_id = htmlspecialchars($user_content_information['id']);
					$user_content_name = htmlspecialchars($user_content_information['name']);
					$user_content_lastname = htmlspecialchars($user_content_information['lastname']); ?>


					<div id="buy_modal<?= $content_id ?>" class="modal messages">
						<div class="modal-content">
							<div class="modal_form">
								<div class="modal_form_content">

									<form class="form_action" action="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" method="post">

										<div class="messages_logo">
											<img src="./assets/img/musicgrise.png" alt="" />
										</div>


										<?php if (isset($session_users_id)) {


											$message = 'You have ' . $user_session_credits . ' credits.
											Do you want to buy' . $content_title . ' of ' . $content_composer . ' for ' . $content_price . ' credits ?'; ?>


											<div><?= nl2br($message) ?></div>
											<button type="submit" class="button red">Buy</button>
											<div class="button" id="buy_close<?= $content_id ?>">Close</div>


										<?php } else { ?>


											<div>You are not connected.<br>Log in or register.<br>You will get 50 credits.</div>
											<div class="button" id="buy_close<?= $content_id ?>">Close</div>


										<?php } ?>


									</form>
								</div>
							</div>
						</div>
					</div>


					<div class="box">
						<div class="card">
							<figure class="card__thumb">
								<video class="card_video" src="./assets/videos/<?= $content_video ?>" type="video/mp4">
								</video>

								<figcaption class="card__caption">
									<h2 class="card__title"><?= $content_composer ?></h2>
									<h2 class="card__title"><?= $content_title ?></h2>
									<p class="card__snippet" style="word-break: break-all ;"><?= $content_description ?></p>


									<?php if (isset($user_session) && !empty($user_session)) {


										$user_purchased_contents = getIdUserFromPurchasedContent($bdd, $content_id);
										$user_session_purchased_content = in_array($user_session_id, array_column($user_purchased_contents, 'id_users'));


										if ($content_price == 0 || $content_id_user == $user_session_id) {

											if ($content_price == 0 && $content_id_user != $user_session_id) { ?>


												<span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price">Free</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>


											<?php } else if ($content_id_user == $user_session_id) { ?>


												<span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price">Your content</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>


											<?php } ?>


											<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>


											<?php } else {


											if ($user_session_purchased_content == false) { ?>


												<span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price"><?= $content_price ?> Credits</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>
												<div class="card__button pointer" id="buy_button<?= $content_id ?>" onclick="javascript: buy('<?= $content_id ?>')">Buy</div>


											<?php } else if ($user_session_purchased_content == true) { ?>


												<span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
												<div class="content_category"><?= $content_category ?></div>
												<div class="content_price">Purchased</div>
												<div class="content_user name">By <?= $user_content_name ?></div>
												<div class="content_user lastname"><?= $user_content_lastname ?></div>
												<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>


											<?php }
										}
									} else {


										if ($content_price > 0) { ?>


											<span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
											<div class="content_category"><?= $content_category ?></div>
											<div class="content_price"><?= $content_price ?> Credits</div>
											<div class="content_user name">By <?= $user_content_name ?></div>
											<div class="content_user lastname"><?= $user_content_lastname ?></div>
											<div class="card__button pointer" id="buy_button<?= $content_id ?>" onclick="javascript: buy('<?= $content_id ?>')">Buy</div>


										<?php } else { ?>


											<span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
											<div class="content_category"><?= $content_category ?></div>
											<div class="content_price">Free</div>
											<div class="content_user name">By <?= $user_content_name ?></div>
											<div class="content_user lastname"><?= $user_content_lastname ?></div>
											<a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>


									<?php }
									} ?>


								</figcaption>
							</figure>
						</div>
					</div>


				<?php } ?>


			</div>
		</div>
	</main>

<?php require('./assets/require/foot.php');
} else {

	$bdd = null;
	http_response_code(400);
	header('location: index.php?error=00215');
	die();
} ?>