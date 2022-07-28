<?php
session_start();
require('./assets/require/co_bdd.php');
$page = 'my_account';
require('./assets/require/head.php');

$req = $bdd->prepare('SELECT * FROM users WHERE id= ?');
$req->execute(array(
    $_SESSION['users']['id']
));
$account = $req->fetchAll();

$req2 = $bdd->prepare('SELECT * FROM contents WHERE id_users=?');
$req2->execute(array(
    $_SESSION['users']['id']
));
$contents = $req2->fetchAll();
?>

<main class="autoAlpha" data-barba="wrapper">
    <div data-barba="container" data-barba-namespace="my_account-section">

        <div class="wrapp">
            <div class="col2 hero">
                <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                <div class="miror">
                    <h1 class="abyss"><span>Au delà de l'abîme</span><br>Votre compte des profondeurs</h1>
                </div>
            </div>
        </div>

        <div class="features">


            <div class="align">
                <?php if (isset($_GET['success']) && !empty($_GET['success'])) {
                    if ($_GET['success'] == 'modificationmotdepasse') { ?>
                        <h5>Mot de passe modifié avec succès</h5>
                    <?php
                    }
                    if ($_GET['success'] == 'modificationmail') { ?>
                        <h5>Adresse mail modifiée avec succès</h5>
                <?php
                    }
                } ?>
                <?php foreach ($account as $acc) { ?>
                    <div>
                        <div>Nom d'utilsateur : <?= $acc['name'] ?> </div>
                        <div>Email : <?= $acc['email'] ?></div>
                        <div>
                            <form>
                                <button class="button" type="text"><a href="formulaireChangementMail.php"> Changer d'adresse mail</a></button>
                            </form>
                        </div>
                        <div>Mot de passe : </div>
                        <div>
                            <form>
                                <button class="button" type="text"><a href="formulaireChangementDeMotDePasse.php"> Changer de mot de passe</a></button>
                            </form>
                        </div>
                    </div>
                <?php } ?>

                <div id="app" class="content">
                    <?php foreach ($contents as $content) { ?>
                        <card class="box" data-image="./assets/contents_img/<?= $content['content'] ?>">
                            <h2 slot="header"><?= $content['title'] ?></h2>
                            <h2 slot="header"><?= $content['composer'] ?></h2>
                            <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <a href="actions/modif.php?id=<?= $content['id'] ?>"><button>Modifier</button></a>
                            <a href="actions/suppression.php?id=<?= $content['id'] ?>"><button>Supprimer</button></a>
                        </card>
                    <?php } ?>
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