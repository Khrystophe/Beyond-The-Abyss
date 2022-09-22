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

								<h2>Email : <span class="email"><?= $getUserInformations_email ?></span></h2>


								<div class="margin"></div>

								<div class="fold_unfold_name_lastname" onclick="javascript:foldUnfold('name_lastname','show_name_lastname')">
									<h2>Edit your Name/Lastname</h2>
									<span class="fold name_lastname"><i class="fas fa-arrow-square-up"></i></span>
									<span class="unfold name_lastname"><i class="fas fa-arrow-square-down"></i></span>
								</div>

								<div class="margin"></div>



								<form id="show_name_lastname" data-barba-prevent class="form_action foldable" action="./assets/actions/edit_name_lastname_action.php" method="post">

									<label for="my_account_name"></label>
									<input type="text" class="inputbox" placeholder="<?= $getUserInformations_name ?>" id="my_account_name" value="<?= $getUserInformations_name ?>" name="name" onkeyup="javascript:input(this,'my_account_name',11,'input_name_lastname');" />

									<label for="my_account_lastname"></label>
									<input type="text" class="inputbox" placeholder="<?= $getUserInformations_lastname ?> " id="my_account_lastname" value="<?= $getUserInformations_lastname ?>" name="lastname" onkeyup="javascript:input(this,'my_account_lastname',11,'input_name_lastname');" />

									<button type="submit" class="button orange">Edit</button>

								</form>


								<div class="margin"></div>

								<div class="fold_unfold_password" onclick="javascript:foldUnfold('password','show_password')">
									<h2>Edit your Password</h2>
									<span class="fold password"><i class="fas fa-arrow-square-up"></i></span>
									<span class="unfold password"><i class="fas fa-arrow-square-down"></i></span>
								</div>

								<div class="margin"></div>


								<form id="show_password" data-barba-prevent class="form_action" action="./assets/actions/edit_password_action.php" method="post">

									<label for="my_account_old_password"></label>
									<input type="password" placeholder=" Old password " class="inputbox" id="my_account_old_password" name="old_password" onkeyup="javascript:input(this,'my_account_old_password',41, 'input_password');" minlength="2" required />

									<label for="my_account_new_password"></label>
									<input type="password" placeholder=" New password " class="inputbox" id="my_account_new_password" name="new_password" onkeyup="javascript:input(this,'my_account_new_password',41, 'input_password');" minlength="2" required />

									<label for="my_account_new_password_confirm"></label>
									<input type="password" class="inputbox" placeholder="Confirm your new password" id="my_account_new_password_confirm" name="new_password_confirm" onkeyup="javascript:input(this,'my_account_new_password_confirm',41, 'input_password');" minlength="2" required />

									<button type="submit" class="button orange">Edit</button>

								</form>


								<div class="margin"></div>

								<div class="fold_unfold_add_content" onclick="javascript:foldUnfold('add_content','show_add_content')">
									<h2>Add Content</h2>
									<span class="fold add_content"><i class="fas fa-arrow-square-up"></i></span>
									<span class="unfold add_content"><i class="fas fa-arrow-square-down"></i></span>
								</div>

								<div class="margin"></div>


								<form id="show_add_content" class="form_action" action="./assets/actions/add_content_action.php?type=user" method="post" enctype="multipart/form-data">

									<label for="my_account_title"></label>
									<input type="text" class="inputbox" placeholder="Title (max 20 chars)" id="my_account_title" name="title" onkeyup="javascript:input(this,'my_account_title',21, 'input_title');" required />

									<label for="my_account_composer"></label>
									<input type="text" class="inputbox" placeholder="Composer (max 20 chars)" id="my_account_composer" name="composer" onkeyup="javascript:input(this,'my_account_composer',21, 'input_composer');" required />

									<label for="my_account_description"></label>
									<textarea class="inputbox text" placeholder="Description (max 250 chars)" id="my_account_description" name="description" onkeyup="javascript:input(this,'my_account_description',251, 'input_description');" required></textarea>

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

									<label for="my_account_content">Files format : webm/mp4/ogv 128 Mo max.</label>
									<input type="file" class="inputbox" id="my_account_content" name="content" onchange="javascript:validContent('my_account')" required />

									<label for="my_account_price">Price : (from 1 to 500 or free (type 'Free'))</label>
									<input type="text" class="inputbox" id="my_account_price" name="price" placeholder="Price" onkeyup="javascript:input(this,'my_account_price',5, 'input_price');" required />

									<button type="submit" class="button green">Add Content</button>

								</form>


								<div class="margin"></div>


								<div class="form_action">
									<button class="btn_content"><a class="button green link_page" href="content.php?name=user&category=user_content">Your Content</a></button>
								</div>

								<div class="form_action">
									<button class="btn_content"><a class="button green link_page" href="content.php?category=user_purchased_content">Purchased Content</a></button>
								</div>

								<div class="form_action">
									<button class="button red" id="delete_users_button" onfocus="javascript:modal('delete_users')">Delete my account</button>
								</div>
							</div>
						</div>
					</div>


					<?php foreach ($getNotifications as $getNotification) {


						require('./assets/require/variables.php');

						require('./assets/require/modals_foreach.php'); ?>


						<div class='deck_account'>
							<div class='account_card'>
								<div class='cardHeader'>
									<span class='cardHeader_date'><?= $getNotification_date ?></span>
								</div>

								<div class='cardBody'>
									<p class='cardText'><?= $getNotification_text ?></p>
								</div>

								<div class="form_action">
									<button class="btn_content button red" id="delete_notification_button<?= $getNotification_id ?>" onfocus="javascript:modalForeach('delete_notification','<?= $getNotification_id ?>')">Delete</button>
								</div>
							</div>
						</div>


					<?php } ?>


				</div>
			</main>

			<?php require('./assets/require/foot.php'); ?>


		<?php } else {

			http_response_code(400);
			header('location: my_account.php?error=00515');
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