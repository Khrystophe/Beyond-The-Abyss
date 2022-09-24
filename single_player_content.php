<?php
session_start();
require('./assets/require/check_data.php');

if (
  isset($get_id)
  && (isset($session_users_id) xor !isset($check_session_users_id))
  && (isset($get_error) xor !isset($check_get_error))
  && (isset($get_success) xor !isset($check_get_success))
) {


  $page = 'single_player';
  require('./assets/require/co_bdd.php');
  require('./assets/require/functions.php');

  $getContentAndUserInformations = getContentAndUserInformations($bdd, $get_id);


  if ($getContentAndUserInformations) {

    require('./assets/require/variables.php');

    $getComments = getComments($bdd, $get_id);


    if (isset($session_users_id) && !empty($session_users_id)) {

      $getUserInformations = getUserInformations($bdd, $session_users_id);

      require('./assets/require/variables.php');

      $getIdUserFromPurchasedContent = getIdUserFromPurchasedContent($bdd, $getContentAndUserInformations_id);

      $user_session_purchased_content = in_array($getUserInformations_id, array_column($getIdUserFromPurchasedContent, 'id_users'));
    }


    if (($getContentAndUserInformations_price > 0 && isset($session_users_id)) || $getContentAndUserInformations_price == 0) {

      if ((isset($user_session_purchased_content) && $user_session_purchased_content == true) || $getContentAndUserInformations_price == 0 || $getContentAndUserInformations_id_user == $getUserInformations_id) {

        require('./assets/require/head.php'); ?>


        <main class="autoAlpha" data-barba="wrapper">
          <div class="min-height" data-barba="container" data-barba-namespace="single_player_content-section">

            <div class="movie-card">
              <div class="single_player_container">

                <div class="hero">

                  <video src="./assets/videos/<?= $getContentAndUserInformations_video ?>" controls controlsList="nodownload"></video>

                  <div class="details">
                    <h1 class="title1"><?= $getContentAndUserInformations_title ?></h1>
                    <h2 class="title2"><?= $getContentAndUserInformations_composer ?></h2>
                    <h2 class="title2"><?= $getContentAndUserInformations_category ?></h2>
                  </div>

                </div>
                <div class="player_bottom_bar">
                  <span class="likes"><i class="far fa-thumbs-up"> <?= $getContentAndUserInformations_likes ?></i></span>


                  <?php if (isset($getUserInformations_id) && !empty($getUserInformations_id)) {


                    if ($getUserInformations_id != $getContentAndUserInformations_id_user) { ?>


                      <button class="dropbtn gray" id="like_content_button" onfocus="javascript:modal('like_content')">Like</button>

                      <div class="dropdown">
                        <button class="drop">Comment/Report</button>
                        <div class="dropdown-content">
                          <button class="button_drop gray" id="comment_button" onfocus="javascript:modal('comment')">Comment</button>
                          <button class="button_drop gray" id="report_button" onfocus="javascript:modal('report')">Report this Content</button>
                        </div>
                      </div>


                    <?php } else { ?>


                      <button class="dropbtn gray" id="comment_button" onfocus="javascript:modal('comment')">Comment</button>

                      <div class="dropdown">
                        <button class="drop">Edit/Delete</button>
                        <div class="dropdown-content">
                          <button class="button_drop gray" id="edit_button" onfocus="javascript:modal('edit')">Edit Content</button>
                          <button class="button_drop gray" id="delete_content_button" onfocus="javascript:modal('delete_content')">Delete Content</button>
                        </div>
                      </div>


                    <?php } ?>


                  <?php } ?>


                </div>

                <div class="description">
                  <div class="column1 gray">
                    <a class="link_page" href="content.php?id=<?= $getContentAndUserInformations_id ?>&name=visitor&category=user_content"><?= $getContentAndUserInformations_author_name . " " . $getContentAndUserInformations_author_lastname ?></a>
                  </div>

                  <div class="column2">
                    <p><?= $getContentAndUserInformations_description ?></p>
                  </div>
                </div>


                <?php foreach ($getComments as $getComment) {

                  require('./assets/require/variables.php');

                  $getNumbersOfcomments = getNumbersOfcomments($bdd, $getComment_user_id);

                  require('./assets/require/variables.php');

                  require('./assets/require/modals_foreach.php'); ?>


                  <div class='deck'>
                    <div class='single_player_card'>

                      <div class='cardHeader'>
                        <span class='cardHeader_account'><?= $getComment_user_name . " " . $getComment_user_lastname ?></span>
                        <span class='cardHeader_date'><?= $getComment_date ?></span>
                      </div>

                      <div class='cardBody'>

                        <p class='cardText'><?= $getComment_text ?></p>

                        <section class='cardStats'>


                          <?php if (isset($session_users_id) && ($session_users_id != $getComment_user_id)) { ?>


                            <span class='cardStats_stat cardStats_stat-comments'><?= $getNumbersOfcomments_from_user ?> <i class='far fa-comment fa-fw'></i></span>

                            <span class='cardStats_stat cardStats_stat-likes'><?= $getComment_likes ?> <i class="far fa-thumbs-up"></i></span>


                          <?php } else if (isset($session_users_id) && ($session_users_id == $getComment_user_id)) { ?>


                            <span class='cardStats_stat cardStats_stat-comments'><?= $getNumbersOfcomments_from_user ?> <i class='far fa-comment fa-fw'></i></span>

                            <span class='cardStats_stat cardStats_stat-likes'><?= $getComment_likes ?> <i class="far fa-thumbs-up"></i></span>


                          <?php } else { ?>


                            <span class='cardStats_stat cardStats_stat-comments'><?= $getNumbersOfcomments_from_user ?> <i class='far fa-comment fa-fw'></i></span>

                            <span class='cardStats_stat cardStats_stat-likes'><?= $getComment_likes ?> <i class="far fa-thumbs-up"></i></span>


                          <?php } ?>


                        </section>
                      </div>


                      <?php if (isset($session_users_id) && ($session_users_id != $getComment_user_id)) { ?>


                        <button class="dropbtn gray" id="like_comment_button<?= $getComment_id ?>" onfocus="javascript: modalForeach('like_comment','<?= $getComment_id ?>')">Like</button>


                      <?php } else if (isset($session_users_id) && ($session_users_id == $getComment_user_id)) { ?>


                        <button class="dropbtn gray" id="edit_comment_button<?= $getComment_id ?>" onfocus="javascript: modalForeach('edit_comment', '<?= $getComment_id ?>')">Edit</button>


                      <?php } ?>


                    </div>
                  </div>


                <?php } ?>


              </div>
            </div>
          </div>
        </main>

        <?php require('./assets/require/foot.php'); ?>


      <?php } else {

        $bdd = null;
        header('location: index.php?error=006110');
        die();
      } ?>


    <?php  } else {

      $bdd = null;
      header('location: index.php?error=006147');
      die();
    } ?>


  <?php } else {

    $bdd = null;
    header('location: index.php?error=00619');
    die();
  } ?>


<?php } else {

  $bdd = null;
  http_response_code(400);
  header('location: index.php?error=00615');
  die();
} ?>