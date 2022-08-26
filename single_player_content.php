<?php
session_start();
$page = 'single_player';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');
require('./assets/actions/functions.php');

$content = getContent();
$content_author = getContentAuthorInformations();
$comments = getComments();
?>



<main class="autoAlpha" data-barba="wrapper">

  <div data-barba="container" data-barba-namespace="single_player_content-section">


    <div id="edit_modal" class="modal">

      <div class="modal-content">
        <div class="modal_form">
          <div class="modal_form_content">

            <span class="edit_close">&times;</span>
            <form class="form_action" action="./assets/actions/edit_content_action.php" method="post" enctype="multipart/form-data">

              <label for="id"></label>
              <input type="hidden" id="id" name="id" value="<?= $content['id'] ?>">

              <label for="id_users"></label>
              <input type="hidden" id="id_users" name="id_users" value="<?= $content['id_users'] ?>">

              <label for="edit_title"></label>
              <input type="text" class="inputbox" value="<?= $content['title'] ?>" placeholder="<?= $content['title'] ?>" id="edit_title" name="title" />

              <label for="edit_composer"></label>
              <input type="text" class="inputbox" value="<?= $content['composer'] ?>" placeholder="<?= $content['composer'] ?>" id="edit_composer" name="composer" />

              <label for="edit_description"></label>
              <textarea class="inputbox" value="<?= $content['description'] ?>" id="edit_description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);"><?= $content['description'] ?></textarea>

              <script>
                function MaxLengthDescription(description, maxlength) {
                  if (description.value.length > maxlength) {
                    description.value = description.value.substring(0, maxlength);
                    alert('Maximum ' + maxlength + ' characters!');
                  }
                }
              </script>

              <label for="edit_category"></label>
              <select class="inputbox" id="edit_category" name="category">
                <option value="<?= $content['category'] ?>"><?= $content['category'] ?></option>
                <option value="Tutorial">Tutorial</option>
                <option value="Performance">Performances</option>
                <option value="Sheet Music">Sheet Music</option>
              </select>

              <label for="edit_level"></label>
              <select class="inputbox" id="edit_level" name="level">
                <option value="<?= $content['level'] ?>"><?= $content['level'] ?></option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
                <option value="very-hard">Very Hard</option>
              </select>

              <label for="edit_content"></label>
              <input type="file" class="inputbox" id="edit_content" name="content" />

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

              <label for="id"></label>
              <input type="hidden" id="id" name="id" value="<?= $content['id'] ?>">

              <label for="comment">Your comment</label>
              <textarea class="inputbox" id="comment" name="comment"></textarea>

              <button type="submit" class="button">Post Comment</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="movie-card">
      <div class="single_player_container">

        <div class="hero">

          <video src="./assets/contents_img/<?= htmlspecialchars($content['content']); ?>" controls></video>

          <div class="details">
            <h1 class="title1"><?= htmlspecialchars($content['title']); ?></h1>
            <h2 class="title2"><?= htmlspecialchars($content['composer']); ?></h2>
          </div>

        </div>
        <div class="player_bottom_bar">
          <span class="likes"><i class="fas fa-thumbs-up"><?= $content['likes'] ?></i></span>

          <?php if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
            if ($_SESSION['users']['id'] != $content['id_users']) { ?>

              <button class="dropbtn">
                <a data-barba-prevent href="./assets/actions/like_action.php?name=content&id=<?= $content['id'] ?>" onclick="return likeContent()">
                  <i class="far fa-thumbs-up">
                  </i>
                </a>
                <script>
                  function likeContent() {
                    return confirm("Like <?= $content_author['name'] . " " . $content_author['lastname'] ?>'s comments ?")
                  }
                </script>
              </button>
            <?php } ?>

            <button class="dropbtn" id="comment_button">Comment</button>

            <?php if ($_SESSION['users']['id'] == $content['id_users']) { ?>
              <div class="dropdown">
                <button class="dropbtn">Edit/Delete</button>
                <div class="dropdown-content">
                  <a id="edit_button">Edit Content</a>
                  <a data-barba-prevent href="./assets/actions/delete_action.php?id=<?= $content['id'] ?>" onclick="return alert()">Delete Content</a>

                  <script>
                    function alert() {
                      return confirm("Do you wand to delete these content ?")
                    }
                  </script>

                </div>
              </div>
          <?php }
          } ?>
        </div>

        <div class="description">


          <div class="column1">
            <div class="avatars">
              <a href="#" data-tooltip="Person 1" data-placement="top">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/hobbit_avatar1.png" alt="avatar1" />
                <span><?= htmlspecialchars($content_author['name']) . " " . htmlspecialchars($content_author['lastname']) ?></span>
              </a>
            </div>
            <span class="tag">action</span>
            <span class="tag">fantasy</span>
            <span class="tag">adventure</span>
          </div>

          <div class="column2">
            <p><?= htmlspecialchars($content['description']) ?></p>
          </div>
        </div>

        <?php foreach ($comments as $comment) {

          $req = $bdd->query('SELECT COUNT(id_users) FROM comments WHERE id_users =' . $comment['id_users']);
          $number_of_user_comments = $req->fetch();
        ?>
          <div class='deck'>

            <div class='single_player_card'>

              <div class='cardHeader'>

                <span class='cardHeader_account'><?= htmlspecialchars($comment['name']) . " " . htmlspecialchars($comment['lastname']) ?></span>

                <span class='cardHeader_date'><?= htmlspecialchars($comment['date']) ?></span>
              </div>

              <div class='cardBody'>

                <p class='cardText'><?= htmlspecialchars($comment['comment']) ?>
                </p>

                <section class='cardStats'>

                  <span class='cardStats_stat cardStats_stat-likes'><?= htmlspecialchars($comment['likes']) ?><a data-barba-prevent href="./assets/actions/like_action.php?name=comment&id_comment=<?= htmlspecialchars($comment['id']) ?>&id=<?= htmlspecialchars($content['id']) ?>" onclick="return likeComment()"> <i class='far fa-heart fa-fw'></i></a></span>

                  <script>
                    function likeComment() {
                      return confirm("Like <?= $comment['name'] . " " . $comment['lastname'] ?>'s comments ?")
                    }
                  </script>

                  <span class='cardStats_stat cardStats_stat-comments'><?= htmlspecialchars(implode($number_of_user_comments)) ?><i class='far fa-comment fa-fw'></i></span>
                  </span>
                </section>
              </div>
            </div>
          </div>
        <?php } ?>


      </div>
    </div>

  </div>
  <?php
  require('./assets/require/foot.php');
  ?>
</main>


</body>

</html>