<?php
session_start();
require('./assets/require/check_data.php');

if (
  isset($get_id)
  && (isset($session_users_id) xor !isset($session_users_id))
) {

  if (
    (isset($get_error) xor !isset($check_get_error))
    &&
    (isset($get_success) xor !isset($check_get_success))
  ) {

    $page = 'single_player';
    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');

    $content = getContentAndUserInformations($bdd, $get_id);

    if ($content) {

      $content_id = htmlspecialchars($content['id']);
      $content_title = htmlspecialchars($content['title']);
      $content_composer = htmlspecialchars($content['composer']);
      $content_category = htmlspecialchars($content['category']);
      $content_level = htmlspecialchars($content['level']);
      $content_video = htmlspecialchars($content['content']);
      $content_price = htmlspecialchars($content['price']);
      $content_description = nl2br(htmlspecialchars($content['description']));
      $content_likes = htmlspecialchars($content['likes']);
      $content_id_user = htmlspecialchars($content['id_users']);
      $content_author_name = htmlspecialchars($content['name']);
      $content_author_lastname = htmlspecialchars($content['lastname']);

      $comments = getComments($bdd, $get_id);

      if (isset($session_users_id) && !empty($session_users_id)) {

        $user_session = getUserInformations($bdd, $session_users_id);

        $user_session_id = htmlspecialchars($user_session['id']);
        $user_session_credits = htmlspecialchars($user_session['credits']);

        $user_purchased_contents = getIdUserFromPurchasedContent($bdd, $content_id);

        $user_session_purchased_content = in_array($user_session_id, array_column($user_purchased_contents, 'id_users'));
      }


      if (($content_price > 0 && isset($session_users_id)) || $content_price == 0) {


        if ((isset($user_session_purchased_content) && $user_session_purchased_content == true) || $content_price == 0 || $content_id_user == $user_session_id) {

          require('./assets/require/head.php'); ?>


          <main class="autoAlpha" data-barba="wrapper">
            <div class="min-height" data-barba="container" data-barba-namespace="single_player_content-section">


              <?php if ($content_category == 'tutorial') {
                $content_category = 'Tutorial';
              } else if ($content_category == 'performance') {
                $content_category = 'Performance';
              } else if ($content_category == 'sheet_music') {
                $content_category = 'Sheet Music';
              } ?>


              <div class="movie-card">
                <div class="single_player_container">

                  <div class="hero">

                    <video src="./assets/videos/<?= $content_video ?>" controls></video>

                    <div class="details">
                      <h1 class="title1"><?= $content_title ?></h1>
                      <h2 class="title2"><?= $content_composer ?></h2>
                      <h2 class="title2"><?= $content_category ?></h2>
                    </div>

                  </div>
                  <div class="player_bottom_bar">
                    <span class="likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>


                    <?php if (isset($user_session) && !empty($user_session)) {


                      if ($user_session_id != $content_id_user) { ?>


                        <button class="dropbtn">
                          <a data-barba-prevent href="./assets/actions/like_action.php?name=content&id=<?= $content_id ?>" onclick="javascript:return likeContent('<?= $content_author_name ?>','<?= $content_author_lastname ?>')">
                            <i class="far fa-thumbs-up">
                            </i>
                          </a>
                        </button>

                        <div class="dropdown">
                          <button class="dropbtn">Comment/Report</button>
                          <div class="dropdown-content">
                            <a id="comment_button">Comment</a>
                            <a id="report_button">Report this Content</a>
                          </div>
                        </div>


                      <?php } else { ?>


                        <button class="dropbtn" id="comment_button">Comment</button>

                        <div class="dropdown">
                          <button class="dropbtn">Edit/Delete</button>
                          <div class="dropdown-content">
                            <a id="edit_button">Edit Content</a>
                            <a data-barba-prevent href="./assets/actions/delete_content_action.php?id=<?= $content_id ?>&type=user" onclick="javascript:return deleteAlert()">Delete Content</a>
                          </div>
                        </div>


                      <?php } ?>


                    <?php } ?>


                  </div>

                  <div class="description">
                    <div class="column1">

                      <div class="avatars">
                        <a href="#" data-tooltip="Person 1" data-placement="top">
                          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/hobbit_avatar1.png" alt="avatar1" />
                          <span><?= $content_author_name . " " . $content_author_lastname ?></span>
                        </a>
                      </div>

                      <span class="tag">action</span>
                      <span class="tag">fantasy</span>
                      <span class="tag">adventure</span>

                    </div>

                    <div class="column2">
                      <p><?= $content_description ?></p>
                    </div>
                  </div>


                  <?php foreach ($comments as $comment) {

                    $comment_id = htmlspecialchars($comment['id']);
                    $comment_user_id = htmlspecialchars($comment['id_users']);
                    $comment_user_name = htmlspecialchars($comment['name']);
                    $comment_user_lastname = htmlspecialchars($comment['lastname']);
                    $comment_text = nl2br(htmlspecialchars($comment['comment']));
                    $comment_date = htmlspecialchars($comment['date']);
                    $comment_likes = htmlspecialchars($comment['likes']);

                    $number_of_user_comments = getNumbersOfcomments($bdd, $comment_user_id);

                    $number_of_user_comments = htmlspecialchars(implode($number_of_user_comments));


                    require('./assets/require/modals_foreach.php'); ?>


                    <div class='deck'>
                      <div class='single_player_card'>

                        <div class='cardHeader'>
                          <span class='cardHeader_account'><?= $comment_user_name . " " . $comment_user_lastname ?></span>
                          <span class='cardHeader_date'><?= $comment_date ?></span>
                        </div>

                        <div class='cardBody'>

                          <p class='cardText'><?= $comment_text ?></p>

                          <section class='cardStats'>


                            <?php if (isset($session_users_id) && ($session_users_id != $comment_user_id)) { ?>


                              <span class='cardStats_stat cardStats_stat-comments'><?= $number_of_user_comments ?> <i class='far fa-comment fa-fw'></i></span>

                              <span class='cardStats_stat cardStats_stat-likes'><?= $comment_likes ?><a data-barba-prevent href="./assets/actions/like_action.php?name=comment&id_comment=<?= $comment_id ?>&id=<?= $content_id ?>" onclick="javascript:return likeComment('<?= $comment_user_name ?>','<?= $comment_user_lastname ?>')"> <i class='far fa-heart fa-fw'></i></a></span>


                            <?php } else if (isset($session_users_id) && ($session_users_id == $comment_user_id)) { ?>


                              <span class='cardStats_stat cardStats_stat-comments'><?= $number_of_user_comments ?> <i class='far fa-comment fa-fw'></i></span>

                              <span class='cardStats_stat cardStats_stat-likes'><?= $comment_likes ?><i class='far fa-heart fa-fw'></i></span>

                              <button class="dropbtn" id="edit_comment_button<?= $comment_id ?>" onclick="javascript: editComment('<?= $comment_id ?>')">Edit</button>


                            <?php } else { ?>


                              <span class='cardStats_stat cardStats_stat-comments'><?= $number_of_user_comments ?> <i class='far fa-comment fa-fw'></i></span>

                              <span class='cardStats_stat cardStats_stat-likes'><?= $comment_likes ?><i class='far fa-heart fa-fw'></i></span>


                            <?php } ?>


                          </section>
                        </div>
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


<?php } else {

  $bdd = null;
  http_response_code(400);
  header('location: index.php?error=006150');
  die();
} ?>