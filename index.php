<?php
session_start();
$page = 'index';
require('./assets/require/check_data.php');
require('./assets/require/co_bdd.php');
require('./assets/require/functions.php');
require('./assets/require/head.php');

$getRandomTuto = getRandomTuto($bdd);
$getRandomPerf = getRandomPerf($bdd);
$getRandomSheet = getRandomSheet($bdd);

require('./assets/require/variables.php'); ?>


<main class="autoAlpha" data-barba="wrapper">

	<div class="min-height" data-barba="container" data-barba-namespace="index-section">

		<div class="wrapp">

			<div class="abyss">
				<h1><span>Beyond the abyss</span>
				</h1>
				<h2>Music from the </h2>
				<h2>depths</h2>
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


			<div class="content_card tuto">

				<div class="gradient tuto"></div>

				<div class="info_section tuto">
					<div class="content_header tuto">

						<div>
							<h2><?= $random_tuto_title ?></h2>
							<h3><?= $random_tuto_composer ?></h3>

							<span class="see_content tuto"><a href="./single_player_content.php?id=<?= $random_tuto_id ?>" class="btn link_page">Watch</a></span>

						</div>
					</div>

					<div>
						<video class="content tuto" src="./assets/videos/<?= $random_tuto_content ?>" type="video/mp4"></video>
					</div>

					<div class="content_desc tuto">
						<p class="text">
							<?= $random_tuto_description ?>
						</p>
					</div>

				</div>
				<div class="blur_back tuto_back"></div>
			</div>


			<div class="content_card perf">

				<div class="gradient perf"></div>

				<div class="info_section perf">
					<div class="content_header perf">

						<div>
							<h2><?= $random_perf_title ?></h2>
							<h3><?= $random_perf_composer ?></h3>

							<span class="see_content perf"><a href="./single_player_content.php?id=<?= $random_perf_id ?>" class="btn link_page">Watch</a></span>

						</div>
					</div>

					<div>
						<video class="content perf" src="./assets/videos/<?= $random_perf_content ?>" type="video/mp4">
						</video>
					</div>

					<div class="content_desc perf">
						<p class="text">
							<?= $random_perf_description ?>
						</p>
					</div>

				</div>
				<div class="blur_back perf_back"></div>
			</div>


			<div class="content_card sheet">

				<div class="gradient sheet"></div>

				<div class="info_section sheet">
					<div class="content_header sheet">

						<div>
							<h2><?= $random_sheet_title ?></h2>
							<h3><?= $random_sheet_composer ?></h3>

							<span class="see_content sheet"><a href="./single_player_content.php?id=<?= $random_sheet_id ?>" class="btn link_page">Watch</a></span>

						</div>
					</div>

					<div>
						<video class="content sheet" src="./assets/videos/<?= $random_sheet_content ?>" type="video/mp4">
						</video>
					</div>

					<div class="content_desc sheet">
						<p class="text">
							<?= $random_sheet_description ?>
						</p>
					</div>

				</div>
				<div class="blur_back sheet_back"></div>
			</div>
		</div>
	</div>
</main>

<?php require('./assets/require/foot.php'); ?>