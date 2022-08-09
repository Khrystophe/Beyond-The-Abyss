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

?>



<main class="autoAlpha" data-barba="wrapper">

  <div data-barba="container" data-barba-namespace="single_player_content-section">


    <div id="edit_modal" class="modal">

      <div class="modal-content">
        <div class="modal_form">
          <div class="modal_form_content">

            <span class="edit_close">&times;</span>
            <form class="form_action" action="./assets/actions/edit_content_action.php" method="post">

              <label for="id"></label>
              <input type="hidden" id="id" name="id" value="<?= $contents['id'] ?>">

              <label for="title"></label>
              <input type="text" class="inputbox" placeholder="Title" id="title" name="title" />

              <label for="composer"></label>
              <input type="text" class="inputbox" placeholder="Composer" id="composer" name="composer" />

              <label for="category"></label>
              <select class="inputbox" id="category" name="category">
                <option value="">--Category--</option>
                <option value="Tutorial">Tutorial</option>
                <option value="Performance">Performances</option>
                <option value="Sheet Music">Sheet Music</option>
              </select>

              <label for="level"></label>
              <select class="inputbox" id="level" name="level">
                <option value="">--Level--</option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
                <option value="very-hard">Very Hard</option>
              </select>

              <button type="submit" class="button">Search</button>
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
                  <a href="#">Delete Content</a>
                </div>
              </div>
            <?php } else { ?>
              <div class="dropdown">
                <button class="dropbtn"><i class="far fa-thumbs-up"></i></button>
              </div>
            <?php }
          } else { ?>
            <div class="dropdown">
              <button class="dropbtn"><i class="far fa-thumbs-up"></i></button>
            </div>
          <?php } ?>
        </div>
        <div class="description">


          <div class="column1">
            <div class="avatars">
              <a href="#" data-tooltip="Person 1" data-placement="top">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/hobbit_avatar1.png" alt="avatar1" />
              </a>
            </div>
            <span class="tag">action</span>
            <span class="tag">fantasy</span>
            <span class="tag">adventure</span>
          </div>

          <div class="column2">
            <p>Bilbo Baggins is swept into a quest to reclaim the lost Dwarf Kingdom of Erebor from the fearsome dragon Smaug. Approached out of the blue by the wizard Gandalf the Grey, Bilbo finds himself joining a company of thirteen dwarves led by the legendary warrior, Thorin Oakenshield. Their journey will take them into the Wild; through... <a href="#">read more</a></p>
          </div>
        </div>

        <div class='deck'>
          <div class='single_player_card'>
            <div class='cardHeader'>
              <i class='fab fa-instagram cardHeader_type'></i>
              <span class='cardHeader_account'>@hongkongfp</span>
              <span class='cardHeader_date'>Jul 1 6:03</span>
            </div>
            <div class='cardBody'>
              <p class='cardText'>On Tuesday, China’s National People’s Congress Standing Committee unanimously passed a controversial national security law for Hong Kong. The law, which criminalises acts of secession, subversion, foreign interference and terrorism, was promulgated and gazetted on the same day with immediate effect. Details were only revealed late at night as it was directly inserted into the Annex III of the semi-autonomous region’s mini-constitution, bypassing the local legislature.
                <span class='cardText_highlight'>#hongkong</span> <span class='cardText_highlight'>#china</span> <span class='cardText_highlight'>#humanrights</span> <span class='cardText_highlight'>#hk</span>
              </p>
              <section class='cardStats'>
                <span class='cardStats_stat cardStats_stat-likes'>2155 <i class='far fa-heart fa-fw'></i></span>
                <span class='cardStats_stat cardStats_stat-comments'>87 <i class='far fa-comment fa-fw'></i></span>
                </span>
            </div>
          </div>

          <div class='single_player_card'>
            <div class='cardHeader'>
              <i class='fab fa-facebook-f cardHeader_type'></i>
              <span class='cardHeader_account'>@hongkongfp</span>
              <span class='cardHeader_date'>Jul 2 11:49</span>
            </div>
            <div class='cardBody'>
              <p class='cardText'>“Liberate Hong Kong; revolution of our times,” is pro-independence, secessionist or subversive, and thus criminalised under the newly-enacted national security law, the government says.
                Law scholar Benny Tai said: "The reality is, under the Hong Kong national security law, every sentence said by every person at every moment could touch the red line and be said as violating the law. How could the national security law only targets a small group of people.”</p>
              <section class='cardStats'>
                <span class='cardStats_stat cardStats_stat-likes'>857 <i class='far fa-heart fa-fw'></i></span>
                <span class='cardStats_stat cardStats_stat-comments'>54 <i class='far fa-comment fa-fw'></i></span>
                <span class='cardStats_stat cardStats_stat-shares'>410 <i class='far fa-share fa-fw'></i></span>
                </span>
            </div>
          </div>

          <div class='single_player_card'>
            <div class='cardHeader'>
              <i class='fab fa-twitter cardHeader_type'></i>
              <span class='cardHeader_account'>@hongkongfp</span>
              <span class='cardHeader_date'>Jul 6 11:26</span>
            </div>
            <div class='cardBody'>
              <p class='cardText'>Hong Kong gov’t tells schools to remove books breaching security law
                <span class='cardText_highlight'>https://t.co/JbyrMwxexU</span>
              </p>
              <section class='cardStats'>
                <span class='cardStats_stat cardStats_stat-likes'>96 <i class='far fa-heart fa-fw'></i></span>
                <span class='cardStats_stat cardStats_stat-retweets'>110 <i class='far fa-retweet fa-fw'></i></span>
                </span>
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