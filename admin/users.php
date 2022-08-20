<?php

require('./assets/require/head.php');
require('./assets/require/co_bdd.php');
require('./assets/actions/function.php');


$users = getUsers();


?>

<h1>Users</h1>



<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>

        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <th scope="col"><?= $user['id'] ?></th>
                <td scope="col"><?= $user['name'] ?></td>
                <td scope="col"><?= $user['lastname'] ?></td>
                <td scope="col"><?= $user['email'] ?></td>
                <td scope="col"><?= $user['type'] ?></td>

                <td scope="col"><a href="./assets/clients/deleteClient.php?id=<?= $user['id'] ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

require('./assets/require/foot.php'); ?>