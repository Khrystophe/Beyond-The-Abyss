<?php
session_start();
require('./assets/require/co_bdd.php');

if ($_GET['category'] != 'search_results') {
   if ($_GET['category'] == 'Tutorial') {

      $page = 'tuto_content';
   } else if ($_GET['category'] == 'Performance') {

      $page = 'perf_content';
   } else if ($_GET['category'] == 'Sheet Music') {

      $page = 'sheet_content';
   } else if ($_GET['category'] == 'user_content') {

      $page = 'user_content';
   } else if ($_GET['category'] == 'user_purchased_content') {

      $page = 'user_purchased_content';
   }

   $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
   $req->execute(array(
      ':category' => $_GET['category']
   ));
   $contents = $req->fetchAll();
} else {
   $page = 'search_results';

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
      $contents = $req->fetchAll();
   } else if (isset($level) && !empty($level)) {

      $req = $bdd->query("SELECT * FROM contents WHERE level = '$level' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
      $contents = $req->fetchAll();
   } else if (isset($category) && !empty($category)) {

      $req = $bdd->query("SELECT * FROM contents WHERE category = '$category' AND (composer LIKE '%" . $composerImplode . "%') AND (title LIKE '%" . $titleImplode . "%')");
      $contents = $req->fetchAll();
   } else {

      $req = $bdd->query("SELECT * FROM contents WHERE (title LIKE '%" . $titleImplode . "%') AND (composer LIKE '%" . $composerImplode . "%')");
      $contents = $req->fetchAll();
   }
}

require('./assets/require/head.php');


$join = $bdd->query('SELECT users.id, users.name 
FROM users
INNER JOIN contents
ON users.id = contents.id_users');
$results = $join->fetchAll();

?>
<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="content-section">

      <div class="container">

         <?php foreach ($contents as $content) { ?>
            <div class="box">
               <div class="card">
                  <figure class="card__thumb">
                     <video class="card_video" src="./assets/contents_img/<?= htmlspecialchars($content['content']); ?>" type="video/mp4">
                     </video>
                     <div class="content_category"><?= htmlspecialchars($content['category']); ?></div>
                     <figcaption class="card__caption">
                        <h2 class="card__title"><?= htmlspecialchars($content['composer']); ?></h2>
                        <h2 class="card__title"><?= htmlspecialchars($content['title']); ?></h2>
                        <p class="card__snippet">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <a href="<?= htmlspecialchars($content['id']); ?>" class="card__button">Voir</a>
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