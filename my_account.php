<?php
session_start();
if (!empty($_COOKIE["PHPSESSID"])) {
	require('./assets/require/check_data.php');

	if (isset($session_users_id)) {


		if (
			(isset($get_error) xor !isset($check_get_error))
			&&
			(isset($get_success) xor !isset($check_get_success))
		) {

			$page = 'my_account';
			require('./assets/require/co_bdd.php');
			require('./assets/require/functions.php');
			require('./assets/require/head.php');

			$getUserInformations = getUserInformations($bdd, $session_users_id);

			require('./assets/require/variables.php');

			$getNotifications = getNotifications($bdd, $session_users_id); ?>


			<main class="autoAlpha" data-barba="wrapper">
				<div class="min-height" data-barba="container" data-barba-namespace="my_account-section">

					<div class="form">
						<div class="form_content">

							<div class="rightside">

								<h2 type="text" class="form_title"><?= $get_user_email ?></h2>


								<div class="margin"></div>


								<form data-barba-prevent class="form_action" action="./assets/actions/edit_name_lastname_action.php" method="post">

									<label for="my_account_name"></label>
									<input type="text" class="inputbox" placeholder="<?= $get_user_name ?>" id="my_account_name" value="<?= $get_user_name ?>" name="name" />

									<label for="my_account_lastname"></label>
									<input type="text" class="inputbox" placeholder="<?= $get_user_lastname ?> " id="my_account_lastname" value="<?= $get_user_lastname ?>" name="lastname" />

									<button type="submit" class="button">Edit</button>

								</form>


								<div class="margin"></div>


								<form data-barba-prevent class="form_action" action="./assets/actions/edit_password_action.php" method="post">

									<label for="my_account_old_password"></label>
									<input type="password" placeholder=" Old password " class="inputbox" id="my_account_old_password" name="old_password" required pattern="^([1-9][0-9])+$" minlength="2" />

									<label for="my_account_new_password"></label>
									<input type="password" placeholder=" New password " class="inputbox" id="my_account_new_password" name="new_password" required pattern="^([1-9][0-9])+$" minlength="2" />

									<label for="my_account_new_password_confirm"></label>
									<input type="password" class="inputbox" placeholder="Confirm your new password" id="my_account_new_password_confirm" name="new_password_confirm" required pattern="^([1-9][0-9])+$" minlength="2" />

									<button type="submit" class="button">Edit</button>

								</form>


								<div class="margin"></div>


								<h2 type="text" class="form_title">Add Content</h2>


								<div class="margin"></div>


								<form class="form_action" action="./assets/actions/add_content_action.php?type=user" method="post" enctype="multipart/form-data">

									<label for="my_account_title"></label>
									<input type="text" class="inputbox" placeholder="Title" id="my_account_title" name="title" required />

									<label for="my_account_composer"></label>
									<input type="text" class="inputbox" placeholder="Composer" id="my_account_composer" name="composer" required />

									<label for="my_account_description"></label>
									<textarea class="inputbox" placeholder="Description" id="my_account_description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>

									<label for="my_account_category"></label>
									<select class="inputbox" id="my_account_category" name="category" required>
										<option value="">--Category--</option>
										<option value="tutorial">Tutorial</option>
										<option value="performance">Performances</option>
										<option value="sheet_music">Sheet Music</option>
									</select>

									<label for="my_account_level"></label>
									<select class="inputbox" id="my_account_level" name="level" required>
										<option value="">--Level--</option>
										<option value="easy">Easy</option>
										<option value="medium">Medium</option>
										<option value="hard">Hard</option>
										<option value="very-hard">Very Hard</option>
									</select>

									<label for="my_account_content"></label>
									<input type="file" class="inputbox" id="my_account_content" name="content" onchange="javascript: return validContent('my_account')" required />

									<label for="my_account_price">Price : from 1 to 50 or free (type 'Free')</label>
									<input type="text" class="inputbox" id="my_account_price" name="price" placeholder="Price" pattern="^([1-9]|[1-4][0-9]|50|Free)$" required />

									<button type="submit" class="button">Add Content</button>

								</form>


								<div class="margin"></div>


								<div class="form_action">
									<button class="btn_content"><a class="button link_page" href="content.php?category=user_content">Your content</a></button>
								</div>

								<div class="form_action">
									<button class="btn_content"><a class="button link_page" href="content.php?category=user_purchased_content">Your purchased content</a></button>
								</div>

								<div class="form_action">
									<button class="btn_content"><a data-barba-prevent class="button red" href="/Diplome/assets/actions/delete_users_action.php?id=<?= $get_user_id ?>&type=user" onclick="javascript:return deleteAccountAlert()">Delete my account</a></button>
								</div>
							</div>
						</div>
					</div>


					<?php foreach ($getNotifications as $getNotification) {


						require('./assets/require/variables.php'); ?>


						<div class='deck'>
							<div class='single_player_card'>
								<div class='cardHeader'>
									<span class='cardHeader_date'><?= $notification_date ?></span>
								</div>

								<div class='cardBody'>
									<p class='cardText'><?= $notification_text ?></p>
								</div>

								<div class="form_action">
									<button class="btn_content"><a data-barba-prevent class="button link_page" href="/Diplome/assets/actions/delete_notification_action.php?id=<?= $notification_id ?>">Delete notification</a></button>
								</div>
							</div>
						</div>


					<?php } ?>


				</div>
			</main>

			<?php require('./assets/require/foot.php'); ?>


		<?php } else {

			http_response_code(400);
			header('location: index.php?error=00515');
			die();
		} ?>


	<?php } else {

		http_response_code(400);
		header('location: index.php?error=00518');
		die();
	} ?>


<?php } else {

	unset($_SESSION['users']);
	session_destroy();
	header('Location: index.php?error=00517');
	die();
} ?>