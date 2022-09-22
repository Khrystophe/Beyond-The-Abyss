<?php
session_start();
require('./assets/require/check_data.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    if (
      (isset($get_error) xor !isset($check_get_error))
      &&
      (isset($get_success) xor !isset($check_get_success))
    ) {

      require('./assets/require/co_bdd.php');
      require('./assets/require/functions.php');
      require('./assets/require/errors_success_modal.php');
      require('./assets/require/head.php');

      $getNotifications = getNotifications($bdd); ?>


      <h1>Notifications</h1>

      <table class="table sortable">
        <thead>
          <tr>
            <th scope="col" style="word-break: break-all;">id</th>
            <th scope="col" style="word-break: break-all;">Date</th>
            <th scope="col" style="word-break: break-all;">id_users</th>
          </tr>
        </thead>

        <tbody>

          <?php foreach ($getNotifications as $getNotification) {

            require('./assets/require/variables.php');

            $getUserInformations = getUserInformations($bdd, $getNotification_id_users);

            require('./assets/require/variables.php'); ?>


            <tr>
              <td scope="col" style="word-break: break-all;"><?= $getNotification_id ?></td>
              <td scope="col" style="word-break: break-all;"><?= $getNotification_date ?></td>
              <td scope="col" style="word-break: break-all;"><?= $getNotification_id_users ?></td>

              <td scope="col" style="word-break: break-all;">

                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $getNotification_id ?>">
                  See
                </button>

                <div class="modal fade" id="user_editModal<?= $getNotification_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <form method="post" action="./assets/actions/reply_action.php?id=<?= $getNotification_id ?>" enctype="multipart/form-data">

                          <div class="mb-3">
                            <label for="admin_notification_id_user<?= $getNotification_id ?>" class="form-label">Notification User id</label>
                            <input type="hidden" class="form-control" id="admin_notification_id_user<?= $getNotification_id ?>" name="id" value="<?= $getNotification_id_users ?>">

                            <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $getNotification_id_users ?></div>
                          </div>

                          <div class="mb-3">
                            <label for="admin_notification_name<?= $getNotification_id ?> class=" form-label">Name/Lastname</label>
                            <input type="hidden" class="form-control" id="admin_notification_name<?= $getNotification_id ?>" name="name" value="<?= $getUserInformations_name ?>">

                            <label for="admin_notification_lastname<?= $getNotification_id ?> class=" form-label"></label>
                            <input type="hidden" class="form-control" id="admin_notification_lastname<?= $getNotification_id ?>" name="lastname" value="<?= $getUserInformations_lastname ?>">

                            <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: normal;"><?= $getUserInformations_name ?> <?= $getUserInformations_lastname ?></div>
                          </div>

                          <div class="mb-3">
                            <div class="form-label">notification Date</div>
                            <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: normal;"><?= $getNotification_date ?></div>
                          </div>

                          <div class="mb-3">
                            <div class="form-label">Notification Message</div>
                            <div style="white-space:pre-line; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: normal;"><?= $getNotification_message ?></div>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_notifications_action.php?id=<?= $getNotification_id ?>"><button class="btn btn-danger">Delete</button></a></td>
            </tr>

          <?php } ?>

        </tbody>
      </table>


      <?php require('./assets/require/foot.php'); ?>


    <?php } else {

      $bdd = null;
      http_response_code(400);
      header('location: /Diplome/index.php?error=02715');
      die();
    } ?>


  <?php  } else {

    $bdd = null;
    header('location: /Diplome/index.php?error=027140');
    die();
  } ?>


<?php } else {

  $bdd = null;
  header('location: /Diplome/index.php?error=027163');
  die();
}
?>