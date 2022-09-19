<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
	if ($_SESSION['users']['type'] == 'admin') {

		require('./assets/require/co_bdd.php');
		require('./assets/require/functions.php');
		require('./assets/require/head.php');

		$getPurchased_contents = getPurchased_contents($bdd); ?>


		<h1>Purchased contents</h1>

		<table class="table sortable">
			<thead>
				<tr>
					<th scope="col" style="word-break: break-all;">id</th>
					<th scope="col" style="word-break: break-all;">id_contents</th>
					<th scope="col" style="word-break: break-all;">id_users</th>
					<th scope="col" style="word-break: break-all;">Original price</th>
					<th scope="col" style="word-break: break-all;">Buyer repayment</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($getPurchased_contents as $getPurchased_content) {

					require('./assets/require/variables.php'); ?>

					<tr>
						<td scope="col" style="word-break: break-all;"><?= $getPurchased_content_id ?></td>
						<td scope="col" style="word-break: break-all;"><?= $getPurchased_content_id_contents ?></td>
						<td scope="col" style="word-break: break-all;"><?= $getPurchased_content_id_users ?></td>
						<td scope="col" style="word-break: break-all;"><?= $getPurchased_content_original_price ?></td>
						<td scope="col" style="word-break: break-all;"><?= $getPurchased_content_buyer_repayment ?></td>
						<td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_purchased_contents_action.php?id=<?= $getPurchased_content_id ?>"><button class="btn btn-danger">Delete</button></a></td>
					</tr>

				<?php } ?>

			</tbody>
		</table>


<?php

		require('./assets/require/foot.php');
	} else {

		$bdd = null;
		header('location: /Diplome/index.php?error=026140');
		die();
	}
}

?>