<?php
session_start();
$page = 'login';
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
                <?php } else if ($_GET['error'] == 'empty') { ?>
                    <h5>Veuillez remplir tous les champs</h5>
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

        <div class="features">

            <?php if (isset($_GET['page']) && !empty($_GET['page'])) {
                if ($_GET['page'] == 'add_content') { ?>
                    <form class="login_form" action="./assets/actions/login_action.php?page=add_content" method="post">

                        <input type="email" name="email" placeholder="Votre email">
                        <input type="password" name="password" placeholder="Votre mot de passe">

                        <input type="submit">
                    </form>
                <?php } else if ($_GET['page'] == 'account') { ?>
                    <form class="login_form" action="./assets/actions/login_action.php?page=account" method="post">

                        <input type="email" name="email" placeholder="Votre email">
                        <input type="password" name="password" placeholder="Votre mot de passe">

                        <input type="submit">
                    </form>
                <?php }
            } else { ?>
                <form class="login_form" action="./assets/actions/login_action.php" method="post">

                    <input type="email" name="email" placeholder="Votre email">
                    <input type="password" name="password" placeholder="Votre mot de passe">

                    <input type="submit">
                </form><?php } ?>
        </div>

    </div>
</main>

<?php
require('./assets/require/foot.php');
?>

</body>

</html>