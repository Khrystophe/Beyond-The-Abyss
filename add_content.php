<?php
session_start();
$page = 'add_content';
require('./assets/require/head.php');
var_dump($_SESSION);
?>


<main class="autoAlpha" data-barba="wrapper">
  <div data-barba="container" data-barba-namespace="add_content-section">

    <?php if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {

    ?>
      <div class="wrapp">
        <div class="col2 hero">
          <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
          <div class="miror">
            <h1><span>Au delà de l'abîme</span><br>Ajouter du contenu des profondeurs</h1>
          </div>
        </div>
      </div>


      <div class="features">


        <form class="add_content_form" action="./assets/actions/add_content_action.php" method="post" enctype="multipart/form-data">

          <input type="text" name="title" placeholder="Titre">
          <input type="text" name="composer" placeholder="Compositeur">
          <input type="text" name="price" placeholder="Prix">

          <label for="content">Votre contenu</label>
          <input type="file" id="content" name="content" />

          <select type="text" name="level">
            <option value="easy">Facile</option>
            <option value="medium">Moyen</option>
            <option value="hard">Difficile</option>
            <option value="very-hard">Très difficile</option>
          </select>

          <select type="text" name="category">
            <option value="tuto">Tuto</option>
            <option value="perf">Interprétation</option>
            <option value="sheet">Partition</option>
          </select>

          <input type="submit">
        </form>

      </div>
    <?php } else { ?>
      <div class="wrapp">
        <div class="col2 hero">
          <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
          <div class="miror">
            <h1><span>Au delà de l'abîme</span><br>Connectez-vous ou inscrivez-vous aux profondeurs</h1>
          </div>
        </div>
      </div>

      <div class="features">

        <div class="align2">
          <button class="identification"><a href="./login.php">Connexion</a></button>
          <button class="identification"><a href="./register.php">Incription</a></button>
        </div>
      </div>

    <?php } ?>

  </div>
</main>



<?php require('./assets/require/foot.php');
?>

</body>

</html>