<?php

require('./assets/require/head.php');
require('./assets/require/co_bdd.php');
require('./assets/actions/function.php');


$users = getUsers();


?>

<h1>Users</h1>



<table class="table tritable">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Lastname</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Credits</th>
            <th scope="col">Type</th>

        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td scope="col"><?= $user['id'] ?></td>
                <td scope="col" style="word-break: break-all;"><?= $user['name'] ?></td>
                <td scope="col" style="word-break: break-all;"><?= $user['lastname'] ?></td>
                <td scope="col" style="word-break: break-all;"><?= $user['email'] ?></td>
                <td scope="col" style="word-break: break-all;"><?= $user['password'] ?></td>
                <td scope="col" style="word-break: break-all;"><?= $user['credits'] ?></td>
                <td scope="col"><?= $user['type'] ?></td>

                <td scope="col"><a href="./assets/actions/delete_users_action.php?id=<?= $user['id'] ?>">Delete</a></td>

                <td>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $user['id'] ?>">
                        Edit
                    </button>
                    <div class="modal fade" id="user_editModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post" action="./assets/actions/edit_user_action.php?id=<?= $user['id'] ?>" enctype="multipart/form-data">

                                        <div class="mb-3">
                                            <label for="admin_edit_id" class="form-label"></label>
                                            <input type="text" class="form-control" id="admin_edit_id_user" name="id" value="<?= $user['id'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_user_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="admin_edit_user_name" name="name" value="<?= $user['name'] ?>" placeholder="<?= $user['name'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_user_lastname" class="form-label">Lastname</label>
                                            <input type="text" class="form-control" id="admin_edit_user_lastname" name="lastname" value="<?= $user['lastname'] ?>" placeholder="<?= $user['lastname'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_user_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="admin_edit_user_email" name="email" value="<?= $user['email'] ?>" placeholder="<?= $user['email'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_user_password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="admin_edit_user_password" name="password" value="<?= $user['password'] ?>" placeholder="<?= $user['password'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_user_credits" class="form-label">Credits</label>
                                            <input type="text" class="form-control" id="admin_edit_user_credits" name="credits" value="<?= $user['credits'] ?>" placeholder="<?= $user['credits'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <select class="inputbox" id="type" name="type">
                                                <option value="<?= $user['type'] ?>">--<?= $user['type'] ?>--</option>
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>




                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
                </form>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

require('./assets/require/foot.php'); ?>