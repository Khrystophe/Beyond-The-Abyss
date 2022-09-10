<?php
session_start();
require('./assets/require/check_data.php');

if (!isset($session_users_id)) {


	if (isset($get_error) xor !isset($check_get_error)) {

		$page = "register";
		require('./assets/require/head.php'); ?>


		<main class="autoAlpha" data-barba="wrapper">
			<div class="min-height" data-barba="container" data-barba-namespace="register-section">

				<div class="form">
					<div class="form_content">

						<div class="leftside">
							<img src="./assets/img/musicgrise.png" alt="" />
						</div>

						<div class="rightside">
							<form class="form_action" action="./assets/actions/register_action.php" method="post" enctype="multipart/form-data">

								<label for="register_name"></label>
								<input type="text" class="inputbox" placeholder="Name ('min/maj/space/-' max 20 chars)" id="register_name" name="name" required pattern="^[A-Za-z '-]+$" maxlength="20" />

								<label for="register_lastname"></label>
								<input type="text" class="inputbox" placeholder="Lastname ('min/maj/space/-' max 20 chars)" id="register_lastname" name="lastname" required pattern="^[A-Za-z '-]+$" maxlength="20" />

								<label for=" register_email"></label>
								<input type="text" class="inputbox" placeholder="Email (valid email)" id="register_email" name="email" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" />

								<label for="register_password"></label>
								<input type="password" class="inputbox" placeholder="Password ('0-9' min 1 chars )" id="register_password" name="password" required pattern="^([1-9][0-9])+$" minlength="2" />

								<label for="register_password_confirm"></label>
								<input type="password" class="inputbox" placeholder="Confirm your password" id="register_password_confirm" name="password_confirm" required pattern="^([1-9][0-9])+$" minlength="2" />

								<button type="submit" class="button">Register</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</main>

		<?php require('./assets/require/foot.php'); ?>

	<?php	} else {

		http_response_code(400);
		header('location: index.php?error=00415');
		die();
	} ?>

<?php } else {

	header('location: my_account.php?error=00416');
	die();
}
?>