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

                <td scope="col"><a href="./assets/actions/delete_users_action.php?id=<?= $user['id'] ?>">Delete</a></td>
                <form action="./assets/actions/change_type_action.php?id=<?= $user['id'] ?>" method="post">
                    <td><button type="submit">Change Type</button></td>
                    <td scope="col">
                        <label for="type"></label>
                        <select class="inputbox" id="type" name="type" required>
                            <option value="">--Type--</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

require('./assets/require/foot.php'); ?>