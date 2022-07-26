<?php
session_start();
$page = 'index';
require('./assets/require/co_bdd.php');
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
        <img class="main_logo" src="./assets/img/musicgrise" alt="ringOfNotes">
        <div class="miror">
          <h1><span>Au delà de l'abîme</span><br>La musique des profondeurs</h1>
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
    <div class="hero-slider" data-carousel>

      <div class="carousel-cell" style="background-image:url(./assets/contents_img/<?php echo $randomTuto['content']; ?>);">
        <div class="overlay">
        </div>
        <div class="inner">
          <h3 class="subtitle">Tutoriel</h3>
          <h2 class="title"><?php echo $randomTuto['composer']; ?></h2>
          <h2 class="title"><?php echo $randomTuto['title']; ?></h2>
          <a href="./single_player_content.php?id=<?= $randomTuto['id'] ?>" class="btn">Voir</a>
        </div>
      </div>

      <div class="carousel-cell" style="background-image:url(./assets/contents_img/<?php echo $randomPerf['content']; ?>);">
        <div class="overlay">
        </div>
        <div class="inner">
          <h3 class="subtitle">Performance</h3>
          <h2 class="title"><?php echo $randomPerf['composer']; ?></h2>
          <h2 class="title"><?php echo $randomPerf['title']; ?></h2>
          <a href="./single_player_content.php?id=<?= $randomPerf['id'] ?>" class="btn">Voir</a>
        </div>
      </div>

      <div class="carousel-cell" style="background-image:url(./assets/contents_img/<?php echo $randomSheet['content']; ?>);">
        <div class="overlay">
        </div>
        <div class="inner">
          <h3 class="subtitle">Partition</h3>
          <h2 class="title"><?php echo $randomSheet['composer']; ?></h2>
          <h2 class="title"><?php echo $randomSheet['title']; ?></h2>
          <a href="./single_player_content.php?id=<?= $randomSheet['id'] ?>" class="btn">Voir</a>
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