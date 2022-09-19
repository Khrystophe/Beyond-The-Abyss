<?php
session_start();
require('./assets/require/check_data.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');
    require('./assets/require/head.php');

    $getUsers = getUsers($bdd); ?>


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

        <?php foreach ($getUsers as $getUser) {

          require('./assets/require/variables.php'); ?>


          <tr>
            <td scope="col" style="word-break: break-all;"><?= $getUser_id ?></td>
            <td scope="col" style="word-break: break-all;"><?= $getUser_credits ?></td>
            <td scope="col" style="word-break: break-all;"><?= $getUser_type ?></td>

            <td scope="col" style="word-break: break-all;">


              <?php if ($_SESSION['users']['id'] != $getUser_id) { ?>


                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $getUser_id ?>">
                  Edit User Informations
                </button>


              <?php } else { ?>


                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $getUser_id ?>">
                  Your Informations
                </button>


              <?php } ?>


              <div class="modal fade" id="user_editModal<?= $getUser_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">


                      <?php if ($_SESSION['users']['id'] != $getUser_id) { ?>


                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>


                      <?php } else { ?>


                        <h5 class="modal-title" id="exampleModalLabel">Your informations</h5>


                      <?php } ?>


                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form method="post" action="./assets/actions/edit_user_action.php?id=<?= $getUser_id ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                          <label for="admin_edit_id_user<?= $getUser_id ?>" class="form-label">User id</label>
                          <input type="hidden" class="form-control" id="admin_edit_id_user<?= $getUser_id ?>" name="id" value="<?= $getUser_id ?>">

                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $getUser_id ?></div>
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_name<?= $getUser_id ?>" class="form-label">Name</label>
                          <input type="text" class="form-control" id="admin_edit_user_name<?= $getUser_id ?>" name="name" onkeyup="javascript:input(this,'admin_edit_user_name<?= $getUser_id ?>',11,'input_name_lastname');" value="<?= $getUser_name ?>" placeholder="<?= $getUser_name ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_lastname<?= $getUser_id ?>" class="form-label">Lastname</label>
                          <input type="text" class="form-control" id="admin_edit_user_lastname<?= $getUser_id ?>" name="lastname" onkeyup="javascript:input(this,'admin_edit_user_lastname<?= $getUser_id ?>',11,'input_name_lastname');" value="<?= $getUser_last_name ?>" placeholder="<?= $getUser_last_name ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_email<?= $getUser_id ?>" class="form-label">Email</label>
                          <input type="email" class="form-control" id="admin_edit_user_email<?= $getUser_id ?>" name="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" value="<?= $getUser_email ?>" placeholder="<?= $getUser_email ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_credits<?= $getUser_id ?>" class="form-label">Credits</label>
                          <input type="text" class="form-control" id="admin_edit_user_credits<?= $getUser_id ?>" name="credits" onkeyup="javascript:input(this,'admin_edit_user_credits<?= $getUser_id ?>',11, 'input_credits_reporting');" value="<?= $getUser_credits ?>" placeholder="<?= $getUser_credits ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_type<?= $getUser_id ?>" class="form-label">Type</label>
                          <select class="inputbox" id="admin_edit_user_type<?= $getUser_id ?>" name="type">
                            <option value="<?= $getUser_type ?>">--<?= $getUser_type ?>--</option>
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


              <?php if ($_SESSION['users']['id'] != $getUser_id) { ?>


                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#user_editpassword<?= $getUser_id ?>">
                  Edit User Password
                </button>


              <?php } else { ?>


                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#user_editpassword<?= $getUser_id ?>">
                  Your Password
                </button>


              <?php } ?>


              <div class="modal fade" id="user_editpassword<?= $getUser_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">


                      <?php if ($_SESSION['users']['id'] != $getUser_id) { ?>


                        <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <form method="post" action="./assets/actions/edit_password_action.php?id=<?= $getUser_id ?>" enctype="multipart/form-data">


                        <div class="mb-3">
                          <label for="admin_edit_user_password_id<?= $getUser_id ?>" class="form-label"></label>
                          <input type="hidden" class="form-control" id="admin_edit_id_user_password_id<?= $getUser_id ?>" name="id" value="<?= $getUser_id ?>">
                        </div>

                        <div class="mb-3">
                          <label for="admin_edit_user_password<?= $getUser_id ?>" class="form-label">Password</label>
                          <input type="password" class="form-control" id="admin_edit_user_password<?= $getUser_id ?>" name="password" onkeyup="javascript:input(this,'admin_edit_user_password<?= $getUser_id ?>',41, 'input_password');" required>
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


            <?php if ($_SESSION['users']['id'] != $getUser_id) { ?>


              <td scope="col" style="word-break: break-all;"><a href="../../Diplome/assets/actions/delete_users_action.php?id=<?= $getUser_id ?>&type=admin"><button class="btn btn-danger">Delete</button></a></td>


            <?php } ?>


          </tr>


        <?php } ?>


      </tbody>
    </table>


<?php

    require('./assets/require/foot.php');
  } else {

    $bdd = null;
    header('location: /Diplome/index.php?error=025140');
    die();
  }
}
?>