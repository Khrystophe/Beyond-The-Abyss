<?php
session_start();
require('./assets/require/co_bdd.php');
require('./assets/actions/functions.php');

if ($_GET['category'] != 'search_results') {
   if ($_GET['category'] == 'Tutorial') {

      $page = 'tuto_content';
      $contents = getContents();
      $users_contents_informations = getUsersContentsInformations();
   } else if ($_GET['category'] == 'Performance') {

      $page = 'perf_content';
      $contents = getContents();
      $users_contents_informations = getUsersContentsInformations();
   } else if ($_GET['category'] == 'Sheet Music') {

      $page = 'sheet_content';
      $contents = getContents();
      $users_contents_informations = getUsersContentsInformations();
   } else if ($_GET['category'] == 'user_content') {

      $page = 'user_content';
      $contents = getUserContent();

      if (empty($contents)) {
         header('location: /Diplome/my_account.php?empty=user_content');
      }

      $users_contents_informations = getUsersContentsInformations();
   } else if ($_GET['category'] == 'user_purchased_content') {

      $page = 'user_purchased_content';
      $contents = getUserPurchasedContent();

      if (empty($contents)) {
         header('location: /Diplome/my_account.php?empty=user_purchased_content');
      }

      $users_contents_informations = getUsersContentsInformations();
   }
} else {

   $page = 'search_results';
   $contents = getSearchResults();
   $users_contents_informations = getUsersContentsInformations();
}

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
   $user_session = $_SESSION['users'];

   $user_session = getUserInformations();
   $user_session_id = htmlspecialchars($user_session['id']);
   $user_session_credits = htmlspecialchars($user_session['credits']);
}

require('./assets/require/head.php');
?>


<main class="autoAlpha" data-barba="wrapper">
   <div class="min-height" data-barba="container" data-barba-namespace="content-section">

      <div class="container">

         <?php foreach ($contents as $content) {

            $content_id = htmlspecialchars($content['id']);
            $content_title = htmlspecialchars($content['title']);
            $content_composer = htmlspecialchars($content['composer']);
            $content_category = htmlspecialchars($content['category']);
            $content_level = htmlspecialchars($content['level']);
            $content_video = htmlspecialchars($content['content']);
            $content_price = htmlspecialchars($content['price']);
            $content_description = htmlspecialchars($content['description']);
            $content_likes = htmlspecialchars($content['likes']);
            $content_id_user = htmlspecialchars($content['id_users']);

            foreach ($users_contents_informations as $user_content_information) {

               $user_content_id = htmlspecialchars($user_content_information['id']);
               $user_content_name = htmlspecialchars($user_content_information['name']);
               $user_content_lastname = htmlspecialchars($user_content_information['lastname']);

               if ($content_id_user == $user_content_id) {
                  $by_user =  "By " . $user_content_name . " " . $user_content_lastname;
                  break;
               }
            }
         ?>

            <div class="box">
               <div class="card">
                  <figure class="card__thumb">
                     <video class="card_video" src="./assets/contents_img/<?= $content_video ?>" type="video/mp4">
                     </video>

                     <figcaption class="card__caption">
                        <h2 class="card__title"><?= $content_composer ?></h2>
                        <h2 class="card__title"><?= $content_title ?></h2>
                        <p class="card__snippet" style="word-break: break-all ;"><?= $content_description ?></p>

                        <?php if (isset($user_session) && !empty($user_session)) {

                           $req = $bdd->prepare('SELECT id_users FROM purchased_contents WHERE id_contents = :contents_id');
                           $req->execute(array(
                              ':contents_id' => $content_id
                           ));
                           $user_purchased_contents = $req->fetchAll();

                           $user_session_purchased_content = in_array($user_session_id, array_column($user_purchased_contents, 'id_users'), TRUE);

                           if ($content_price == 0 || $content_id_user == $user_session_id) {

                              if ($content_price == 0) { ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price">Free</div>
                                 <div class="content_user"><?= $by_user ?></div>

                              <?php } else if ($content_id_user == $user_session_id) { ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price">Your content</div>
                                 <div class="content_user"><?= $by_user ?></div>

                              <?php } ?>

                              <a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>

                              <?php } else {

                              if ($user_session_purchased_content == false) { ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price"><?= $content_price ?> Credits</div>
                                 <div class="content_user"><?= $by_user ?></div>
                                 <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" class="card__button" onclick="javascript:return buy('<?= $user_session_credits ?>','<?= $content_title ?>','<?= $content_composer ?>','<?= $content_price ?>')">Buy</a>

                              <?php } else if ($user_session_purchased_content == true) { ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price">Purchased</div>
                                 <div class="content_user"><?= $by_user ?></div>
                                 <a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>

                              <?php }
                           }
                        } else {

                           if ($content_price > 0) { ?>

                              <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                              <div class="content_category"><?= $content_category ?></div>
                              <div class="content_price"><?= $content_price ?> Credits</div>
                              <div class="content_user"><?= $by_user ?></div>
                              <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" class="card__button link_page" onclick="javascript:return login()">Buy</a>

                           <?php } else { ?>

                              <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                              <div class="content_category"><?= $content_category ?></div>
                              <div class="content_price">Free</div>
                              <div class="content_user"><?= $by_user ?></div>
                              <a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>

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