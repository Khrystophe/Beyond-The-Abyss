<?php
session_start();
$page = 'single_player';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');

$req = $bdd->prepare('SELECT * FROM contents WHERE id = :id ');
$req->execute(array(
  ':id' => $_GET['id']
));
$contents = $req->fetch();

$join = $bdd->prepare('SELECT users.id, users.name, users.lastname
FROM users
INNER JOIN contents
ON users.id = contents.id_users WHERE contents.id = :contents_id ');
$join->execute(array(
  ':contents_id' => $_GET['id']
));
$author = $join->fetch();


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
              <input type="hidden" id="id" name="id" value="<?= $contents['id'] ?>">

              <label for="title"></label>
              <input type="text" class="inputbox" value="<?= $contents['title'] ?>" placeholder="<?= $contents['title'] ?>" id="title" name="title" />

              <label for="composer"></label>
              <input type="text" class="inputbox" value="<?= $contents['composer'] ?>" placeholder="<?= $contents['composer'] ?>" id="composer" name="composer" />

              <label for="category"></label>
              <select class="inputbox" id="category" name="category">
                <option value="<?= $contents['category'] ?>"><?= $contents['category'] ?></option>
                <option value="Tutorial">Tutorial</option>
                <option value="Performance">Performances</option>
                <option value="Sheet Music">Sheet Music</option>
              </select>

              <label for="level"></label>
              <select class="inputbox" id="level" name="level">
                <option value="<?= $contents['level'] ?>"><?= $contents['level'] ?></option>
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
            <form class="form_action" action="./assets/actions/edit_content_action.php" method="post">

              <label for="id"></label>
              <input type="hidden" id="id" name="id" value="<?= $contents['id'] ?>">

              <label for="comment">Votre message :</label>
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

          <video src="./assets/contents_img/<?= htmlspecialchars($contents['content']); ?>" controls></video>

          <div class="details">
            <h1 class="title1"><?= htmlspecialchars($contents['title']); ?></h1>
            <h2 class="title2"><?= htmlspecialchars($contents['composer']); ?></h2>
          </div>

        </div>
        <div class="player_bottom_bar">
          <span class="likes"><i class="fas fa-thumbs-up"> 109</i></span>

          <?php if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
            if ($_SESSION['users']['id'] == $contents['id_users']) { ?>
              <div class="dropdown">
                <button class="dropbtn">Edit/Delete</button>
                <div class="dropdown-content">
                  <a id="edit_button">Edit Content</a>
                  <a data-barba-prevent href="./assets/actions/delete_action.php?id=<?= $contents['id'] ?>">Delete Content</a>
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
                <span><?= $author['name'] . " " . $author['lastname'] ?></span>
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

        <div class='deck'>
          <div class='single_player_card'>
            <div class='cardHeader'>
              <span class='cardHeader_account'>@hongkongfp</span>
            </div>
            <div class='cardBody'>
              <p class='cardText'>On Tuesday, China’s National People’s Congress Standing Committee unanimously passed a controversial national security law for Hong Kong. The law, which criminalises acts of secession, subversion, foreign interference and terrorism, was promulgated and gazetted on the same day with immediate effect. Details were only revealed late at night as it was directly inserted into the Annex III of the semi-autonomous region’s mini-constitution, bypassing the local legislature.
              </p>
            </div>
          </div>

          <div class='single_player_card'>
            <div class='cardHeader'>
              <span class='cardHeader_account'>@hongkongfp</span>
              <span class='cardHeader_date'>Jul 2 11:49</span>
              <span class='cardStats_stat cardStats_stat-likes'>857 <i class='far fa-heart fa-fw'></i></span>
              <span class='cardStats_stat cardStats_stat-comments'>54 <i class='far fa-comment fa-fw'></i></span>
            </div>
          </div>
        </div>


      </div>
    </div>

  </div>
  <?php
  require('./assets/require/foot.php');
  ?>
</main>


</body>

</html>