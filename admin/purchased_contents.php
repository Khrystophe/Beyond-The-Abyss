<?php

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
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($purchased_contents as $content) { ?>
            <tr>
                <td scope="col"><?= $content['id'] ?></td>
                <td scope="col"><?= $content['id_contents'] ?></td>
                <td scope="col"><?= $content['id_users'] ?></td>
                <td scope="col"><a href="./assets/actions/delete_purchased_contents.php?id=<?= $content['id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

require('./assets/require/foot.php'); ?>