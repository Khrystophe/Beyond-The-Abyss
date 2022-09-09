<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
	if ($_SESSION['users']['type'] == 'admin') {

		require('./assets/require/head.php');
		require('./assets/require/co_bdd.php');
		require('./assets/require/functions.php');

		$getAllContents = getAllContents($bdd);

?>

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
								<input type="text" class="form-control" id="admin_title" name="title" required>
							</div>

							<div class="mb-3">
								<label for="admin_composer" class="form-label">Composer</label>
								<input type="text" class="form-control" id="admin_composer" name="composer" required>
							</div>

							<div class="mb-3">
								<label for="admin_description">Description</label>
								<div class="form-floating">
									<textarea class="form-control" placeholder="Description" id="admin_description" style="height: 100px" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>
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
								<label for="admin_content_add" class="form-label"></label>
								<input class="form-control" type="file" id="admin_content_add" name="content" onchange="javascript: return validContent('_add')" required>
							</div>

							<div class="mb-3">
								<label for="admin_price" class="form-label">Price : from 1 to 50 or free (type 'Free')</label>
								<input type="text" id="admin_price" pattern="^([1-9]|[1-4][0-9]|50|Free)$" name="price" required>
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

				<?php foreach ($getAllContents as $content) {

					$content_id = htmlspecialchars($content['id']);
					$content_title = htmlspecialchars($content['title']);
					$content_composer = htmlspecialchars($content['composer']);
					$content_video = htmlspecialchars($content['content']);
					$content_category = htmlspecialchars($content['category']);
					$content_level = htmlspecialchars($content['level']);
					$content_description = nl2br(htmlspecialchars($content['description']));
					$content_price = htmlspecialchars($content['price']);
					$content_likes = htmlspecialchars($content['likes']);
					$content_reporting = htmlspecialchars($content['reporting']);
					$content_id_users = htmlspecialchars($content['id_users']);

				?>

					<tr>
						<td scope="col" style="word-break: break-all;"><?= $content_id ?></td>
						<td scope="col" style="word-break: break-all;"><?= $content_likes ?></td>
						<td scope="col" style="word-break: break-all;"><?= $content_reporting ?></td>
						<td scope="col" style="word-break: break-all;"><?= $content_id_users ?></td>

						<td scope="col" style="word-break: break-all;">

							<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#content_editModal<?= $content_id ?>">
								Edit/Watch
							</button>

							<div class="modal fade" id="content_editModal<?= $content_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">

											<h5 class="modal-title" id="exampleModalLabel">Edit/Watch</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form method="post" action="../../Diplome/assets/actions/edit_content_action.php?type=admin" enctype="multipart/form-data">

												<div class="mb-3">
													<label for="admin_edit_id<?= $content_id ?>" class="form-label">Content id</label>
													<input type="hidden" class="form-control" id="admin_edit_id<?= $content_id ?>" name="id" value="<?= $content_id ?>">
													<div style="width:15%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $content_id ?></div>
												</div>

												<div class="mb-3">
													<label for="admin_edit_id_users<?= $content_id ?>" class="form-label">Id users</label>
													<input type="text" class="form-control" id="admin_edit_id_users<?= $content_id ?>" name="id_users" value="<?= $content_id_users ?>">
												</div>

												<div class="mb-3">
													<label for="admin_edit_id_users<?= $content_id ?>" class="form-label">Reporting</label>
													<input type="text" class="form-control" id="admin_edit_id_users<?= $content_id ?>" name="reporting" value="<?= $content_reporting ?>">
												</div>

												<div class="mb-3">
													<label for="admin_edit_title<?= $content_id ?>" class="form-label">Title</label>
													<input type="text" class="form-control" id="admin_edit_title<?= $content_id ?>" name="title" value="<?= $content_title ?>" placeholder="<?= $content_title ?>">
												</div>

												<div class="mb-3">
													<label for="admin_edit_composer<?= $content_id ?>" class="form-label">Composer</label>
													<input type="text" class="form-control" id="admin_edit_composer<?= $content_id ?>" name="composer" value="<?= $content_composer ?>" placeholder="<?= $content_composer ?>">
												</div>

												<div class="mb-3">
													<label for="admin_edit_description<?= $content_id ?>">Description</label>
													<div class="form-floating">
														<textarea class="form-control" id="admin_edit_description<?= $content_id ?>" style="height: 100px" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" value="<?= $content_description  ?>"><?= $content_description  ?></textarea>
													</div>
												</div>

												<div class="mb-3">
													<label for="admin_edit_category<?= $content_id ?>">Category</label>
													<select class="form-select" id="admin_edit_category<?= $content_id ?>" aria-label="Default select example" name="category">
														<option value="<?= $content_category ?>"><?= $content_category ?></option>
														<option value="tutorial">Tutorial</option>
														<option value="performance">Performances</option>
														<option value="sheet_music">Sheet Music</option>
													</select>
												</div>

												<div class="mb-3">
													<label for="admin_edit_level<?= $content_id ?>">Level</label>
													<select class="form-select" id="admin_edit_level<?= $content_id ?>" aria-label="Default select example" name="level">
														<option value="<?= $content_level ?>"><?= $content_level ?></option>
														<option value="easy">Easy</option>
														<option value="medium">Medium</option>
														<option value="hard">Hard</option>
														<option value="very-hard">Very Hard</option>
													</select>
												</div>

												<div class="mb-3">
													<div class="form-label">Content</div>
													<video style="width: 225px ;" class="card_video" src="../../Diplome/assets/videos/<?= $content_video ?>" type="video/mp4" controls>
												</div>

												<div class="mb-3">
													<label for="admin_content<?= $content_id ?>" class="form-label">Content</label>
													<input class="form-control" type="file" id="admin_content<?= $content_id ?>" name="content" onchange="javascript: return validContent(<?= $content_id ?>)">
												</div>

												<div class="mb-3">
													<label for="admin_edit_price<?= $content_id ?>" class="form-label">Price : from 1 to 50 or free (type 'Free')</label>
													<input type="text" id="admin_edit_price<?= $content_id ?>" pattern="^([1-9]|[1-4][0-9]|50|Free)$" name="price" value="<?= $content_price ?>" placeholder="<?= $content_price ?>">
												</div>

												<button type="submit" class="btn btn-primary">Submit</button>

											</form>
										</div>
									</div>
								</div>
							</div>
						</td>

						<td scope="col" style="word-break: break-all;"> <a href="../../Diplome/assets/actions/delete_content_action.php?id=<?= $content_id ?>&type=admin"><button class="btn btn-danger">Delete</button></a></td>

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