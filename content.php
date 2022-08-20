<?php
session_start();
require('./assets/require/co_bdd.php');

if ($_GET['category'] != 'search_results') {
   if ($_GET['category'] == 'Tutorial') {

      $page = 'tuto_content';
      $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
      $req->execute(array(
         ':category' => $_GET['category']
      ));
   } else if ($_GET['category'] == 'Performance') {

      $page = 'perf_content';
      $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
      $req->execute(array(
         ':category' => $_GET['category']
      ));
   } else if ($_GET['category'] == 'Sheet Music') {

      $page = 'sheet_content';
      $req = $bdd->prepare('SELECT * FROM contents WHERE category = :category ');
      $req->execute(array(
         ':category' => $_GET['category']
      ));
   } else if ($_GET['category'] == 'user_content') {

      $page = 'user_content';
      $req = $bdd->prepare('SELECT * FROM contents WHERE id_users = :id_users ');
      $req->execute(array(
         ':id_users' => $_SESSION['users']['id']
      ));
   } else if ($_GET['category'] == 'user_purchased_content') {

      $page = 'user_purchased_content';
      $req = $bdd->prepare('SELECT purchased_contents.id_contents, contents.title , contents.composer, contents.category, contents.content, contents.price, contents.id, contents.description, contents.id_users
      FROM purchased_contents 
      INNER JOIN contents
      ON purchased_contents.id_contents = contents.id
      WHERE purchased_contents.id_users = :id_users ');
      $req->execute(array(
         ':id_users' => $_SESSION['users']['id']
      ));
   }

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
?>


<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="content-section">

      <div class="container">

         <?php foreach ($contents as $content) {
         ?>
            <div class="box">
               <div class="card">
                  <figure class="card__thumb">
                     <video class="card_video" src="./assets/contents_img/<?= htmlspecialchars($content['content']); ?>" type="video/mp4">
                     </video>
                     <div class="content_category"><?= htmlspecialchars($content['category']); ?></div>

                     <?php if ($content['price'] > 0) { ?>
                        <div class="content_price"><?= htmlspecialchars($content['price']); ?>Credits</div>
                     <?php } else { ?>
                        <div class="content_price">Free</div>
                     <?php } ?>

                     <figcaption class="card__caption">
                        <h2 class="card__title"><?= htmlspecialchars($content['composer']); ?></h2>
                        <h2 class="card__title"><?= htmlspecialchars($content['title']); ?></h2>
                        <p class="card__snippet">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                        <?php
                        if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {

                           $req = $bdd->prepare('SELECT id_users FROM purchased_contents WHERE id_contents = :contents_id');
                           $req->execute(array(
                              ':contents_id' => $content['id']
                           ));
                           $user_purchased_contents = $req->fetchAll();

                           $sessionUser_purchased_content = in_array($_SESSION['users']['id'], array_column($user_purchased_contents, 'id_users'), TRUE);

                           if ($content['price'] == 0 || $content['id_users'] == $_SESSION['users']['id']) { ?>

                              <a href="single_player_content.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page">Watch</a>
                              <?php } else {

                              if ($sessionUser_purchased_content == false) { ?>
                                 <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page">Buy</a>

                              <?php } else if ($sessionUser_purchased_content == true) { ?>
                                 <a href="single_player_content.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page">Watch</a>
                              <?php }
                           }
                        } else {
                           if ($content['price'] > 0) { ?>
                              <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page">Buy</a>
                           <?php } else {
                           ?>
                              <a href="single_player_content.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page">Watch</a>
                        <?php }
                        } ?>

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