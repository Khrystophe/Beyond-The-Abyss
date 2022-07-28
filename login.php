<?php
$page = 'login';
session_start();
require('./assets/require/head.php');
?>

<main class="autoAlpha" data-barba="wrapper">
    <div data-barba="container" data-barba-namespace="login-section">

        <div>
            <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
                if ($_GET['error'] == 'password') { ?>
                    <h5>Mot de passe incorrect</h5>
                <?php } else if ($_GET['error'] == 'nonexist') { ?>
                    <h5>Cet utilisateur n'existe pas</h5>
            <?php }
            } ?>
        </div>

        <div class="wrapp">
            <div class="col2 hero">
                <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                <div class="miror">
                    <h1 class="abyss"><span>Au delà de l'abîme</span><br>Se connecter aux profondeurs</h1>
                </div>
            </div>
        </div>

        <div class="login">
            <form class="login_form" action="./assets/actions/login_action.php" method="post">
                <h3>Connexion</h3>

                <input class="login_input" type="text" placeholder="Email" name="email" required>

                <input class="login_input" type="password" placeholder="Mot de passe" name="password" required>

                <button class="login_button" type="submit">Se connecter</button>
            </form>
        </div>
    </div>
    <?php
    require('./assets/require/foot.php');
    ?>
</main>


</body>

</html>