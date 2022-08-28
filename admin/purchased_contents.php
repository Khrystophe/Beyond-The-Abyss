<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/actions/functions.php');

        $purchased_contents = getPurchased_contents();
?>

        <h1>Purchased contents</h1>

        <br>
        <!-- Button trigger modal -->



        <table class="table tritable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">id_contents</th>
                    <th scope="col">id_users</th>
                    <th scope="col">original price</th>
                    <th scope="col">buyer repayment</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($purchased_contents as $content) { ?>

                    <tr>
                        <td scope="col"><?= $content['id'] ?></td>
                        <td scope="col"><?= $content['id_contents'] ?></td>
                        <td scope="col"><?= $content['id_users'] ?></td>
                        <td scope="col"><?= $content['original_price'] ?></td>
                        <td scope="col"><?= $content['buyer_repayment'] ?></td>
                        <td scope="col"><a href="./assets/actions/delete_purchased_contents_action.php?id=<?= $content['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


<?php

        require('./assets/require/foot.php');
    } else {

        header('location: /Diplome/index.php');
    }
}
?>