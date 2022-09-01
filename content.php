<?php
session_start();
require('./assets/require/check_data.php');


if (
   $check_get_category === true
   && ((isset($check_session_users_id) && $check_session_users_id === true) xor !isset($check_session_users_id))
   && ((isset($check_post_title) && $check_post_title === true) xor !isset($check_post_title))
   && ((isset($check_post_composer) && $check_post_composer === true) xor !isset($check_post_composer))
   && ((isset($check_post_category) && $check_post_category === true) xor !isset($check_post_category))
   && ((isset($check_post_level) && $check_post_level === true) xor !isset($check_post_level))
) {

   require('./assets/require/co_bdd.php');
   require('./assets/require/functions.php');

   if ($get_category != 'search_results') {
      if ($get_category == 'Tutorial') {

         $page = 'tuto_content';
         $contents = getContents($bdd, $get_category);
      } else if ($get_category == 'Performance') {

         $page = 'perf_content';
         $contents = getContents($bdd, $get_category);
      } else if ($get_category == 'Sheet Music') {

         $page = 'sheet_content';
         $contents = getContents($bdd, $get_category);
      } else if ($get_category == 'user_content') {

         $page = 'user_content';
         $contents = getUserContent($bdd, $session_users_id);

         if (empty($contents)) {
            header('location: /Diplome/my_account.php?empty=user_content');
         }
      } else if ($get_category == 'user_purchased_content') {

         $page = 'user_purchased_content';
         $contents = getUserPurchasedContent($bdd, $session_users_id);

         if (empty($contents)) {
            header('location: /Diplome/my_account.php?empty=user_purchased_content');
         }
      } else {

         header('location: index.php');
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

         header('location: index.php');
      }
   }

   if (isset($session_users_id) && !empty($session_users_id)) {

      $user_session = getUserInformations($bdd);
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

               $by_user =  "By " . $user_content_name . " " . $user_content_lastname;

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

                              $req = $bdd->prepare('SELECT id_users FROM purchased_contents WHERE id_contents = :contents_id');
                              $req->execute(array(
                                 ':contents_id' => $content_id
                              ));
                              $user_purchased_contents = $req->fetchAll();

                              $user_session_purchased_content = in_array($user_session_id, array_column($user_purchased_contents, 'id_users'), TRUE);

                              if ($content_price == 0 || $content_id_user == $user_session_id) {

                                 if ($content_price == 0) {

                           ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price">Free</div>
                                    <div class="content_user"><?= $by_user ?></div>

                                 <?php

                                 } else if ($content_id_user == $user_session_id) {

                                 ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price">Your content</div>
                                    <div class="content_user"><?= $by_user ?></div>

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
                                    <div class="content_user"><?= $by_user ?></div>
                                    <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" class="card__button" onclick="javascript:return buy('<?= $user_session_credits ?>','<?= $content_title ?>','<?= $content_composer ?>','<?= $content_price ?>')">Buy</a>

                                 <?php } else if ($user_session_purchased_content == true) { ?>

                                    <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                    <div class="content_category"><?= $content_category ?></div>
                                    <div class="content_price">Purchased</div>
                                    <div class="content_user"><?= $by_user ?></div>
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
                                 <div class="content_user"><?= $by_user ?></div>
                                 <a data-barba-prevent href="./assets/actions/buy_content_action.php?id=<?= $content_id ?>" class="card__button link_page" onclick="javascript:return login()">Buy</a>

                              <?php

                              } else {

                              ?>

                                 <span class="content_likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>
                                 <div class="content_category"><?= $content_category ?></div>
                                 <div class="content_price">Free</div>
                                 <div class="content_user"><?= $by_user ?></div>
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
   die('Error processing bad or malformed request');
}

?>