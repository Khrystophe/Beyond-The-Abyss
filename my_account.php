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

								<h2>Email : <span class="email"><?= $get_user_email ?></span></h2>


								<div class="margin"></div>

								<h2>Edit your Name/Lastname</h2>

								<div class="margin"></div>


								<form data-barba-prevent class="form_action" action="./assets/actions/edit_name_lastname_action.php" method="post">

									<label for="my_account_name">Name : ('|a-zA-Zéèêàçù '-| max 10 chars)</label>
									<input type="text" class="inputbox" placeholder="<?= $get_user_name ?>" id="my_account_name" value="<?= $get_user_name ?>" name="name" pattern="^[a-zA-Zéèêàçù '-]+$" maxlength="10" />

									<label for="my_account_lastname">Lastname : (|a-zA-Zéèêàçù '-| max 10 chars)</label>
									<input type="text" class="inputbox" placeholder="<?= $get_user_lastname ?> " id="my_account_lastname" value="<?= $get_user_lastname ?>" name="lastname" pattern="^[a-zA-Zéèêàçù '-]+$" maxlength="10" />

									<button type="submit" class="button">Edit</button>

								</form>


								<div class="margin"></div>

								<h2>Edit your Password</h2>

								<div class="margin"></div>


								<form data-barba-prevent class="form_action" action="./assets/actions/edit_password_action.php" method="post">

									<label for="my_account_old_password">Old Password</label>
									<input type="password" placeholder=" Old password " class="inputbox" id="my_account_old_password" name="old_password" required pattern="^([1-9][0-9])+$" minlength="2" />

									<label for="my_account_new_password">New Password : ('0-9' min 2 chars )</label>
									<input type="password" placeholder=" New password " class="inputbox" id="my_account_new_password" name="new_password" required pattern="^([1-9][0-9])+$" minlength="2" />

									<label for="my_account_new_password_confirm"></label>
									<input type="password" class="inputbox" placeholder="Confirm your new password" id="my_account_new_password_confirm" name="new_password_confirm" required pattern="^([1-9][0-9])+$" minlength="2" />

									<button type="submit" class="button">Edit</button>

								</form>


								<div class="margin"></div>

								<h2>Add Content</h2>

								<div class="margin"></div>


								<form class="form_action" action="./assets/actions/add_content_action.php?type=user" method="post" enctype="multipart/form-data">

									<label for="my_account_title">Title : (|0-9a-zA-Zéèêàçù '!?°-| max 25 chars )</label>
									<input type="text" class="inputbox" placeholder="Title" id="my_account_title" name="title" pattern="^[0-9a-zA-Zéèêàçù '!?°-]+$" maxlength="25" required />

									<label for="my_account_composer">Composer : (|0-9a-zA-Zéèêàçù -| max 25 chars )</label>
									<input type="text" class="inputbox" placeholder="Composer" id="my_account_composer" name="composer" pattern="^[0-9a-zA-Zéèêàçù -]+$" maxlength="25" required />

									<label for="my_account_description">Description : (|\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-| max 250 chars )</label>
									<textarea class="inputbox text" placeholder="Description" id="my_account_description" name="description" pattern="^[\\s0-9a-zA-Zéèêàçù# ()'.!?,;:°-]+$" onkeyup="javascript:MaxLengthDescription(this, 250);" required></textarea>

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

									<label for="my_account_content">Files format : (|0-9a-zA-Zéèêàçù# ()'!,;°-| |.| |webm/mp4/ogv|) and 128 Mo max.</label>
									<input type="file" class="inputbox" id="my_account_content" name="content" onchange="javascript: return validContent('my_account')" required />

									<label for="my_account_price">Price : (from 1 to 500 or free (type 'Free'))</label>
									<input type="text" class="inputbox" id="my_account_price" name="price" placeholder="Price" pattern="^([1-9]|[1-9][0-9]|[1-4][0-9][0-9]|500|Free)$" required />

									<button type="submit" class="button">Add content</button>

								</form>


								<div class="margin"></div>


								<div class="form_action">
									<button class="btn_content"><a class="button link_page" href="content.php?name=user&category=user_content">Your Content</a></button>
								</div>

								<div class="form_action">
									<button class="btn_content"><a class="button link_page" href="content.php?category=user_purchased_content">Purchased Content</a></button>
								</div>

								<div class="form_action">
									<button class="btn_content"><a data-barba-prevent class="button red" href="/Diplome/assets/actions/delete_users_action.php?id=<?= $get_user_id ?>&type=user" onclick="javascript:return deleteAccountAlert()">Delete my account</a></button>
								</div>
							</div>
						</div>
					</div>


					<?php foreach ($getNotifications as $getNotification) {


						require('./assets/require/variables.php'); ?>


						<div class='deck_account'>
							<div class='account_card'>
								<div class='cardHeader'>
									<span class='cardHeader_date'><?= $notification_date ?></span>
								</div>

								<div class='cardBody'>
									<p class='cardText'><?= $notification_text ?></p>
								</div>

								<div class="form_action">
									<button class="btn_content"><a data-barba-prevent class="button link_page" href="/Diplome/assets/actions/delete_notification_action.php?id=<?= $notification_id ?>">Delete</a></button>
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