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

      <div class="wrapp">

         <div class="abyss">
            <h1><span>Beyond the abyss</span>
            </h1>
            <h2>Music from the </h2>
            <h2>depths</h2>
            <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
            <div class="main_logo_disc"></div>
         </div>

      </div>

      <div class="separators">
         <div class="separator one"></div>
         <div class="separator two"></div>
         <div class="separator three"></div>
      </div>


      <div>
         <?php if (isset($_GET['success']) && !empty($_GET['success'])) {
            if ($_GET['success'] == 'creation') { ?>
               <h5>The creation of your account is a success</h5>
         <?php }
         } ?>
      </div>

      <div class="features">
         <div class="cards one">
            <div class="titles link_page"><a href="content.php?category=tuto">Tutorials</a></div>
            <div class="line one"></div>
            <div class="line two"></div>
            <div class="line three"></div>
         </div>

         <div class="cards two">
            <div class="titles link_page"><a href="content.php?category=perf">Performances</a></div>
            <div class="line one"></div>
            <div class="line two"></div>
            <div class="line three"></div>
         </div>

         <div class="cards three">
            <div class="titles link_page"><a href="content.php?category=sheet">Sheet music</a></div>
            <div class="line one"></div>
            <div class="line two"></div>
            <div class="line three"></div>
         </div>

      </div>



      <div class="random_content">


         <div class="content_card tuto">

            <div class="gradient tuto">
            </div>

            <div class="info_section tuto">
               <div class="content_header tuto">

                  <div>
                     <h2><?= htmlspecialchars($randomTuto['title']); ?></h2>
                     <h3><?= htmlspecialchars($randomTuto['composer']); ?></h3>

                     <span class="see_content tuto"><a href="./single_player_content.php?id=<?= htmlspecialchars($randomTuto['id']); ?>" class="btn">Voir</a>
                     </span>

                     <div class="type tuto">Classique</div>
                  </div>


               </div>

               <div>
                  <video class="content tuto" src="./assets/contents_img/<?= htmlspecialchars($randomTuto['content']); ?>" type="video/mp4"></video>
               </div>

               <div class="content_desc tuto">
                  <p class="text">
                     Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur veritatis itaque illum accusantium ratione voluptatem autem culpa aut est possimus!
                  </p>
               </div>

               <div class="content_social tuto">
                  <ul>
                     <li><i class="material-icons">User</i></li>
                  </ul>
               </div>

            </div>

            <div class="blur_back tuto_back"></div>
         </div>



         <div class="content_card perf">

            <div class="gradient perf">
            </div>

            <div class="info_section perf">
               <div class="content_header perf">

                  <div>
                     <h2><?= htmlspecialchars($randomPerf['title']); ?></h2>
                     <h3><?= htmlspecialchars($randomPerf['composer']); ?></h3>

                     <span class="see_content perf"><a href="./single_player_content.php?id=<?= htmlspecialchars($randomPerf['id']); ?>" class="btn">Voir</a></span>

                     <div class="type perf">Jazz</div>
                  </div>

               </div>

               <div>
                  <video class="content perf" src="./assets/contents_img/<?= htmlspecialchars($randomPerf['content']); ?>" type="video/mp4">
                  </video>
               </div>

               <div class="content_desc perf">
                  <p class="text">
                     Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rerum ducimus autem enim delectus veritatis ab, possimus recusandae? Sequi, eligendi consequatur.
                  </p>
               </div>

               <div class="content_social perf">
                  <ul>
                     <li><i class="material-icons">User</i></li>
                  </ul>
               </div>

            </div>

            <div class="blur_back perf_back"></div>
         </div>



         <div class="content_card sheet">

            <div class="gradient sheet">
            </div>

            <div class="info_section sheet">
               <div class="content_header sheet">

                  <div>
                     <h2><?= htmlspecialchars($randomSheet['title']); ?></h2>
                     <h3><?= htmlspecialchars($randomSheet['composer']); ?></h3>

                     <span class="see_content sheet"><a href="./single_player_content.php?id=<?= htmlspecialchars($randomSheet['id']); ?>" class="btn">Voir</a></span>

                     <div class="type sheet">Métal</div>
                  </div>

               </div>

               <div>
                  <video class="content sheet" src="./assets/contents_img/<?= htmlspecialchars($randomSheet['content']); ?>" type="video/mp4">
                  </video>
               </div>

               <div class="content_desc sheet">
                  <p class="text">
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus non ipsa quas dolorum accusantium iure quae esse debitis id tempore!
                  </p>
               </div>

               <div class="content_social sheet">
                  <ul>
                     <li><i class="material-icons">User</i></li>
                  </ul>
               </div>

            </div>

            <div class="blur_back sheet_back"></div>
         </div>



      </div>



      <div id="contact" class="reverse">
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
                     <label for="contactName">Votre nom :</label>
                     <input type="text" id="contactName">
                     <label for="contactMail">Votre email :</label>
                     <input type="text" id="contactMail">
                     <label for="contactMessage">Votre message :</label>
                     <textarea id="contactMessage"></textarea>
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