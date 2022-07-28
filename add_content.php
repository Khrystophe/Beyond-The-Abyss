<?php
$page = 'add_content';
session_start();
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');
?>


<main class="autoAlpha" data-barba="wrapper">
  <div data-barba="container" data-barba-namespace="add_content-section">

    <div class="wrapp">
      <div class="col2 hero">
        <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
        <div class="miror">
          <h1 class="abyss"><span>Au delà de l'abîme</span><br>Ajouter du contenu des profondeurs</h1>
        </div>
      </div>
    </div>



    <div class="add">
      <div class="add_content">
        <div class="leftside">
          <img src="./assets/img/musicgrise.png" alt="" />
        </div>
        <div class="rightside">
          <form action="./assets/actions/add_content_action.php" method="post" enctype="multipart/form-data">

            <h1>Ajouter du contenu</h1>
            <p>Titre</p>
            <input type="text" class="inputbox" name="title" required />
            <p>Compositeur</p>
            <input type="text" class="inputbox" name="composer" required />

            <p>Type de contenu</p>
            <select class="inputbox" name="category" required>
              <option value="">--Choisissez--</option>
              <option value="tuto">Tutoriel</option>
              <option value="perf">Performances</option>
              <option value="sheet">Partition</option>
            </select>

            <p>Niveau</p>
            <select class="inputbox" name="level" required>
              <option value="">--Choisissez--</option>
              <option value="easy">Facile</option>
              <option value="medium">Moyen</option>
              <option value="hard">Difficile</option>
              <option value="very-hard">Très difficile</option>
            </select>

            <p>Votre contenu</p>
            <input type="file" class="inputbox" name="content" required />

            <p></p>
            <button type="submit" class="button">Ajouter</button>
          </form>
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