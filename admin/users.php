<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/require/functions.php');

        $users = getUsers();

?>


        <h1>Users</h1>

        <table class="table sortable">
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

                <?php

                foreach ($users as $user) {

                ?>

                    <tr>
                        <td scope="col"><?= $user['id'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $user['name'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $user['lastname'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $user['email'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $user['password'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $user['credits'] ?></td>
                        <td scope="col"><?= $user['type'] ?></td>

                        <td>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $user['id'] ?>">
                                Edit User Informations
                            </button>
                            <div class="modal fade" id="user_editModal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="./assets/actions/edit_user_action.php?id=<?= $user['id'] ?>" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                    <label for="admin_edit_id_user<?= $user['id'] ?>" class="form-label">User id</label>
                                                    <input type="text" class="form-control" id="admin_edit_id_user<?= $user['id'] ?>" name="id" value="<?= $user['id'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_user_name<?= $user['id'] ?>" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="admin_edit_user_name<?= $user['id'] ?>" name="name" value="<?= $user['name'] ?>" placeholder="<?= $user['name'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_user_lastname<?= $user['id'] ?>" class="form-label">Lastname</label>
                                                    <input type="text" class="form-control" id="admin_edit_user_lastname<?= $user['id'] ?>" name="lastname" value="<?= $user['lastname'] ?>" placeholder="<?= $user['lastname'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_user_email<?= $user['id'] ?>" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="admin_edit_user_email<?= $user['id'] ?>" name="email" value="<?= $user['email'] ?>" placeholder="<?= $user['email'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_user_credits<?= $user['id'] ?>" class="form-label">Credits</label>
                                                    <input type="text" class="form-control" id="admin_edit_user_credits<?= $user['id'] ?>" name="credits" value="<?= $user['credits'] ?>" placeholder="<?= $user['credits'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_user_type<?= $user['id'] ?>" class="form-label">Type</label>
                                                    <select class="inputbox" id="admin_edit_user_type<?= $user['id'] ?>" name="type">
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

                        <td>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#user_editpassword<?= $user['id'] ?>">
                                Edit User Password
                            </button>
                            <div class="modal fade" id="user_editpassword<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="./assets/actions/edit_password_action.php?id=<?= $user['id'] ?>" enctype="multipart/form-data">


                                                <div class="mb-3">
                                                    <label for="admin_edit_user_password_id<?= $user['id'] ?>" class="form-label"></label>
                                                    <input type="hidden" class="form-control" id="admin_edit_id_user_password_id<?= $user['id'] ?>" name="id" value="<?= $user['id'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_user_password<?= $user['id'] ?>" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="admin_edit_user_password<?= $user['id'] ?>" name="password" required pattern="^([1-9][0-9])+$" minlength="2">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td scope="col"><a href="../../Diplome/assets/actions/delete_users_action.php?id=<?= $user['id'] ?>&type=admin">Delete</a></td>

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