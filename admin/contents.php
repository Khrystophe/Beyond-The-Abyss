<?php
session_start();
require('./assets/require/check_data.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
	if ($_SESSION['users']['type'] == 'admin') {

		if (
			(isset($get_error) xor !isset($check_get_error))
			&&
			(isset($get_success) xor !isset($check_get_success))
		) {

			require('./assets/require/co_bdd.php');
			require('./assets/require/functions.php');
			require('./assets/require/errors_success_modal.php');
			require('./assets/require/head.php');

			$getAllContents = getAllContents($bdd); ?>


			<h1>Contents</h1>

			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
				Add Contents
			</button>
			<br><br>

			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">

							<h5 class="modal-title" id="exampleModalLabel">Add content</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>

						<div class="modal-body">
							<form method="post" action="../../Diplome/assets/actions/add_content_action.php?type=admin" enctype="multipart/form-data">

								<div class="mb-3">
									<label for="admin_title" class="form-label">Title</label>
									<input type="text" class="form-control" id="admin_title" name="title" onkeyup="javascript:input(this,'admin_title',21, 'input_title');" required>
								</div>

								<div class="mb-3">
									<label for="admin_composer" class="form-label">Composer</label>
									<input type="text" class="form-control" id="admin_composer" name="composer" onkeyup="javascript:input(this,'admin_composer',21, 'input_composer');" required>
								</div>

								<div class="mb-3">
									<label for="admin_description">Description</label>
									<div class="form-floating">
										<textarea class="form-control" placeholder="Description" id="admin_description" style="height: 100px" name="description" onkeyup="javascript:input(this,'admin_description',1501, 'input_description');" required></textarea>
									</div>
								</div>

								<div class="mb-3">
									<label for="admin_category">Level</label>
									<select class="form-select" aria-label="Default select example" id="admin_category" name="category" required>
										<option value="">--Category--</option>
										<option value="tutorial">Tutorial</option>
										<option value="performance">Performances</option>
										<option value="sheet_music">Sheet Music</option>n>
									</select>
								</div>

								<div class="mb-3">
									<label for="admin_level">Level</label>
									<select class="form-select" aria-label="Default select example" id="admin_level" name="level" required>
										<option value="">--Level--</option>
										<option value="easy">Easy</option>
										<option value="medium">Medium</option>
										<option value="hard">Hard</option>
										<option value="very-hard">Very Hard</option>
									</select>
								</div>

								<div class="mb-3">
									<label for="admin_content_add" class="form-label">Files format : webm/mp4/ogv 128 Mo max.</label>
									<input class="form-control" type="file" id="admin_content_add" name="content" onchange="javascript:validContent('_add')" required>
								</div>

								<div class="mb-3">
									<label for="admin_price" class="form-label">Price : from 1 to 500 or free (type 'Free')</label>
									<input type="text" id="admin_price" name="price" onkeyup="javascript:input(this,'admin_price',5, 'input_price');" required>
								</div>

								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>


					</div>
				</div>
			</div>

			<table class="table sortable">
				<thead>
					<tr>
						<th scope="row" style="word-break: break-all;">id</th>
						<th scope="row" style="word-break: break-all;">Likes</th>
						<th scope="row" style="word-break: break-all;">Reporting</th>
						<th scope="row" style="word-break: break-all;">id_users</th>
					</tr>
				</thead>

				<tbody>

					<?php foreach ($getAllContents as $getAllContent) {

						require('./assets/require/variables.php'); ?>

						<tr>
							<td scope="col" style="word-break: break-all;"><?= $getAllContent_id ?></td>
							<td scope="col" style="word-break: break-all;"><?= $getAllContent_likes ?></td>
							<td scope="col" style="word-break: break-all;"><?= $getAllContent_reporting ?></td>
							<td scope="col" style="word-break: break-all;"><?= $getAllContent_id_users ?></td>

							<td scope="col" style="word-break: break-all;">

								<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#content_editModal<?= $getAllContent_id ?>">
									Edit/Watch
								</button>

								<div class="modal fade" id="content_editModal<?= $getAllContent_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">

												<h5 class="modal-title" id="exampleModalLabel">Edit/Watch</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form method="post" action="../../Diplome/assets/actions/edit_content_action.php?type=admin" enctype="multipart/form-data">

													<div class="mb-3">
														<label for="admin_edit_id<?= $getAllContent_id ?>" class="form-label">Content id</label>
														<input type="hidden" class="form-control" id="admin_edit_id<?= $getAllContent_id ?>" name="id" value="<?= $getAllContent_id ?>">
														<div style="width:15%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $getAllContent_id ?></div>
													</div>

													<div class="mb-3">
														<label for="admin_edit_id_users<?= $getAllContent_id ?>" class="form-label">Id users</label>
														<input type="text" class="form-control" id="admin_edit_id_users<?= $getAllContent_id ?>" name="id_users" value="<?= $getAllContent_id_users ?>">
													</div>

													<div class="mb-3">
														<label for="admin_edit_id_users<?= $getAllContent_id ?>" class="form-label">Reporting</label>
														<input type="text" class="form-control" id="admin_edit_id_users<?= $getAllContent_id ?>" name="reporting" onkeyup="javascript:input(this,'admin_edit_id_users<?= $getAllContent_id ?>',11, 'input_credits_reporting');" value="<?= $getAllContent_reporting ?>">
													</div>

													<div class="mb-3">
														<label for="admin_edit_title<?= $getAllContent_id ?>" class="form-label">Title</label>
														<input type="text" class="form-control" id="admin_edit_title<?= $getAllContent_id ?>" name="title" onkeyup="javascript:input(this,'admin_edit_title<?= $getAllContent_id ?>',21, 'input_title');" value="<?= $getAllContent_title ?>" placeholder="<?= $getAllContent_title ?>">
													</div>

													<div class="mb-3">
														<label for="admin_edit_composer<?= $getAllContent_id ?>" class="form-label">Composer</label>
														<input type="text" class="form-control" id="admin_edit_composer<?= $getAllContent_id ?>" name="composer" onkeyup="javascript:input(this,'admin_edit_composer<?= $getAllContent_id ?>',21, 'input_composer');" value="<?= $getAllContent_composer ?>" placeholder="<?= $getAllContent_composer ?>">
													</div>

													<div class="mb-3">
														<label for="admin_edit_description<?= $getAllContent_id ?>">Description</label>
														<div class="form-floating">
															<textarea class="form-control" id="admin_edit_description<?= $getAllContent_id ?>" style=" white-space:pre-line; height: 100px" name="description" onkeyup="javascript:input(this,'admin_edit_description<?= $getAllContent_id ?>',1501, 'input_description');" value="<?= $getAllContent_description  ?>"><?= $getAllContent_description  ?></textarea>
														</div>
													</div>

													<div class="mb-3">
														<label for="admin_edit_category<?= $getAllContent_id ?>">Category</label>
														<select class="form-select" id="admin_edit_category<?= $getAllContent_id ?>" aria-label="Default select example" name="category">
															<option value="<?= $getAllContent_category ?>"><?= $getAllContent_category ?></option>
															<option value="tutorial">Tutorial</option>
															<option value="performance">Performances</option>
															<option value="sheet_music">Sheet Music</option>
														</select>
													</div>

													<div class="mb-3">
														<label for="admin_edit_level<?= $getAllContent_id ?>">Level</label>
														<select class="form-select" id="admin_edit_level<?= $getAllContent_id ?>" aria-label="Default select example" name="level">
															<option value="<?= $getAllContent_level ?>"><?= $getAllContent_level ?></option>
															<option value="easy">Easy</option>
															<option value="medium">Medium</option>
															<option value="hard">Hard</option>
															<option value="very-hard">Very Hard</option>
														</select>
													</div>

													<div class="mb-3">
														<div class="form-label">Content</div>
														<video style="width: 225px ;" class="card_video" src="../../Diplome/assets/videos/<?= $getAllContent_video ?>" type="video/mp4" controls>
													</div>

													<div class="mb-3">
														<label for="admin_content<?= $getAllContent_id ?>" class="form-label">Content</label>
														<input class="form-control" type="file" id="admin_content<?= $getAllContent_id ?>" name="content" onchange="javascript:validContent(<?= $getAllContent_id ?>)">
													</div>

													<?php if ($getAllContent_price == '0') {
														$getAllContent_price = 'Free';
													} ?>

													<div class="mb-3">
														<label for="admin_edit_price<?= $getAllContent_id ?>" class="form-label">Price : from 1 to 50 or free (type 'Free')</label>
														<input type="text" id="admin_edit_price<?= $getAllContent_id ?>" name="price" onkeyup="javascript:input(this,'admin_edit_price<?= $getAllContent_id ?>',5, 'input_price');" value="<?= $getAllContent_price ?>" placeholder="<?= $getAllContent_price ?>">
													</div>

													<button type="submit" class="btn btn-primary">Submit</button>

												</form>
											</div>
										</div>
									</div>
								</div>
							</td>

							<td scope="col" style="word-break: break-all;"> <a href="../../Diplome/assets/actions/delete_content_action.php?id=<?= $getAllContent_id ?>&type=admin"><button class="btn btn-danger">Delete</button></a></td>

						</tr>

					<?php } ?>

				</tbody>
			</table>

			<?php require('./assets/require/foot.php'); ?>


		<?php } else {

			$bdd = null;
			http_response_code(400);
			header('location: /Diplome/index.php?error=02915');
			die();
		} ?>


	<?php  } else {

		$bdd = null;
		header('location: /Diplome/index.php?error=029140');
		die();
	} ?>


<?php } else {

	$bdd = null;
	header('location: /Diplome/index.php?error=029163');
	die();
}
?>