<?php
session_start();
$page = 'add_content';
require('./assets/require/head.php');
?>


<main class="autoAlpha" data-barba="wrapper">
   <div data-barba="container" data-barba-namespace="add_content-section">

      <div class="wrapp">
         <div class="col2 hero">
            <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
            <div class="miror">
               <h1 class="abyss"><span>Au delà de l'abîme</span><br>Ajouter du contenu aux profondeurs</h1>
            </div>
         </div>
      </div>



      <div class="form">
         <div class="form_content">

            <div class="leftside">
               <img src="./assets/img/music-g8090509f0_1920.png" alt="" />
            </div>

            <div class="rightside">
               <form class="form_action" action="./assets/actions/add_content_action.php" method="post" enctype="multipart/form-data">

                  <label for="title"></label>
                  <input type="text" class="inputbox" placeholder="Titre" id="title" name="title" required />

                  <label for="composer"></label>
                  <input type="text" class="inputbox" placeholder="Compositeur" id="composer" name="composer" required />

                  <label for="category"></label>
                  <select class="inputbox" id="category" name="category" required>
                     <option value="">--Type de contenu--</option>
                     <option value="tuto">Tutoriel</option>
                     <option value="perf">Performances</option>
                     <option value="sheet">Partition</option>
                  </select>

                  <label for="level"></label>
                  <select class="inputbox" id="level" name="level" required>
                     <option value="">--Niveau--</option>
                     <option value="easy">Facile</option>
                     <option value="medium">Moyen</option>
                     <option value="hard">Difficile</option>
                     <option value="very-hard">Très difficile</option>
                  </select>

                  <label for="content"></label>
                  <input type="file" class="inputbox" id="content" name="content" required />

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