<?php
$page = "register";
session_start();
require('./assets/require/head.php');
?>

<main class="autoAlpha" data-barba="wrapper">
    <div data-barba="container" data-barba-namespace="register-section">

        <div>
            <?php if (isset($_GET['error']) && !empty($_GET['error'])) {
                if ($_GET['error'] == 'vide') { ?>
                    <h5>Veuillez remplir tous les champs</h5>
                <?php } else if ($_GET['error'] == 'invalidPassword') { ?>
                    <h5>Confirmation de mot de passe incorrecte</h5>
                <?php  } else if ($_GET['error'] == 'adressexistante') { ?>
                    <h5>Adresse email déjà utilisée</h5>
            <?php }
            } ?>
        </div>

        <div class="wrapp">
            <div class="col2 hero">
                <img class="main_logo" src="./assets/img/musicgrise.png" alt="ringOfNotes">
                <div class="miror">
                    <h1 class="abyss"><span>Au delà de l'abîme</span><br>S'inscrire aux profondeurs</h1>
                </div>
            </div>
        </div>

        <div class="features">




            <form class="register_form" action="./assets/actions/register_action.php" method="post">

                <input type="text" name="name" placeholder="Votre prénom">
                <input type="text" name="lastname" placeholder="Votre nom">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="address" placeholder="Votre adresse">
                <input type="text" name="postalCode" placeholder="Votre code postal">
                <input type="text" name="city" placeholder="Votre ville">
                <input type="text" name="country" placeholder="Votre pays">
                <input type="password" name="password" placeholder="Votre mot de passe">
                <input type="password" name="confirmPassword" placeholder="Confirmez votre mot de passe">

                <input type="submit">
            </form>

        </div>
    </div>
</main>

<?php
require('./assets/require/foot.php');
?>

</body>

</html>