<?php
session_start();
$page = 'index';
require('./assets/require/check_data.php');
require('./assets/require/co_bdd.php');
require('./assets/require/functions.php');
require('./assets/require/head.php');

$random_tuto = getRandomTuto($bdd);
$random_tuto_id = htmlspecialchars($random_tuto['id']);
$random_tuto_title = htmlspecialchars($random_tuto['title']);
$random_tuto_content = htmlspecialchars($random_tuto['content']);
$random_tuto_price = htmlspecialchars($random_tuto['price']);
$random_tuto_composer = htmlspecialchars($random_tuto['composer']);
$random_tuto_category = htmlspecialchars($random_tuto['category']);
$random_tuto_level = htmlspecialchars($random_tuto['level']);
$random_tuto_description = htmlspecialchars($random_tuto['description']);
$random_tuto_likes = htmlspecialchars($random_tuto['likes']);
$random_tuto_id_users = htmlspecialchars($random_tuto['id_users']);

$random_perf = getRandomPerf($bdd);
$random_perf_id = htmlspecialchars($random_perf['id']);
$random_perf_title = htmlspecialchars($random_perf['title']);
$random_perf_content = htmlspecialchars($random_perf['content']);
$random_perf_price = htmlspecialchars($random_perf['price']);
$random_perf_composer = htmlspecialchars($random_perf['composer']);
$random_perf_category = htmlspecialchars($random_perf['category']);
$random_perf_level = htmlspecialchars($random_perf['level']);
$random_perf_description = htmlspecialchars($random_perf['description']);
$random_perf_likes = htmlspecialchars($random_perf['likes']);
$random_perf_id_users = htmlspecialchars($random_perf['id_users']);

$random_sheet = getRandomSheet($bdd);
$random_sheet_id = htmlspecialchars($random_sheet['id']);
$random_sheet_title = htmlspecialchars($random_sheet['title']);
$random_sheet_content = htmlspecialchars($random_sheet['content']);
$random_sheet_price = htmlspecialchars($random_sheet['price']);
$random_sheet_composer = htmlspecialchars($random_sheet['composer']);
$random_sheet_category = htmlspecialchars($random_sheet['category']);
$random_sheet_level = htmlspecialchars($random_sheet['level']);
$random_sheet_description = htmlspecialchars($random_sheet['description']);
$random_sheet_likes = htmlspecialchars($random_sheet['likes']);
$random_sheet_id_users = htmlspecialchars($random_sheet['id_users']); ?>


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

							<span class="see_content tuto"><a href="./single_player_content.php?id=<?= $random_tuto_id ?>" class="btn link_page">Watch</a>
							</span>

							<div class="type tuto">Classique</div>
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

					<div class="content_social tuto">
						<ul>
							<li><i class="material-icons">User</i></li>
						</ul>
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

							<div class="type perf">Jazz</div>
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

					<div class="content_social perf">
						<ul>
							<li><i class="material-icons">User</i></li>
						</ul>
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

							<div class="type sheet">Métal</div>
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

					<div class="content_social sheet">
						<ul>
							<li><i class="material-icons">User</i></li>
						</ul>
					</div>
				</div>
				<div class="blur_back sheet_back"></div>
			</div>
		</div>
	</div>
</main>

<?php require('./assets/require/foot.php'); ?>