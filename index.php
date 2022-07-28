<?php
session_start();
require('./assets/require/co_bdd.php');
$page = 'index';
require('./assets/require/head.php');

$req = $bdd->query("SELECT * FROM contents WHERE category = 'tuto' ORDER BY RAND() LIMIT 1 ");
$randomTuto = $req->fetch();

$req1 = $bdd->query("SELECT * FROM contents WHERE category = 'perf' ORDER BY RAND() LIMIT 1 ");
$randomPerf = $req1->fetch();

$req2 = $bdd->query("SELECT * FROM contents WHERE category = 'sheet' ORDER BY RAND() LIMIT 1 ");
$randomSheet = $req2->fetch();

?>
<main class="autoAlpha" data-barba="wrapper">
  <div data-barba="container" data-barba-namespace="index-section">

    <div>
      <?php if (isset($_GET['success']) && !empty($_GET['success'])) {
        if ($_GET['success'] == 'creation') { ?>
          <h5>La création de votre compte est un succès</h5>
      <?php }
      } ?>
    </div>

    <div class="wrapp">
      <div class="col2 hero">
        <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
        <div class="miror">
          <h1 class="abyss"><span>Au delà de l'abîme</span><br>La musique des profondeurs</h1>
        </div>
      </div>

    </div>

    <div class="features">
      <a href="content.php?category=tuto">
        <div class="cards one">
          <div class="titles">Tutoriels</div>
          <div class="line one"></div>
          <div class="line two"></div>
          <div class="line three"></div>
        </div>
      </a>
      <a href="content.php?category=perf">
        <div class="cards two">
          <div class="titles">Performances</div>
          <div class="line one"></div>
          <div class="line two"></div>
          <div class="line three"></div>
        </div>
      </a>
      <a href="content.php?category=sheet">
        <div class="cards three">
          <div class="titles">Partitions</div>
          <div class="line one"></div>
          <div class="line two"></div>
          <div class="line three"></div>
        </div>
      </a>

    </div>
    <div class="random_content">
      <div class="content_card" id="tuto">
        <div class="info_section">
          <div class="content_header">
            <video class="content" src="./assets/contents_img/<?php echo $randomTuto['content']; ?>" type="video/mp4"></video>
            <h3><?php echo $randomTuto['title']; ?></h3>
            <h4><?php echo $randomTuto['composer']; ?></h4>
            <span class="see_content"><a href="./single_player_content.php?id=<?= $randomTuto['id'] ?>" class="btn">Voir</a></span>
            <p class="type">Action, Crime, Fantasy</p>
          </div>
          <div class="content_desc">
            <p class="text">
              Set in a world where fantasy creatures live side by side with humans. A human cop is forced to work with an Orc to find a weapon everyone is prepared to kill for.
            </p>
          </div>
          <div class="content_social">
            <ul>
              <li><i class="material-icons">User</i></li>
            </ul>
          </div>
        </div>
        <div class="blur_back tuto_back"></div>
      </div>

      <div class="content_card" id="perf">
        <div class="info_section">
          <div class="content_header">
            <video class="content" src="./assets/contents_img/<?php echo $randomPerf['content']; ?>" type="video/mp4">
            </video>
            <h3><?php echo $randomPerf['title']; ?></h3>
            <h4><?php echo $randomPerf['composer']; ?></h4>
            <span class="see_content"><a href="./single_player_content.php?id=<?= $randomPerf['id'] ?>" class="btn">Voir</a></span>
            <p class="type">Action, Fantasy</p>
          </div>
          <div class="content_desc">
            <p class="text">
              Lara Croft, the fiercely independent daughter of a missing adventurer, must push herself beyond her limits when she finds herself on the island where her father disappeared.
            </p>
          </div>
          <div class="content_social">
            <ul>
              <li><i class="material-icons">User</i></li>
            </ul>
          </div>
        </div>
        <div class="blur_back perf_back"></div>
      </div>

      <div class="content_card" id="sheet">
        <div class="info_section">
          <div class="content_header">
            <video class="content" src="./assets/contents_img/<?php echo $randomSheet['content']; ?>" type="video/mp4">
            </video>
            <h3><?php echo $randomSheet['title']; ?></h3>
            <h4><?php echo $randomSheet['composer']; ?></h4>
            <span class="see_content"><a href="./single_player_content.php?id=<?= $randomSheet['id'] ?>" class="btn">Voir</a></span>
            <p class="type">Action, Adventure</p>
          </div>
          <div class="content_desc">
            <p class="text">
              T'Challa, the King of Wakanda, rises to the throne in the isolated, technologically advanced African nation, but his claim is challenged by a vengeful outsider who was a childhood victim of T'Challa's father's mistake.
            </p>
          </div>
          <div class="content_social">
            <ul>
              <li><i class="material-icons">User</i></li>
            </ul>
          </div>
        </div>
        <div class="blur_back sheet_back"></div>
      </div>
    </div>
    <div class="reverse">
      <div class="contact_presentation">
        <div class="front side">
          <div class="contact_content">
            <h1 class="who">Qui sommes nous ?</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem ab quis praesentium. Voluptate pariatur placeat voluptatum quas consequatur esse provident fugiat, aspernatur.
            </p>
          </div>
        </div>
        <div class="back side">
          <div class="contact_content">
            <h1 class="who">Contact</h1>
            <form class="contact_form">
              <label>Votre nom :</label>
              <input type="text" placeholder="Omar Khattab">
              <label>Votre email :</label>
              <input type="text" placeholder="Example@mail.com">
              <label>Votre message :</label>
              <textarea placeholder="The Subject"></textarea>
              <input type="submit" value="Done">
            </form>
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