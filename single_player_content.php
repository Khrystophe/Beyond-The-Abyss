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
var_dump($content_author);

$req = $bdd->prepare('SELECT  users.name, users.lastname, comments.comment, comments.id, comments.date
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

var_dump($comments);


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

              <label for="title"></label>
              <input type="text" class="inputbox" value="<?= $content['title'] ?>" placeholder="<?= $content['title'] ?>" id="title" name="title" />

              <label for="composer"></label>
              <input type="text" class="inputbox" value="<?= $content['composer'] ?>" placeholder="<?= $content['composer'] ?>" id="composer" name="composer" />

              <label for="category"></label>
              <select class="inputbox" id="category" name="category">
                <option value="<?= $content['category'] ?>"><?= $content['category'] ?></option>
                <option value="Tutorial">Tutorial</option>
                <option value="Performance">Performances</option>
                <option value="Sheet Music">Sheet Music</option>
              </select>

              <label for="level"></label>
              <select class="inputbox" id="level" name="level">
                <option value="<?= $content['level'] ?>"><?= $content['level'] ?></option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
                <option value="very-hard">Very Hard</option>
              </select>

              <label for="content"></label>
              <input type="file" class="inputbox" id="content" name="content" />

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
          <span class="likes"><i class="fas fa-thumbs-up"> 109</i></span>

          <?php if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
            if ($_SESSION['users']['id'] == $content['id_users']) { ?>
              <div class="dropdown">
                <button class="dropbtn">Edit/Delete</button>
                <div class="dropdown-content">
                  <a id="edit_button">Edit Content</a>
                  <a data-barba-prevent href="./assets/actions/delete_action.php?id=<?= $content['id'] ?>">Delete Content</a>
                </div>
              </div>
          <?php }
          } ?>
          <button class="dropbtn" id="comment_button">Comment</button>
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio quibusdam qui, molestiae molestias fuga, beatae enim illo fugit laboriosam fugiat eius magnam ex deserunt esse in corporis sed ipsum error! Minima facere voluptatum nesciunt harum, maiores repudiandae! Repellat nisi esse aperiam dignissimos optio et pariatur. Aperiam voluptatum tempore soluta iusto.<a href="#">read more</a></p>
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
                  <span class='cardStats_stat cardStats_stat-likes'>2155 <i class='far fa-heart fa-fw'></i></span>
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