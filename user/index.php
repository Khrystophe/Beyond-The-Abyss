<?php
$page = 'index';
require('./assets/require/head.php');
?>
<div class="wrapp">
  <div class="loading-screen">
    <div class="ringOne">
      <img src="./assets/img/ring.png" alt="ring">
    </div>
    <div class="ringTwo">
      <img src="./assets/img/ring.png" alt="ring">
    </div>
  </div>
  <main data-barba="container" data-barba-namespace="index-section">
    <div class="col2 hero">
      <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
      <h1><span>Au delà de l'abîme</span><br>La musique des profondeurs</h1>
    </div>

    <div class="features">
      <div class="card one">
        <p class="title">Tutoriels</p>
        <p class="line one"></p>
        <p class="line two"></p>
        <p class="line three"></p>
      </div>
      <div class="card two">
        <p class="title">Performances</p>
        <p class="line one"></p>
        <p class="line two"></p>
        <p class="line three"></p>
      </div>
      <div class="card three">
        <p class="title">Partitions</p>
        <p class="line one"></p>
        <p class="line two"></p>
        <p class="line three"></p>
      </div>

    </div>
  </main>
</div>
<?php
require('./assets/require/foot.php');
?>