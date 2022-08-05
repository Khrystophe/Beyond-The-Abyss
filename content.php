<?php
session_start();
if ($_GET['category'] == 'tuto') {

   $page = 'tuto_content';
} else if ($_GET['category'] == 'perf') {

   $page = 'perf_content';
} else if ($_GET['category'] == 'sheet') {

   $page = 'sheet_content';
} else if ($_GET['category'] == 'user_content') {

   $page = 'user_content';
} else if ($_GET['category'] == 'user_purchased_content') {

   $page = 'user_purchased_content';
} else if ($_GET['category'] == 'search_results') {

   $page = 'search_results';
}

require('./assets/require/co_bdd.php');
require('./assets/require/head.php');


$req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
$req->execute(array(
   ':category' => $_GET['category']
));
$contents = $req->fetchAll();

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