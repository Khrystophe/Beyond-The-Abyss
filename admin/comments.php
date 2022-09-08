<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/require/functions.php');

        $comments = getComments($bdd);

?>


        <h1>Comments</h1>

        <table class="table sortable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Date</th>
                    <th scope="col">Likes</th>
                    <th scope="col">id_contents</th>
                    <th scope="col">id_users</th>
                </tr>
            </thead>

            <tbody>

                <?php

                foreach ($comments as $comment) {

                    $comment_id = htmlspecialchars($comment['id']);
                    $comment_text = nl2br(htmlspecialchars($comment['comment']));
                    $comment_date = htmlspecialchars($comment['date']);
                    $comment_likes = htmlspecialchars($comment['likes']);
                    $comment_id_contents = htmlspecialchars($comment['id_contents']);
                    $comment_id_users = htmlspecialchars($comment['id_users']);

                ?>

                    <tr>
                        <td scope="col"><?= $comment_id ?></td>
                        <td scope="col" style="word-break:break-all" ;><?= $comment_text ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $comment_date ?></td>
                        <td scope="col"><?= $comment_likes ?></td>
                        <td scope="col"><?= $comment_id_contents ?></td>
                        <td scope="col"><?= $comment_id_users ?></td>
                        <td scope="col"><a href="./assets/actions/delete_comments_action.php?id=<?= $comment_id ?>">Delete</a></td>
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