<?php
session_start();
require('./assets/require/check_data.php');

if (!isset($session_users_id)) {

	if (
		(isset($get_error) xor !isset($check_get_error))
		&&
		(isset($get_success) xor !isset($check_get_success))
	) {

		$page = 'login';
		require('./assets/require/co_bdd.php');
		require('./assets/require/head.php'); ?>


		<main class="autoAlpha" data-barba="wrapper">
			<div class="min-height" data-barba="container" data-barba-namespace="login-section">

				<div class="form connect">
					<div class="form_content login">

						<div class="rightside">
							<form class="form_action" action="./assets/actions/login_action.php" method="post">

								<label for="login_email"></label>
								<input type="text" placeholder="Email" class="inputbox" id="login_email" name="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required />

								<label for="login_password"></label>
								<input type="password" placeholder="password" class="inputbox" id="login_password" name="password" onkeyup="javascript:input(this,'login_password',41, 'input_password');" minlength="2" required />

								<button type="submit" class="button gray">Login</button>
							</form>
						</div>
					</div>
					<?php require('./assets/require/foot.php'); ?>
				</div>
			</div>
		</main>


	<?php } else {

		http_response_code(400);
		header('location: login.php?error=00315');
		die();
	} ?>


<?php } else {

	header('location: my_account.php?error=00316');
	die();
} ?>