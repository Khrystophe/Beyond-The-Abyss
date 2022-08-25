<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/actions/functions.php');

        $comments = getComments();
?>

        <h1>Comments</h1>

        <br>



        <table class="table tritable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Date</th>
                    <th scope="col">Like</th>
                    <th scope="col">id_contents</th>
                    <th scope="col">id_users</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($comments as $comment) { ?>
                    <tr>
                        <td scope="col"><?= $comment['id'] ?></td>
                        <td scope="col" style="word-break:break-all" ;><?= $comment['comment'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $comment['date'] ?></td>
                        <td scope="col"><?= $comment['likes'] ?></td>
                        <td scope="col"><?= $comment['id_contents'] ?></td>
                        <td scope="col"><?= $comment['id_users'] ?></td>
                        <td scope="col"><a href="./assets/actions/delete_comments_action.php?id=<?= $comment['id'] ?>">Delete</a></td>
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