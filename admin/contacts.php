<?php
session_start();
require('./assets/require/check_data.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
	if ($_SESSION['users']['type'] == 'admin') {

		require('./assets/require/co_bdd.php');
		require('./assets/require/functions.php');
		require('./assets/require/head.php');

		$getContacts = getContact($bdd); ?>


		<h1>contact</h1>

		<table class="table sortable">
			<thead>
				<tr>
					<th scope="col" style="word-break: break-all;">id</th>
					<th scope="col" style="word-break: break-all;">Date</th>
					<th scope="col" style="word-break: break-all;">id_users</th>
				</tr>
			</thead>

			<tbody>

				<?php

				foreach ($getContacts as $getContact) {

					require('./assets/require/variables.php');

					$getUserInformations = getUserInformations($bdd, $getContact_id_users);

					require('./assets/require/variables.php'); ?>


					<tr>
						<td scope="col" style="word-break: break-all;"><?= $getContact_id ?></td>
						<td scope="col" style="word-break: break-all;"><?= $getContact_date ?></td>
						<td scope="col" style="word-break: break-all;"><?= $getContact_id_users ?></td>

						<td scope="col" style="word-break: break-all;">

							<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $getContact_id ?>">
								Reply
							</button>

							<div class="modal fade" id="user_editModal<?= $getContact_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">

											<h5 class="modal-title" id="exampleModalLabel">Reply</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>

										<div class="modal-body">
											<form method="post" action="./assets/actions/reply_action.php?id=<?= $getContact_id ?>" enctype="multipart/form-data">

												<div class="mb-3">
													<label for="admin_contact_id_user<?= $getContact_id ?>" class="form-label">User id</label>
													<input type="hidden" class="form-control" id="admin_contact_id_user<?= $getContact_id ?>" name="id" value="<?= $getContact_id_users ?>">

													<div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $getContact_id_users ?></div>
												</div>

												<div class="mb-3">
													<label for="admin_contact_name<?= $getContact_id ?> class=" form-label">Name/Lastname</label>
													<input type="hidden" class="form-control" id="admin_contact_name<?= $getContact_id ?>" name="name" value="<?= $getUserInformations_name ?>">

													<label for="admin_contact_lastname<?= $getContact_id ?> class=" form-label"></label>
													<input type="hidden" class="form-control" id="admin_contact_lastname<?= $getContact_id ?>" name="lastname" value="<?= $getUserInformations_lastname ?>">

													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $getUserInformations_name ?> <?= $getUserInformations_lastname ?></div>
												</div>

												<div class="mb-3">
													<div class="form-label">Email</div>
													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $getUserInformations_email ?></div>
												</div>

												<div class="mb-3">
													<div class="form-label">Date</div>
													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $getContact_date ?></div>
												</div>

												<div class="mb-3">
													<label for="admin_contact_message<?= $getContact_id ?>" class="form-label">Message</label>
													<input type="hidden" class="form-control" id="admin_contact_message<?= $getContact_id ?>" name="message" value="<?= $getContact_message  ?>">

													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: break-all;"><?= $getContact_message ?></div>
												</div>

												<div class="mb-3">
													<label for="admin_contact_notification<?= $getContact_id ?>" class="form-label">Reply</label>
													<div class="form-floating">
														<textarea class="form-control" id="admin_contact_notification<?= $getContact_id ?>" style="height: 100px" name="notification"></textarea>
													</div>
												</div>

												<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</td>

						<td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_contact_messages.php?id=<?= $getContact_id ?>"><button class="btn btn-danger">Delete</button></a></td>

					</tr>
				<?php } ?>
			</tbody>
		</table>


<?php

		require('./assets/require/foot.php');
	} else {

		$bdd = null;
		header('location: /Diplome/index.php?error=030140');
		die();
	}
}

?>