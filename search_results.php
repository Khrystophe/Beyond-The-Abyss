<?php
session_start();
$page = "search_results";
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');


$title = $_POST['title'];
$titleSplit = str_split($title, 3);
$titleImplode = implode("%' OR title LIKE '%", $titleSplit);

$composer = $_POST['composer'];
$composerSplit = str_split($composer, 3);
$composerImplode = implode("%' OR composer LIKE '%", $composerSplit);

$category = $_POST['category'];

$level = $_POST['level'];

if ((isset($level) && !empty($level)) && (isset($category) && !empty($category))) {

  $req = $bdd->query("SELECT * FROM contents WHERE level = '$level' AND category = '$category' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
  $search_results = $req->fetchAll();
} else if (isset($level) && !empty($level)) {

  $req = $bdd->query("SELECT * FROM contents WHERE level = '$level' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
  $search_results = $req->fetchAll();
} else if (isset($category) && !empty($category)) {

  $req = $bdd->query("SELECT * FROM contents WHERE category = '$category' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
  $search_results = $req->fetchAll();
} else {

  $req = $bdd->query("SELECT * FROM contents WHERE (title LIKE '%" . $titleImplode . "%') AND (composer LIKE '%" . $composerImplode . "%')");
  $search_results = $req->fetchAll();
}
?>



<main class="autoAlpha" data-barba="wrapper">
  <div data-barba="container" data-barba-namespace="search_results-section">

    <div class="container">
      <?php foreach ($search_results as $result) { ?>
        <div class="box">
          <div class="card">
            <figure class="card__thumb">
              <video class="card_video" src="./assets/contents_img/<?= htmlspecialchars($result['content']); ?>" type="video/mp4">
              </video>
              <div class="content_category"><?= htmlspecialchars($result['category']); ?></div>
              <figcaption class="card__caption">
                <h2 class="card__title"><?= htmlspecialchars($result['composer']); ?></h2>
                <h2 class="card__title"><?= htmlspecialchars($result['title']); ?></h2>
                <p class="card__snippet">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <a href="<?= htmlspecialchars($result['id']); ?>" class="card__button">Voir</a>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
    </div>

  </div>
  <?php
  require('./assets/require/foot.php');
  ?>
</main>


</body>

</html>