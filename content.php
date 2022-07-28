<?php
session_start();
if ($_GET['category'] == 'tuto') {
    $page = 'contentTuto';
} else if ($_GET['category'] == 'perf') {
    $page = 'contentPerf';
} else if ($_GET['category'] == 'sheet') {
    $page = 'contentSheet';
}
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');

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
                <?php if ($_GET['category'] == 'tuto') {
                ?>

                    <div class="miror">
                        <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                        <h1 class="abyss"><span>Au delà de l'abîme</span><br>Les tutoriels des profondeurs</h1>
                    </div>


                <?php } else if ($_GET['category'] == 'perf') {
                ?>
                    <div class="miror">
                        <img class="main_logo" src="./assets/img/musicgrise" alt="ringOfNotes">
                        <h1><span>Au delà de l'abîme</span><br>Les performances des profondeurs</h1>
                    </div>


                <?php } else if ($_GET['category'] == 'sheet') {
                ?>
                    <div class="miror">
                        <img class="main_logo" src="./assets/img/musicgrise" alt="ringOfNotes">
                        <h1><span>Au delà de l'abîme</span><br>Les partitions des profondeurs</h1>
                    </div>

                <?php } ?>

            </div>
        </div>

        <div class="container">
            <?php foreach ($contents as $content) { ?>
                <div class="box">
                    <div class="card">
                        <figure class="card__thumb">
                            <video class="card_video" src="./assets/contents_img/<?= $content['content'] ?>" type="video/mp4">
                            </video>
                            <figcaption class="card__caption">
                                <h1 class="card__title"><?= $content['composer'] ?></h1>
                                <h2 class="card__title"><?= $content['title'] ?></h2>
                                <p class="card__snippet">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <a href="<?= $content['id'] ?>" class="card__button">Read more</a>
                            </figcaption>
                        </figure>
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