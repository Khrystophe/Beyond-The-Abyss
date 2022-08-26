<?php
session_start();
require('./assets/require/co_bdd.php');
require('./assets/actions/functions.php');

if ($_GET['category'] != 'search_results') {
   if ($_GET['category'] == 'Tutorial') {

      $page = 'tuto_content';
      $contents = getContents();
   } else if ($_GET['category'] == 'Performance') {

      $page = 'perf_content';
      $contents = getContents();
   } else if ($_GET['category'] == 'Sheet Music') {

      $page = 'sheet_content';
      $contents = getContents();
   } else if ($_GET['category'] == 'user_content') {

      $page = 'user_content';
      $contents = getUserContent();
   } else if ($_GET['category'] == 'user_purchased_content') {

      $page = 'user_purchased_content';
      $contents = getUserPurchasedContent();
   }
} else {

   $page = 'search_results';
   $contents = getSearchResults();
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
                                 <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button" onclick="return buy()">Buy</a>

                                 <script>
                                    function buy() {
                                       return confirm("You have<?= $_SESSION['users']['credits']  ?> credits. Do you want to buy <?= $content['title'] . 'of' . $content['composer'] ?> for <?= $content['price'] ?> credits ?")
                                    }
                                 </script>

                              <?php } else if ($sessionUser_purchased_content == true) { ?>
                                 <a href="single_player_content.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page">Watch</a>
                              <?php }
                           }
                        } else {
                           if ($content['price'] > 0) { ?>
                              <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= htmlspecialchars($content['id']); ?>" class="card__button link_page" onclick="return login()">Buy</a>

                              <script>
                                 function login() {
                                    return alert('You are not connected !')
                                 }
                              </script>
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