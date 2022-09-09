<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/require/functions.php');

        $purchased_contents = getPurchased_contents($bdd);

?>


        <h1>Purchased contents</h1>

        <table class="table sortable">
            <thead>
                <tr>
                    <th scope="col" style="word-break: break-all;">id</th>
                    <th scope="col" style="word-break: break-all;">id_contents</th>
                    <th scope="col" style="word-break: break-all;">id_users</th>
                    <th scope="col" style="word-break: break-all;">Original price</th>
                    <th scope="col" style="word-break: break-all;">Buyer repayment</th>
                </tr>
            </thead>

            <tbody>

                <?php

                foreach ($purchased_contents as $content) {

                    $content_id = htmlspecialchars($content['id']);
                    $content_id_contents = htmlspecialchars($content['id_contents']);
                    $content_id_users = htmlspecialchars($content['id_users']);
                    $content_original_price = htmlspecialchars($content['original_price']);
                    $content_buyer_repayment = htmlspecialchars($content['buyer_repayment']);

                ?>

                    <tr>
                        <td scope="col" style="word-break: break-all;"><?= $content_id ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content_id_contents ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content_id_users ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content_original_price ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content_buyer_repayment ?></td>
                        <td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_purchased_contents_action.php?id=<?= $content_id ?>"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>

                <?php

                }

                ?>

            </tbody>
        </table>


<?php

        require('./assets/require/foot.php');
    } else {

        header('location: /Diplome/index.php');
    }
}

?>