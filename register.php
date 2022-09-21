<?php
session_start();
require('./assets/require/check_data.php');

if (!isset($session_users_id)) {


	if (
		(isset($get_error) xor !isset($check_get_error))
		&&
		(isset($get_success) xor !isset($check_get_success))
	) {

		$page = "register";
		require('./assets/require/co_bdd.php');
		require('./assets/require/head.php'); ?>


		<main class="autoAlpha" data-barba="wrapper">
			<div class="min-height" data-barba="container" data-barba-namespace="register-section">

				<div class="form connect">
					<div class="form_content register">

						<div class="rightside">
							<form class="form_action" action="./assets/actions/register_action.php" method="post" enctype="multipart/form-data">

								<label for="register_name"></label>
								<input type="text" class="inputbox" placeholder="Name (max 10 chars)" id="register_name" name="name" onkeyup="javascript:input(this,'register_name',11,'input_name_lastname');" required />

								<label for="register_lastname"></label>
								<input type="text" class="inputbox" placeholder="Lastname (max 10 chars)" id="register_lastname" name="lastname" onkeyup="javascript:input(this,'register_lastname',11, 'input_name_lastname');" required />

								<label for=" register_email"></label>
								<input type="text" class="inputbox" placeholder="Valid Email" id="register_email" name="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required />

								<label for="register_password"></label>
								<input type="password" class="inputbox" placeholder="Password (min 2 max 40 chars)" id="register_password" name="password" onkeyup="javascript:input(this,'register_password',41, 'input_password');" minlength="2" required />

								<label for="register_password_confirm"></label>
								<input type="password" class="inputbox" placeholder="Confirm your password" id="register_password_confirm" name="password_confirm" onkeyup="javascript:input(this,'register_password_confirm',41, 'input_password');" minlength="2" required />

								<button type="submit" class="button green">Register</button>
							</form>
						</div>
					</div>
					<?php require('./assets/require/foot.php'); ?>
				</div>
			</div>
		</main>


	<?php	} else {

		http_response_code(400);
		header('location: register.php?error=00415');
		die();
	} ?>


<?php } else {

	header('location: my_account.php?error=00416');
	die();
}
?>