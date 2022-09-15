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
		require('./assets/require/head.php'); ?>


		<main class="autoAlpha" data-barba="wrapper">
			<div class="min-height" data-barba="container" data-barba-namespace="register-section">

				<div class="form connect">
					<div class="form_content register">

						<div class="rightside">
							<form class="form_action" action="./assets/actions/register_action.php" method="post" enctype="multipart/form-data">

								<label for="register_name">Name : (|a-zA-Zéèêàçù '-| max 10 chars)</label>
								<input type="text" class="inputbox" placeholder="Name" id="register_name" name="name" required pattern="^[a-zA-Zéèêàçù '-]+$" maxlength="10" />

								<label for="register_lastname">Lastname : (|a-zA-Zéèêàçù '-| max 10 chars)</label>
								<input type="text" class="inputbox" placeholder="Lastname" id="register_lastname" name="lastname" required pattern="^[a-zA-Zéèêàçù '-]+$" maxlength="10" />

								<label for=" register_email">Email (Valid email)</label>
								<input type="text" class="inputbox" placeholder="Email" id="register_email" name="email" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" />

								<label for="register_password">Password : ('0-9' min 2 chars )</label>
								<input type="password" class="inputbox" placeholder="Password" id="register_password" name="password" required pattern="^([1-9][0-9])+$" minlength="2" />

								<label for="register_password_confirm"></label>
								<input type="password" class="inputbox" placeholder="Confirm your password" id="register_password_confirm" name="password_confirm" required pattern="^([1-9][0-9])+$" minlength="2" />

								<button type="submit" class="button">Register</button>
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