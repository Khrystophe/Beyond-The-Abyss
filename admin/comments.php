<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
	if ($_SESSION['users']['type'] == 'admin') {

		require('./assets/require/head.php');
		require('./assets/require/co_bdd.php');
		require('./assets/require/functions.php');

		$comments = getComments($bdd);

?>

		<h1>Comments</h1>

		<table class="table sortable">
			<thead>
				<tr>
					<th scope="col" style="word-break: break-all;">id</th>
					<th scope="col" style="word-break: break-all;">Date</th>
					<th scope="col" style="word-break: break-all;">Likes</th>
					<th scope="col" style="word-break: break-all;">id_contents</th>
					<th scope="col" style="word-break: break-all;">id_users</th>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($comments as $comment) {

					$comment_id = htmlspecialchars($comment['id']);
					$comment_message = nl2br(htmlspecialchars($comment['comment']));
					$comment_date = htmlspecialchars($comment['date']);
					$comment_likes = htmlspecialchars($comment['likes']);
					$comment_id_contents = htmlspecialchars($comment['id_contents']);
					$comment_id_users = htmlspecialchars($comment['id_users']);

					$user = getUserInformations($bdd, $comment_id_users);

					$user_name = htmlspecialchars($user['name']);
					$user_lastname = htmlspecialchars($user['lastname']);
					$user_email = htmlspecialchars($user['email']);

				?>

					<tr>
						<td scope="col" style="word-break: break-all;"><?= $comment_id ?></td>
						<td scope="col" style="word-break: break-all;"><?= $comment_date ?></td>
						<td scope="col" style="word-break: break-all;"><?= $comment_likes ?></td>
						<td scope="col" style="word-break: break-all;"><?= $comment_id_contents ?></td>
						<td scope="col" style="word-break: break-all;"><?= $comment_id_users ?></td>

						<td scope="col" style="word-break: break-all;">

							<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $comment_id ?>">
								See
							</button>

							<div class="modal fade" id="user_editModal<?= $comment_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">

											<h5 class="modal-title" id="exampleModalLabel">Comment</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>

										<div class="modal-body">
											<form method="post" action="./assets/actions/reply_action.php?id=<?= $comment_id ?>" enctype="multipart/form-data">

												<div class="mb-3">
													<label for="admin_comment_id_user<?= $comment_id ?>" class="form-label">Comment User id</label>
													<input type="hidden" class="form-control" id="admin_comment_id_user<?= $comment_id ?>" name="id" value="<?= $comment_id_users ?>">

													<div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $comment_id_users ?></div>
												</div>

												<div class="mb-3">
													<label for="admin_comment_name<?= $comment_id ?> class=" form-label">Name/Lastname</label>
													<input type="hidden" class="form-control" id="admin_comment_name<?= $comment_id ?>" name="name" value="<?= $user_name ?>">

													<label for="admin_comment_lastname<?= $comment_id ?> class=" form-label"></label>
													<input type="hidden" class="form-control" id="admin_comment_lastname<?= $comment_id ?>" name="lastname" value="<?= $user_lastname ?>">

													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $user_name ?> <?= $user_lastname ?></div>
												</div>

												<div class="mb-3">
													<div class="form-label">comment Date</div>
													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $comment_date ?></div>
												</div>

												<div class="mb-3">
													<div class="form-label">comment Message</div>
													<div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: break-all;"><?= $comment_message ?></div>
												</div>

											</form>
										</div>
									</div>
								</div>
							</div>
						</td>


						<td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_comments_action.php?id=<?= $comment_id ?>"><button class="btn btn-danger">Delete</button></a></td>
					</tr>

				<?php } ?>

			</tbody>
		</table>

<?php

		require('./assets/require/foot.php');
	} else {

		header('location: /Diplome/index.php');
	}
}

?>