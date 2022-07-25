<?php
session_start();
$page = 'content';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');
var_dump($_SESSION);

$req = $bdd->prepare('SELECT * FROM contents WHERE category = ? ');
$req->execute(array(
    $_GET['category']
));

if ($_GET['category'] == 'tuto' || $_GET['category'] == 'perf' || $_GET['category'] == 'sheet') {
    $contents = $req->fetchAll();
} else {
    header('location: index.php');
}

$join = $bdd->query('SELECT users.id, users.name 
FROM users
INNER JOIN contents
ON users.id = contents.id_users');
$results = $join->fetchAll();

?>
<main id="background" class="autoAlpha" data-barba="wrapper">
    <div data-barba="container" data-barba-namespace="content-section">
        <div class="wrapp">
            <div class="col2 hero">
                <?php if ($_GET['category'] == 'tuto') { ?>

                    <div class="miror">
                        <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
                        <h1><span>Au delà de l'abîme</span><br>Les tutoriels des profondeurs</h1>
                    </div>
                    <style>
                        #background {
                            background: url(./assets/img/piano) no-repeat fixed;
                            background-size: cover;
                            height: 100%;
                        }
                    </style>

                <?php } else if ($_GET['category'] == 'perf') { ?>
                    <div class="miror">
                        <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
                        <h1><span>Au delà de l'abîme</span><br>Les performances des profondeurs</h1>
                    </div>
                    <style>
                        #background {
                            background: url(./assets/img/bride) no-repeat fixed;
                            background-size: cover;
                            height: 100%;
                        }
                    </style>

                <?php } else if ($_GET['category'] == 'sheet') { ?>
                    <div class="miror">
                        <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
                        <h1><span>Au delà de l'abîme</span><br>Les partitions des profondeurs</h1>
                    </div>
                    <style>
                        #background {
                            background: url(./assets/img/sheet-music) no-repeat fixed;
                            background-size: cover;
                            height: 100%;
                        }
                    </style>
                <?php } ?>

            </div>
        </div>


        <div id="app" class="content">
            <?php foreach ($contents as $content) { ?>
                <card class="box" data-image="./assets/contents_img/<?= $content['content'] ?>">
                    <h2 slot="header">composituer<?= $content['title'] ?></h2>
                    <h2 slot="header">composituer<?= $content['title'] ?></h2>
                    <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </card>
            <?php } ?>
        </div>

    </div>
    <?php
    require('./assets/require/foot.php');
    ?>
</main>


</body>

</html>