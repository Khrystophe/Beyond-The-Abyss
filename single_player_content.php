<?php
session_start();
require('./assets/require/check_data.php');

if (
  isset($get_id)
  && (isset($session_users_id) xor !isset($session_users_id))
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
    $content_description = htmlspecialchars($content['description']);
    $content_likes = htmlspecialchars($content['likes']);
    $content_id_user = htmlspecialchars($content['id_users']);
    $content_author_name = htmlspecialchars($content['name']);
    $content_author_lastname = htmlspecialchars($content['lastname']);

    $comments = getComments($bdd);

    if (isset($session_users_id) && !empty($session_users_id)) {

      $user_session = getUserInformations($bdd, $session_users_id);

      $user_session_id = htmlspecialchars($user_session['id']);
      $user_session_credits = htmlspecialchars($user_session['credits']);


      $user_purchased_contents = getIdUserFromPurchasedContent($bdd, $content_id);

      $user_session_purchased_content = in_array($user_session_id, array_column($user_purchased_contents, 'id_users'), TRUE);
    }
  } else {

    header('location: index.php?error=content_not_buy_or_none_exist');
    die();
  }

  if ((isset($user_session_purchased_content) && $user_session_purchased_content == true) || $content_price == 0 || $content_id_user == $user_session_id) {

    require('./assets/require/head.php');
?>


    <main class="autoAlpha" data-barba="wrapper">

      <div class="min-height" data-barba="container" data-barba-namespace="single_player_content-section">


        <div id="edit_modal" class="modal">
          <div class="modal-content">
            <div class="modal_form">
              <div class="modal_form_content">

                <span class="edit_close">&times;</span>
                <form class="form_action" action="./assets/actions/edit_content_action.php?type=user" method="post" enctype="multipart/form-data">

                  <label for="id"></label>
                  <input type="hidden" id="id" name="id" value="<?= $content_id ?>">

                  <label for="id_users"></label>
                  <input type="hidden" id="id_users" name="id_users" value="<?= $content_id_user ?>">

                  <label for="edit_title"></label>
                  <input type="text" class="inputbox" value="<?= $content_title ?>" placeholder="<?= $content_title ?>" id="edit_title" name="title" />

                  <label for="edit_composer"></label>
                  <input type="text" class="inputbox" value="<?= $content_composer ?>" placeholder="<?= $content_composer ?>" id="edit_composer" name="composer" />

                  <label for="edit_description"></label>
                  <textarea class="inputbox" value="<?= $content_description ?>" id="edit_description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);"><?= $content_description ?></textarea>

                  <label for="edit_category"></label>
                  <select class="inputbox" id="edit_category" name="category">
                    <option value="<?= $content_category ?>"><?= $content_category ?></option>
                    <option value="tutorial">Tutorial</option>
                    <option value="performance">Performances</option>
                    <option value="sheet_music">Sheet Music</option>
                  </select>

                  <label for="edit_level"></label>
                  <select class="inputbox" id="edit_level" name="level">
                    <option value="<?= $content_level ?>"><?= $content_level ?></option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                    <option value="very-hard">Very Hard</option>
                  </select>

                  <label for="single_player_edit_content"></label>
                  <input type="file" class="inputbox" id="single_player_edit_content" name="content" onchange="javascript: return validContent('single_player_edit')" />

                  <label for="free_content">Free Content</label>
                  <input type="checkbox" class="inputbox" id="free_content" name="free_content" />

                  <button type="submit" class="button">Edit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div id="comment_modal" class="modal">
          <div class="modal-content">
            <div class="modal_form">
              <div class="modal_form_content">

                <span class="comment_close">&times;</span>
                <form class="form_action" action="./assets/actions/post_comment_action.php" method="post">

                  <label for="id_comment"></label>
                  <input type="hidden" id="id" name="id_comment" value="<?= $content_id ?>">

                  <label for="comment">Your comment</label>
                  <textarea class="inputbox" id="comment" name="comment"></textarea>

                  <button type="submit" class="button">Post Comment</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php
        if ($content_category == 'tutorial') {
          $content_category = 'Tutorial';
        } else if ($content_category == 'performance') {
          $content_category = 'Performance';
        } else if ($content_category == 'sheet_music') {
          $content_category = 'Sheet Music';
        }
        ?>

        <div class="movie-card">
          <div class="single_player_container">

            <div class="hero">

              <video src="./assets/contents_img/<?= $content_video ?>" controls></video>

              <div class="details">
                <h1 class="title1"><?= $content_title ?></h1>
                <h2 class="title2"><?= $content_composer ?></h2>
                <h2 class="title2"><?= $content_category ?></h2>
              </div>

            </div>
            <div class="player_bottom_bar">
              <span class="likes"><i class="fas fa-thumbs-up"> <?= $content_likes ?></i></span>

              <?php

              if (isset($user_session) && !empty($user_session)) {
                if ($user_session_id != $content_id_user) {

              ?>

                  <button class="dropbtn">
                    <a data-barba-prevent href="./assets/actions/like_action.php?name=content&id=<?= $content_id ?>" onclick="javascript:return likeContent('<?= $content_author_name ?>','<?= $content_author_lastname ?>')">
                      <i class="far fa-thumbs-up">
                      </i>
                    </a>
                  </button>

                <?php } ?>

                <button class="dropbtn" id="comment_button">Comment</button>

                <?php

                if ($user_session_id == $content_id_user) {

                ?>

                  <div class="dropdown">
                    <button class="dropbtn">Edit/Delete</button>
                    <div class="dropdown-content">
                      <a id="edit_button">Edit Content</a>
                      <a data-barba-prevent href="./assets/actions/delete_content_action.php?id=<?= $content_id ?>" onclick="javascript:return deleteAlert()">Delete Content</a>
                    </div>
                  </div>


              <?php

                }
              }

              ?>

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

            <?php

            foreach ($comments as $comment) {

              $comment_id = htmlspecialchars($comment['id']);
              $comment_user_id = htmlspecialchars($comment['id_users']);
              $comment_user_name = htmlspecialchars($comment['name']);
              $comment_user_lastname = htmlspecialchars($comment['lastname']);
              $comment_text = htmlspecialchars($comment['comment']);
              $comment_date = htmlspecialchars($comment['date']);
              $comment_likes = htmlspecialchars($comment['likes']);

              $req = $bdd->prepare('SELECT COUNT(id_users) FROM comments WHERE id_users = :id_users');
              $req->execute(array(
                ':id_users' => $comment_user_id
              ));
              $number_of_user_comments = $req->fetch();

            ?>

              <div class='deck'>
                <div class='single_player_card'>

                  <div class='cardHeader'>
                    <span class='cardHeader_account'><?= $comment_user_name . " " . $comment_user_lastname ?></span>
                    <span class='cardHeader_date'><?= $comment_date ?></span>
                  </div>

                  <div class='cardBody'>

                    <p class='cardText'><?= $comment_text ?></p>

                    <section class='cardStats'>

                      <span class='cardStats_stat cardStats_stat-likes'><?= $comment_likes ?><a data-barba-prevent href="./assets/actions/like_action.php?name=comment&id_comment=<?= $comment_id ?>&id=<?= $content_id ?>" onclick="javascript:return likeComment('<?= $comment_user_name ?>','<?= $comment_user_lastname ?>')"> <i class='far fa-heart fa-fw'></i></a></span>

                      <span class='cardStats_stat cardStats_stat-comments'><?= htmlspecialchars(implode($number_of_user_comments)) ?><i class='far fa-comment fa-fw'></i></span>

                    </section>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </main>

<?php require('./assets/require/foot.php');
  } else {

    header('location: index.php?error=content_not_buy_or_none_exist');
    die();
  }
} else {

  http_response_code(400);
  header('location: index.php?error=processing_bad_or_malformed_request');
  die();
}

?>