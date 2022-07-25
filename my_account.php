<?php
session_start();
$page = 'my_account';
require('./assets/require/co_bdd.php');
require('./assets/require/head.php');
var_dump($_SESSION);

?>

<main class="autoAlpha" data-barba="wrapper">
    <div data-barba="container" data-barba-namespace="my_account-section">

        <?php
        if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {


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

            <div class="wrapp">
                <div class="col2 hero">
                    <img class="ringThree" src="./assets/img/musicgrise" alt="ringOfNotes">
                    <div class="miror">
                        <h1><span>Au delà de l'abîme</span><br>Votre compte des profondeurs</h1>
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
                </div>
                <div class="align">
                    <?php foreach ($account as $acc) { ?>
                        <ul>
                            <li>Nom d'utilsateur : <?= $acc['name'] ?> </li>
                            <li>Email : <?= $acc['email'] ?></li>
                            <li>
                                <form>
                                    <button type="text"><a href="formulaireChangementMail.php"> Changer d'adresse mail</a></button>
                                </form>
                            </li>
                            <li>Mot de passe : </li>
                            <li>
                                <form>
                                    <button type="text"><a href="formulaireChangementDeMotDePasse.php"> Changer de mot de passe</a></button>
                                </form>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
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


<?php

require('./assets/require/foot.php');
?>

</body>

</html>