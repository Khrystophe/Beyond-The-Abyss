<?php
$page = 'index';
require('./assets/require/head.php');
?>
<div class="wrapper">

  <main>
    <div class="col2 hero">
      <h1><span>Au delà de l'abîme</span><br>La musique des profondeurs</h1>
      <div class="form">
        <label for="email">Notifiez-moi en cas de nouveau contenu</label>
        <div class="col2">
          <input type="text" id="email" placeholder="Adresse Email">
          <input type="submit" value="Ajoutez-moi">
        </div>
      </div>
    </div>
    <div class="features">
      <div class="card">
        <p class="title">Tutoriels</p>
        <img src="./assets/img/piano-1846719_1920.jpg" class="desc" />
      </div>
      <div class="card">
        <p class="title">Performances</p>
        <img src="./assets/img/bride-301814_1920.jpg" class="desc" />
        <p class="desc">Use our Headless API to build truly custom frontends.</p>
      </div>
      <div class="card">
        <p class="title">Partitions</p>
        <img src="./assets/img/sheet-music-4121936_1920.jpg" class="desc" />
        <p class="desc">Offer parity pricing, and leave the headache of processing to us.</p>
      </div>

    </div>
  </main>
</div>

<?php
require('./assets/require/foot.php');
?>