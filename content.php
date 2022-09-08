<?php
session_start();
require('./assets/require/check_data.php');


if (
   isset($get_category)
   && (isset($session_users_id) xor !isset($session_users_id))
   && (isset($post_title) xor !isset($post_title))
   && (isset($post_composer) xor !isset($post_composer))
   && (isset($post_category) xor !isset($post_category))
   && (isset($post_level) xor !isset($post_level))
) {

   require('./assets/require/co_bdd.php');
   require('./assets/require/page_deco_auto.php');
   require('./assets/require/session_regenerate.php');
   require('./assets/require/functions.php');

   if ($get_category != 'search_results') {
      if ($get_category == 'tutorial') {

         $page = 'tuto_content';
         $contents = getContents($bdd, $get_category);
      } else if ($get_category == 'performance') {

         $page = 'perf_content';
         $contents = getContents($bdd, $get_category);
      } else if ($get_category == 'sheet_music') {

         $page = 'sheet_content';
         $contents = getContents($bdd, $get_category);
      } else if ($get_category == 'user_content') {

         $page = 'user_content';
         $contents = getUserContent($bdd, $session_users_id);

         if (empty($contents)) {
            header('location: /Diplome/my_account.php?error=empty_user_content');
            die();
         }
      } else if ($get_category == 'user_purchased_content') {

         $page = 'user_purchased_content';
         $contents = getUserPurchasedContent($bdd, $session_users_id);

         if (empty($contents)) {
            header('location: /Diplome/my_account.php?error=empty_user_purchased_content');
            die();
         }
      } else {

         header('location: index.php?error=category_not_found');
         die();
      }
   } else {

      if (isset($_POST) && !empty($_POST)) {

         if (!isset($post_title)) {
            $post_title = null;
         }
         if (!isset($post_composer)) {
            $post_composer = null;
         }
         if (!isset($post_category)) {
            $post_category = null;
         }
         if (!isset($post_level)) {
            $post_level = null;
         }

         $page = 'search_results';
         $contents = getSearchResults($bdd, $post_title, $post_composer, $post_category, $post_level);
      } else {

         header('location: index.php?error=forbidden_reload');
         die();
      }
   }

   if (isset($session_users_id) && !empty($session_users_id)) {

      $user_session = getUserInformations($bdd, $session_users_id);

      $user_session_id = htmlspecialchars($user_session['id']);
      $user_session_credits = htmlspecialchars($user_session['credits']);
   }

   require('./assets/require/head.php');

?>

   <main class="autoAlpha" data-barba="wrapper">
      <div class="min-height" data-barba="container" data-barba-namespace="content-section">

         <div class="container">

            <?php

            foreach ($contents as $content) {

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

               if ($content_category == 'tutorial') {
                  $content_category = 'Tutorial';
               } else if ($content_category == 'performance') {
                  $content_category = 'Performance';
               } else if ($content_category == 'sheet_music') {
                  $content_category = 'Sheet Music';
               }

               $user_content_information = getUserContentInformations($bdd, $content_id_user);

               $user_content_id = htmlspecialchars($user_content_information['id']);
               $user_content_name = htmlspecialchars($user_content_information['name']);
               $user_content_lastname = htmlspecialchars($user_content_information['lastname']);


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

                           <?php

                           if (isset($user_session) && !empty($user_session)) {

                              $user_purchased_contents = getIdUserFromPurchasedContent($bdd, $content_id);

                              $user_session_purchased_content = in_array($user_session_id, array_column($user_purchased_contents, 'id_users'));

                              if ($content_price == 0 || $content_id_user == $user_session_id) {

                                 if ($content_price == 0) {

                           ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price">Free</div>
                                    <div class="content_user name">By <?= $user_content_name ?></div>
                                    <div class="content_user lastname"><?= $user_content_lastname ?></div>

                                 <?php

                                 } else if ($content_id_user == $user_session_id) {

                                 ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price">Your content</div>
                                    <div class="content_user name">By <?= $user_content_name ?></div>
                                    <div class="content_user lastname"><?= $user_content_lastname ?></div>

                                 <?php

                                 }

                                 ?>

                                 <a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>

                                 <?php

                              } else {

                                 if ($user_session_purchased_content == false) {

                                 ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price"><?= $content_price ?> Credits</div>
                                    <div class="content_user name">By <?= $user_content_name ?></div>
                                    <div class="content_user lastname"><?= $user_content_lastname ?></div>
                                    <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" class="card__button" onclick="javascript:return buy('<?= $user_session_credits ?>','<?= $content_title ?>','<?= $content_composer ?>','<?= $content_price ?>')">Buy</a>

                                 <?php } else if ($user_session_purchased_content == true) { ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price">Purchased</div>
                                    <div class="content_user name">By <?= $user_content_name ?></div>
                                    <div class="content_user lastname"><?= $user_content_lastname ?></div>
                                    <a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>

                                 <?php

                                 }
                              }
                           } else {

                              if ($content_price > 0) {

                                 ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price"><?= $content_price ?> Credits</div>
                                 <div class="content_user name">By <?= $user_content_name ?></div>
                                 <div class="content_user lastname"><?= $user_content_lastname ?></div>
                                 <a class="card__button link_page" onclick="javascript:return login()">Buy</a>

                              <?php

                              } else {

                              ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price">Free</div>
                                 <div class="content_user name">By <?= $user_content_name ?></div>
                                 <div class="content_user lastname"><?= $user_content_lastname ?></div>
                                 <a href="single_player_content.php?id=<?= $content_id ?>" class="card__button link_page">Watch</a>

                           <?php

                              }
                           }

                           ?>

                        </figcaption>
                     </figure>
                  </div>
               </div>

            <?php

            }

            ?>

         </div>
      </div>
   </main>

<?php require('./assets/require/foot.php');
} else {

   http_response_code(400);
   header('location: index.php?error=processing_bad_or_malformed_request');
   die();
}

?>