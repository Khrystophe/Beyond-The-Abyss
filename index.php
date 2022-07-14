<?php
$page = 'index';
require('./assets/require/head.php');
?>
<main data-barba="wrapper">
  <div data-barba="container" data-barba-namespace="index-section">

    <div class="wrapp">
      <!-- <div class="loading-screen">
        <div class="ringOne">
          <img src="./assets/img/ring.png" alt="ring">
        </div>
        <div class="ringTwo">
          <img src="./assets/img/ring.png" alt="ring">
        </div>
      </div> -->
      <div class="col2 hero">
        <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
        <h1><span>Au delà de l'abîme</span><br>La musique des profondeurs</h1>
      </div>
    </div>

    <div class="features">
      <div class="cards one">
        <div class="titles">Tutoriels</div>
        <div class="line one"></div>
        <div class="line two"></div>
        <div class="line three"></div>
      </div>
      <div class="cards two">
        <div class="titles">Performances</div>
        <div class="line one"></div>
        <div class="line two"></div>
        <div class="line three"></div>
      </div>
      <div class="cards three">
        <div class="titles">Partitions</div>
        <div class="line one"></div>
        <div class="line two"></div>
        <div class="line three"></div>
      </div>

    </div>
    <div class="hero-slider" data-carousel>
      <div class="carousel-cell" style="background-image:url(https://68.media.tumblr.com/57836ee52bc9355ad7c5fed5abf91ccc/tumblr_oiboo6MaRS1slhhf0o1_1280.jpg);">
        <div class="overlay">
        </div>
        <div class="inner">
          <h3 class="subtitle">Tutoriel</h3>
          <h2 class="title">Compositeur</h2>
          <a href="https://flickity.metafizzy.co/" target="_blank" class="btn">Voir</a>
        </div>
      </div>
      <div class="carousel-cell" style="background-image:url(https://68.media.tumblr.com/c40636a5a0d4aa39c335c8db40d2144f/tumblr_omc7z7Xv8N1slhhf0o1_1280.jpg);">
        <div class="overlay"></div>
        <div class="inner">
          <h3 class="subtitle">Performance</h3>
          <h2 class="title">Interprète</h2>
          <a href="https://flickity.metafizzy.co/" target="_blank" class="btn">Voir</a>
        </div>
      </div>
      <div class="carousel-cell" style="background-image:url(https://68.media.tumblr.com/3beb13a4167aa8b5c4743eac17bf351c/tumblr_o8nyvtiHfC1slhhf0o1_1280.jpg);">
        <div class="overlay"></div>
        <div class="inner">
          <h3 class="subtitle">Partition</h3>
          <h2 class="title">Compositeur</h2>
          <a href="https://flickity.metafizzy.co/" target="_blank" class="btn">Voir</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
require('./assets/require/foot.php');
?>

</body>

</html>