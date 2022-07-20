<?php
session_start();
$page = 'index';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');


$req = $bdd->query("SELECT * FROM contents ORDER BY RAND() LIMIT 3 ");
$random = $req->fetchAll();

?>
<main class="autoAlpha" data-barba="wrapper">
  <div data-barba="container" data-barba-namespace="index-section">

    <div class="wrapp">
      <div class="loading-screen">
        <!-- <div class="ringOne">
          <img src="./assets/img/ring.png" alt="ring">
        </div>
        <div class="ringTwo">
          <img src="./assets/img/ring.png" alt="ring">
        </div> -->
      </div>

      <div class="col2 hero">
        <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
        <div class="miror">
          <h1><span>Au delà de l'abîme</span><br>La musique des profondeurs</h1>
        </div>
      </div>

    </div>

    <div class="features">
      <a href="./content.php?category=tuto">
        <div class="cards one">
          <div class="titles">Tutoriels</div>
          <div class="line one"></div>
          <div class="line two"></div>
          <div class="line three"></div>
        </div>
      </a>
      <a href="./content.php?category=perf">
        <div class="cards two">
          <div class="titles">Performances</div>
          <div class="line one"></div>
          <div class="line two"></div>
          <div class="line three"></div>
        </div>
      </a>
      <a href="./content.php?category=sheet">
        <div class="cards three">
          <div class="titles">Partitions</div>
          <div class="line one"></div>
          <div class="line two"></div>
          <div class="line three"></div>
        </div>
      </a>

    </div>
    <div class="hero-slider" data-carousel>
      <?php foreach ($random as $rand) { ?>
        <div class="carousel-cell" style="background-image:url(./assets/contents_img/<?php echo $rand['content']; ?>);">
          <div class="overlay">
          </div>
          <div class="inner">
            <h3 class="subtitle">Tutoriel</h3>
            <h2 class="title">Compositeur</h2>
            <a href="./single_player_content.php?id=<?= $rand['id'] ?>" class="btn">Voir</a>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
  <?php
  require('./assets/require/foot.php');
  ?>
</main>


</body>

</html>