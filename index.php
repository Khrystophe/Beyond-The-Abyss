<?php
session_start();
require('./assets/require/check_data.php');

if (
	(isset($get_error) xor !isset($check_get_error))
	&&
	(isset($get_success) xor !isset($check_get_success))
) {

	$page = 'index';
	require('./assets/require/co_bdd.php');
	require('./assets/require/functions.php');
	require('./assets/require/head.php');

	$getRandomTuto = getRandomTuto($bdd);
	$getRandomPerf = getRandomPerf($bdd);
	$getRandomSheet = getRandomSheet($bdd);

	require('./assets/require/variables.php');

?>


	<main class="autoAlpha" data-barba="wrapper">

		<div class="min-height" data-barba="container" data-barba-namespace="index-section">

			<div class="wrapp">

				<div class="abyss">
					<h1><span>Beyond the abyss</span>
					</h1>
					<h2>Learning</h2>
					<h2>Music Videos</h2>
					<img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
					<div class="main_logo_disc"></div>
				</div>

			</div>

			<div class="separators">
				<div class="separator one"></div>
				<div class="separator two"></div>
				<div class="separator three"></div>
			</div>

			<div class="features">
				<div class="cards one">
					<div class="titles link_page"><a href="content.php?category=tutorial">Tutorials</a></div>
					<div class="line one"></div>
					<div class="line two"></div>
					<div class="line three"></div>
				</div>

				<div class="cards two">
					<div class="titles link_page"><a href="content.php?category=performance">Performances</a></div>
					<div class="line one"></div>
					<div class="line two"></div>
					<div class="line three"></div>
				</div>

				<div class="cards three">
					<div class="titles link_page"><a href="content.php?category=sheet_music">Sheet music</a></div>
					<div class="line one"></div>
					<div class="line two"></div>
					<div class="line three"></div>
				</div>

			</div>



			<div class="random_content">


				<?php if (isset($getRandomTuto) && !empty($getRandomTuto)) {  ?>


					<div class="content_card tuto">

						<div class="gradient tuto"></div>

						<div class="info_section tuto">

							<div class="content_header tuto">

								<div>
									<h2><?= $getRandomTuto_title ?></h2>
									<h3><?= $getRandomTuto_composer ?></h3>

									<span class="see_content tuto"><a href="./content.php?id=<?= $getRandomTuto_id ?>&category=unique_content" class="btn link_page">Watch</a></span>

								</div>
							</div>

							<div>
								<img class="content tuto" src="./assets/images/<?= $getRandomTuto_image[0] ?>.jpg" alt="image"></img>
							</div>

							<div class="content_desc tuto">
								<p class="text">
									<?= $getRandomTuto_description ?>
								</p>
							</div>

						</div>
						<div class="blur_back tuto_back"></div>
					</div>


				<?php } ?>


				<?php if (isset($getRandomPerf) && !empty($getRandomPerf)) {  ?>


					<div class="content_card perf">

						<div class="gradient perf"></div>

						<div class="info_section perf">
							<div class="content_header perf">

								<div>
									<h2><?= $getRandomPerf_title ?></h2>
									<h3><?= $getRandomPerf_composer ?></h3>

									<span class="see_content perf"><a href="./content.php?id=<?= $getRandomPerf_id ?>&category=unique_content" class="btn link_page">Watch</a></span>

								</div>
							</div>

							<div>
								<img class="content perf" src="./assets/images/<?= $getRandomPerf_image[0] ?>.jpg" alt="image"></img>
							</div>

							<div class="content_desc perf">
								<p class="text">
									<?= $getRandomPerf_description ?>
								</p>
							</div>

						</div>
						<div class="blur_back perf_back"></div>
					</div>


				<?php } ?>


				<?php if (isset($getRandomSheet) && !empty($getRandomSheet)) {  ?>


					<div class="content_card sheet">

						<div class="gradient sheet"></div>

						<div class="info_section sheet">
							<div class="content_header sheet">

								<div>
									<h2><?= $getRandomSheet_title ?></h2>
									<h3><?= $getRandomSheet_composer ?></h3>

									<span class="see_content sheet"><a href="./content.php?id=<?= $getRandomSheet_id ?>&category=unique_content" class="btn link_page">Watch</a></span>

								</div>
							</div>

							<div>
								<img class="content sheet" src="./assets/images/<?= $getRandomSheet_image[0] ?>.jpg" alt="image"></img>
							</div>

							<div class="content_desc sheet">
								<p class="text">
									<?= $getRandomSheet_description ?>
								</p>
							</div>

						</div>
						<div class="blur_back sheet_back"></div>
					</div>


				<?php } ?>


			</div>
		</div>
	</main>

	<?php require('./assets/require/foot.php'); ?>


<?php } else {

	$bdd = null;
	http_response_code(400);
	header('location: index.php?error=00115');
	die();
} ?>