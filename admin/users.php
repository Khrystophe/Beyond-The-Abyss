<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/head.php');
    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');

    $users = getUsers($bdd);

?>


    <h1>Users</h1>

    <table class="table sortable">

      <thead>
        <tr>
          <th scope="col" style="word-break: break-all;">Id</th>
          <th scope="col" style="word-break: break-all;">Credits</th>
          <th scope="col" style="word-break: break-all;">Type</th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($users as $user) {

          $user_id = htmlspecialchars($user['id']);
          $user_name = htmlspecialchars($user['name']);
          $user_last_name = htmlspecialchars($user['lastname']);
          $user_email = htmlspecialchars($user['email']);
          $user_credits = htmlspecialchars($user['credits']);
          $user_type = htmlspecialchars($user['type']); ?>


          <tr>
            <td scope="col" style="word-break: break-all;"><?= $user_id ?></td>
            <td scope="col" style="word-break: break-all;"><?= $user_credits ?></td>
            <td scope="col" style="word-break: break-all;"><?= $user_type ?></td>

            <td scope="col" style="word-break: break-all;">


              <?php if ($_SESSION['users']['id'] != $user_id) { ?>


                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $user_id ?>">
                  Edit User Informations
                </button>


              <?php } else { ?>


                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $user_id ?>">
                  Your Informations
                </button>


              <?php } ?>


              <div class="modal fade" id="user_editModal<?= $user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">


                      <?php if ($_SESSION['users']['id'] != $user_id) { ?>


                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>


                      <?php } else { ?>


                        <h5 class="modal-title" id="exampleModalLabel">Your informations</h5>


                      <?php } ?>


                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form method="post" action="./assets/actions/edit_user_action.php?id=<?= $user_id ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                          <label for="admin_edit_id_user<?= $user_id ?>" class="form-label">User id</label>
                          <input type="hidden" class="form-control" id="admin_edit_id_user<?= $user_id ?>" name="id" value="<?= $user_id ?>">

                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $user_id ?></div>
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_name<?= $user_id ?>" class="form-label">Name</label>
                          <input type="text" class="form-control" id="admin_edit_user_name<?= $user_id ?>" name="name" value="<?= $user_name ?>" placeholder="<?= $user_name ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_lastname<?= $user_id ?>" class="form-label">Lastname</label>
                          <input type="text" class="form-control" id="admin_edit_user_lastname<?= $user_id ?>" name="lastname" value="<?= $user_last_name ?>" placeholder="<?= $user_last_name ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_email<?= $user_id ?>" class="form-label">Email</label>
                          <input type="email" class="form-control" id="admin_edit_user_email<?= $user_id ?>" name="email" value="<?= $user_email ?>" placeholder="<?= $user_email ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_credits<?= $user_id ?>" class="form-label">Credits</label>
                          <input type="text" class="form-control" id="admin_edit_user_credits<?= $user_id ?>" name="credits" value="<?= $user_credits ?>" placeholder="<?= $user_credits ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_type<?= $user_id ?>" class="form-label">Type</label>
                          <select class="inputbox" id="admin_edit_user_type<?= $user_id ?>" name="type">
                            <option value="<?= $user_type ?>">--<?= $user_type ?>--</option>
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

            <td scope="col" style="word-break: break-all;">


              <?php if ($_SESSION['users']['id'] != $user_id) { ?>


                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#user_editpassword<?= $user_id ?>">
                  Edit User Password
                </button>


              <?php } else { ?>


                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#user_editpassword<?= $user_id ?>">
                  Your Password
                </button>


              <?php } ?>


              <div class="modal fade" id="user_editpassword<?= $user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">


                      <?php if ($_SESSION['users']['id'] != $user_id) { ?>


                        <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <form method="post" action="./assets/actions/edit_password_action.php?id=<?= $user_id ?>" enctype="multipart/form-data">


                        <div class="mb-3">
                          <label for="admin_edit_user_password_id<?= $user_id ?>" class="form-label"></label>
                          <input type="hidden" class="form-control" id="admin_edit_id_user_password_id<?= $user_id ?>" name="id" value="<?= $user_id ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_password<?= $user_id ?>" class="form-label">Password</label>
                          <input type="password" class="form-control" id="admin_edit_user_password<?= $user_id ?>" name="password" required pattern="^([1-9][0-9])+$" minlength="2">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>


                    <?php } else { ?>


                      <h5 style="word-break:normal ;" class="modal-title" id="exampleModalLabel">If you want to change your password, go to your account, it's safer. Because it requires confirmation.</h5>


                    <?php } ?>


                    </div>
                  </div>
                </div>
              </div>
            </td>


            <?php if ($_SESSION['users']['id'] != $user_id) { ?>


              <td scope="col" style="word-break: break-all;"><a href="../../Diplome/assets/actions/delete_users_action.php?id=<?= $user_id ?>&type=admin"><button class="btn btn-danger">Delete</button></a></td>


            <?php } ?>


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