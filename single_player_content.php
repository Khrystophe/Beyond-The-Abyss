<?php
session_start();
$page = 'single_player';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');

$req = $bdd->prepare('SELECT * FROM contents WHERE id = :id ');
$req->execute(array(
  ':id' => $_GET['id']
));
$content = $req->fetch();

$req = $bdd->prepare('SELECT  users.name, users.lastname
FROM users
INNER JOIN contents
ON users.id = contents.id_users WHERE contents.id = :contents_id ');
$req->execute(array(
  ':contents_id' => $_GET['id']
));
$content_author = $req->fetch();

$req = $bdd->prepare('SELECT  users.name, users.lastname, comments.comment, comments.id, comments.date, comments.likes
FROM comments
INNER JOIN contents
ON comments.id_contents = contents.id
INNER JOIN users
ON comments.id_users = users.id
WHERE comments.id_contents  = :contents_id ');
$req->execute(array(
  ':contents_id' => $_GET['id']
));
$comments = $req->fetchAll();

// $req = $bdd->query('SELECT id_users FROM comments');
// $user_comments = $req->fetchAll();
// var_dump($user_comments);
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

              <label for="edit_title"></label>
              <input type="text" class="inputbox" value="<?= $content['title'] ?>" placeholder="<?= $content['title'] ?>" id="edit_title" name="title" />

              <label for="edit_composer"></label>
              <input type="text" class="inputbox" value="<?= $content['composer'] ?>" placeholder="<?= $content['composer'] ?>" id="edit_composer" name="composer" />

              <label for="edit_description"></label>
              <textarea class="inputbox" placeholder="Description" id="edit_description" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>

              <script>
                function MaxLengthDescription(description, maxlength) {
                  if (description.value.length > maxlength) {
                    description.value = description.value.substring(0, maxlength);
                    alert('Votre texte ne doit pas dépasser ' + maxlength + ' caractères!');
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
                <a data-barba-prevent href="./assets/actions/like_action.php?name=content&id=<?= $content['id'] ?>">
                  <i class="far fa-thumbs-up">
                  </i>
                </a>
              </button>
            <?php } ?>

            <button class="dropbtn" id="comment_button">Comment</button>

            <?php if ($_SESSION['users']['id'] == $content['id_users']) { ?>
              <div class="dropdown">
                <button class="dropbtn">Edit/Delete</button>
                <div class="dropdown-content">
                  <a id="edit_button">Edit Content</a>
                  <a data-barba-prevent href="./assets/actions/delete_action.php?id=<?= $content['id'] ?>">Delete Content</a>
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

        <?php foreach ($comments as $comment) { ?>
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
                  <span class='cardStats_stat cardStats_stat-likes'><?= $comment['likes'] ?><a data-barba-prevent href="./assets/actions/like_action.php?name=comment&id_comment=<?= $comment['id'] ?>&id=<?= $content['id'] ?>"> <i class='far fa-heart fa-fw'></i></a></span>
                  <span class='cardStats_stat cardStats_stat-comments'>87 <i class='far fa-comment fa-fw'></i></span>
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